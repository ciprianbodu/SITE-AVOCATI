<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

$statusMessage = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['trimite_contact'])) {
    return;
}

$formValues = [];
foreach (['nume', 'email', 'mesaj'] as $field) {
    $formValues[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
}
$validContact = $formValues['nume'] !== '' && strlen($formValues['nume']) <= 640
    && !preg_match('/[\r\n]/', $formValues['nume'])
    && strlen($formValues['email']) <= 254 && filter_var($formValues['email'], FILTER_VALIDATE_EMAIL)
    && $formValues['mesaj'] !== '' && strlen($formValues['mesaj']) <= 40000;
if (!$validContact) {
    $statusMessage = 'error';
    return;
}

$mailerDir = dirname(__DIR__) . '/PHPMailer';
require $mailerDir . '/Exception.php';
require $mailerDir . '/PHPMailer.php';
require $mailerDir . '/SMTP.php';

$config = require dirname(__DIR__) . '/mail-config.php';
$locale = $mailLocale ?? 'ro';

$nume = strip_tags($formValues['nume']);
$email_client = $formValues['email'];
$mesaj_client = strip_tags($formValues['mesaj']);

if ($nume === '' || $email_client === '' || $mesaj_client === '') {
    $statusMessage = 'error';
    return;
}

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

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = $config['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['username'];
    $mail->Password   = $config['password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $config['port'];
    $mail->CharSet    = PHPMailer::CHARSET_UTF8;
    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['to_email']);
    $mail->addReplyTo($email_client, $nume);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
    $statusMessage = 'success';
} catch (MailException $e) {
    $statusMessage = 'error';
} catch (Throwable $e) {
    $statusMessage = 'error';
}
