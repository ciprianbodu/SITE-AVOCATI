<?php
declare(strict_types=1);

if (!defined('SITE_BOOTSTRAP')) {
    http_response_code(403);
    exit;
}

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Process the contact form. Returns status: '', 'success', 'error', 'invalid'.
 *
 * @param array<string, mixed> $t
 */
function handle_contact(array $t): string
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || !isset($_POST['trimite_contact'])) {
        return '';
    }

    $token = (string) ($_POST['csrf_token'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');
    if ($sessionToken === '' || !hash_equals($sessionToken, $token)) {
        return 'invalid';
    }

    if (trim((string) ($_POST['website'] ?? '')) !== '') {
        return 'success';
    }

    $nume = trim(strip_tags((string) ($_POST['nume'] ?? '')));
    $email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
    $telefon = trim(strip_tags((string) ($_POST['telefon'] ?? '')));
    $mesaj = trim(strip_tags((string) ($_POST['mesaj'] ?? '')));
    $consent = isset($_POST['consent']);

    $len = static function (string $value): int {
        return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
    };

    if (
        !$consent
        || $nume === '' || $len($nume) > 120
        || $email === false
        || $mesaj === '' || $len($mesaj) < 10 || $len($mesaj) > 4000
        || $len($telefon) > 40
    ) {
        return 'invalid';
    }

    require_once __DIR__ . '/../PHPmailer/Exception.php';
    require_once __DIR__ . '/../PHPmailer/PHPMailer.php';
    require_once __DIR__ . '/../PHPmailer/SMTP.php';

    $safeName = htmlspecialchars($nume, ENT_QUOTES, 'UTF-8');
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safePhone = htmlspecialchars($telefon !== '' ? $telefon : '—', ENT_QUOTES, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($mesaj, ENT_QUOTES, 'UTF-8'), false);

    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = smtp_password();
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = SMTP_PORT;
        $mail->setFrom(SITE_EMAIL, $t['mail_from_name']);
        $mail->addAddress(SITE_EMAIL);
        $mail->addReplyTo($email, $nume);
        $mail->isHTML(true);
        $mail->Subject = $t['mail_subject'] . ': ' . $nume;
        $mail->Body = '<h3>' . htmlspecialchars($t['mail_heading'], ENT_QUOTES, 'UTF-8') . '</h3>'
            . '<p><strong>Nume:</strong> ' . $safeName . '</p>'
            . '<p><strong>Email:</strong> ' . $safeEmail . '</p>'
            . '<p><strong>Telefon:</strong> ' . $safePhone . '</p>'
            . '<p><strong>Mesaj:</strong><br>' . $safeMessage . '</p>';
        $mail->AltBody = "Nume: {$nume}\nEmail: {$email}\nTelefon: {$telefon}\n\n{$mesaj}";
        $mail->send();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        return 'success';
    } catch (Exception $e) {
        return 'error';
    }
}
