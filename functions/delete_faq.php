<?php
require_once '../classes/Faq.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $questionToDelete = $_POST['question'];
    $faq = new Faq();
    $faq->deleteFaq($questionToDelete);

    // Удаление соответствующих данных из файла datas.json
    $data = json_decode(file_get_contents('../data/datas.json'), true);
    $questions = $data["questions"];
    $answers = $data["answers"];
    $index = array_search($questionToDelete, $questions);
    if ($index !== false) {
        unset($questions[$index]);
        unset($answers[$index]);
    } else {
        echo "Вопрос не найден в файле datas.json!";
    }
    // Обновление файла datas.json с новыми данными
    $updatedData = json_encode(["questions" => array_values($questions), "answers" => array_values($answers)]);
    if (file_put_contents('../data/datas.json', $updatedData)) {
        echo "Данные успешно удалены из файла datas.json!";
    } else {
        echo "Ошибка при записи в файл datas.json!";
    }

    header("Location: ../faq.php");
    exit();
} else {
    header("Location: ../faq.php");
    exit();
}
?>
