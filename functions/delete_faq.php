<?php
require_once '../classes/Faq.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $questionToDelete = $_POST['question'];
    $faq = new Faq();
    $faq->deleteFaq($questionToDelete);

    // Odstránenie príslušných údajov zo súboru datas.json
    $data = json_decode(file_get_contents('../data/datas.json'), true);
    $questions = $data["questions"];
    $answers = $data["answers"];
    $index = array_search($questionToDelete, $questions);
    if ($index !== false) {
        unset($questions[$index]);
        unset($answers[$index]);
    } else {
        echo "The question is not in the datas.json file!";
    }

    header("Location: ../faq.php");
    exit();
} else {
    header("Location: ../faq.php");
    exit();
}
?>
