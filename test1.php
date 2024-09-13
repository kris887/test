<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if (isset($_POST['email'])) {
    $recipients = [
        'energetyka024@gmail.com',
        'kris28288@wp.pl',
        'ekris288756482927374748@o2.pl'
    ];

    $email = htmlspecialchars(trim($_POST['email']));
    $question1 = htmlspecialchars(trim($_POST['question1']));
    $question2 = htmlspecialchars(trim($_POST['question2']));

    $mail = new PHPMailer(true);

    try {
        // Ustawienia serwera SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'energetyka024@gmail.com';
        $mail->Password = 'gbbg vmyy ftfd wwuh'; // Użyj hasła aplikacji
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Ustawienia e-maila
        $mail->setFrom('energetyka024@gmail.com', 'Ankieta');
        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient);
        }
        $mail->addReplyTo($email);

        $mail->isHTML(false);
        $mail->Subject = 'Nowa odpowiedź z ankiety';
        $mail->Body    = "Odpowiedź na pytanie 1: $question1\nOdpowiedź na pytanie 2: $question2\nE-mail: $email";

        $mail->send();
        echo 'Dziękujemy za wypełnienie ankiety!';
    } catch (Exception $e) {
        echo "Wystąpił błąd podczas wysyłania ankiety. Błąd: {$mail->ErrorInfo}";
    }
} else {
    ?>
    <form method="post">
        <label for="email">Email:</label>
        <input name="email" type="email" required/><br />
        <label for="question1">Jak oceniasz naszą stronę?</label>
        <input name="question1" type="text" required/><br />
        <label for="question2">Co moglibyśmy poprawić?</label>
        <input name="question2" type="text" required/><br />
        <input type="submit" value="Wyślij" />
    </form>
    <?php
}
?>
