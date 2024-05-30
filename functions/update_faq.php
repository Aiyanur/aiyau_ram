<?php
require_once '../classes/Faq.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $newQuestion = $_POST['new_question'];
    $newAnswer = $_POST['new_answer'];
    $faq = new Faq();
    $faq->updateFaq($newQuestion, $newAnswer);
    // Перенаправляем пользователя обратно на страницу FAQ после обновления
    header("Location: ../faq.php");
    exit();
} else {
    header("Location: ../faq.php");
    exit();
}
?>
