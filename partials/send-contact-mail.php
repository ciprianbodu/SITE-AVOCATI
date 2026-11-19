<?php
$statusMessage = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['trimite_contact'])) {
    return;
}

$formValues = [];
foreach (['nume', 'email', 'mesaj'] as $field) {
    $formValues[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
}
// HTML maxlength counts UTF-16 code units and the textarea DOM uses LF newlines.
$fitsField = static function (string $value, int $limit): bool {
    if ($value === '' || strlen($value) > 3 * $limit) {
        return false;
    }
    $characters = preg_match_all('/./us', $value);
    if ($characters === false || $characters > $limit) {
        return false;
    }
    $supplementary = preg_match_all('/[\x{10000}-\x{10FFFF}]/u', $value);
    return $characters + $supplementary <= $limit;
};
$nume = $formValues['nume'];
$email_client = $formValues['email'];
$mesaj_client = str_replace(["\r\n", "\r"], "\n", $formValues['mesaj']);
if (!$fitsField($nume, 160) || strpbrk($nume, "\r\n") !== false
    || strlen($email_client) > 254 || !filter_var($email_client, FILTER_VALIDATE_EMAIL)
    || !$fitsField($mesaj_client, 10000)) {
    $statusMessage = 'invalid';
    return;
}

// The deployment supplies this private file. An unavailable configuration uses the form's error state.
$config = @include dirname(__DIR__) . '/mail-config.php';
if (empty($config['from_email']) || empty($config['to_email'])
    || empty($config['api_token']) || empty($config['account_id'])) {
    $statusMessage = 'error';
    return;
}

$locale = $mailLocale ?? 'ro';
if ($locale === 'en') {
    $subject = "New inquiry: $nume";
    $body = "<h3>New message from mitescu.ro (EN)</h3>"
        . "<p><strong>Name:</strong> " . htmlspecialchars($nume, ENT_QUOTES, 'UTF-8') . "</p>"
        . "<p><strong>Email:</strong> " . htmlspecialchars($email_client, ENT_QUOTES, 'UTF-8') . "</p>"
        . "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($mesaj_client, ENT_QUOTES, 'UTF-8')) . "</p>";
} else {
    $subject = "Solicitare nouă: $nume";
    $body = "<h3>Mesaj nou de pe mitescu.ro</h3>"
        . "<p><strong>Nume:</strong> " . htmlspecialchars($nume, ENT_QUOTES, 'UTF-8') . "</p>"
        . "<p><strong>Email:</strong> " . htmlspecialchars($email_client, ENT_QUOTES, 'UTF-8') . "</p>"
        . "<p><strong>Mesaj:</strong><br>" . nl2br(htmlspecialchars($mesaj_client, ENT_QUOTES, 'UTF-8')) . "</p>";
}

$payload = json_encode([
    'from' => $config['from_email'],
    'to' => $config['to_email'],
    'subject' => $subject,
    'html' => $body,
    'text' => "$nume <$email_client>\n\n$mesaj_client",
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "Authorization: Bearer {$config['api_token']}\r\nContent-Type: application/json\r\n",
        'content' => $payload,
        'timeout' => 30,
        'ignore_errors' => true,
    ],
]);

try {
    $response = @file_get_contents(
        "https://api.cloudflare.com/client/v4/accounts/{$config['account_id']}/email/sending/send",
        false,
        $context
    );
    $result = json_decode($response ?: '', true);
    $statusMessage = is_array($result) && ($result['success'] ?? false) ? 'success' : 'error';
} catch (Throwable $e) {
    $statusMessage = 'error';
}
