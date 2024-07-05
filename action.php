<?php
header('Content-Type: application/json'); // Set JSON header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST["name"];
    $email = $_POST["email"];
    $text = $_POST["text"];

    // Проверка наличия данных
    if (empty($name) || empty($email) || empty($text)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }
    // Формирование сообщения
    $message = "Name: $name\nEmail: $email\nText: $text";

    // Адрес, на который будет отправлено письмо
    $to = "recipient@example.com";

    // Тема письма
    $subject = "New Form Submission";

    // Заголовки для письма
    $headers = "From: $email";

    // Отправка письма
    if (mail($to, $subject, $message, $headers)) {
        // Уведомление об успешной отправке
        json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
        $isTrue = true;
    } else {
        // Уведомление об ошибке отправки
        echo json_encode(['status' => 'error', 'message' => 'Error sending email.']);
    }
} else {
    // Уведомление об ошибке метода запроса
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>