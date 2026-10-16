
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if (
    $name === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $message === '' ||
    strlen($name) > 100 ||
    strlen($email) > 254 ||
    strlen($phone) > 30 ||
    strlen($message) > 5000
) {
    http_response_code(400);
    exit('Please enter valid form details.');
}

// Replace this with your own Gmail address.
$gmail = 'kulalbalu45@gmail.com';

// Use the Gmail App Password, not your normal password.
$appPassword = 'nnes gaph ugqe ubhs';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $gmail;
    $mail->Password = $appPassword;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Sender must be your authenticated Gmail account.
    $mail->setFrom($email, 'Website Contact Form');

    // Send enquiries to your Gmail inbox.
    $mail->addAddress($gmail);

    // Reply directly to the visitor.
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->Subject = 'New Contact Form Message';

    $mail->Body =
        "Name: $name\n" .
        "Email: $email\n" .
        "Phone: $phone\n\n" .
        "Message:\n$message";

    $mail->send();

    header('Location: decor-indoors-contacts.html?status=success');
exit;
} catch (Exception $e) {
    echo "Email error: " . htmlspecialchars(
        $mail->ErrorInfo ?: $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    );

    // header('Location: decor-indoors-contacts.html?status=error');
exit;
}
