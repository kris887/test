<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Zmienna do przechowywania błędów
    $errors = [];

    // Pobranie danych z formularza
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Walidacja danych
    if (empty($name)) {
        $errors[] = "Imię jest wymagane.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Podaj poprawny adres e-mail.";
    }
    if (empty($message)) {
        $errors[] = "Wiadomość nie może być pusta.";
    }

    // Jeśli brak błędów, wysyłamy e-mail
    if (empty($errors)) {
        $to = "energetyka024@gmail.com"; // Adres docelowy
        $subject = "Nowa wiadomość od: $name";
        $body = "Imię: $name\nEmail: $email\n\nWiadomość:\n$message";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Wysłanie wiadomości
        if (mail($to, $subject, $body, $headers)) {
            echo "Wiadomość została wysłana pomyślnie.";
        } else {
            echo "Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie.";
        }
    } else {
        // Wyświetlenie błędów
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    // Jeśli formularz nie został wysłany poprawnie
    echo "Wystąpił błąd. Proszę spróbować ponownie.";
}
?>

