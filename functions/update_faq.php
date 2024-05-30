<?php
require_once '../classes/Faq.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $oldQuestion = $_POST['old_question'];
    $newQuestion = $_POST['new_question'];
    $newAnswer = $_POST['new_answer'];
    $faq = new Faq();
    $faq->updateFaq($oldQuestion, $newQuestion, $newAnswer);
    // Presmerovanie používateľa po aktualizácii späť na stránku s často kladenými otázkami
    header("Location: ../faq.php");
    exit();
} else {
    header("Location: ../faq.php");
    exit();
}
?>
