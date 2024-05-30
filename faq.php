<?php
require_once 'classes/Faq.php';

// Создаем экземпляр класса Faq
$faq = new Faq();

// Вызываем метод insertFaq
// $faq->insertFaq();
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'parts/head.php'; ?>
<?php include 'parts/header.php'; ?>
<body>
<div class="height15"></div>
<section>
    <h2 class="title">FAQs</h2>

    <?php
    // Подключение класса Faq
    require_once 'classes/Faq.php';

    try {
        // Создание экземпляра класса Faq
        $faq = new Faq();

        // Получение всех записей FAQ
        $result = $faq->getFaq();

        // Проверка наличия записей
        if ($result) {
            // Итерация по результатам и отображение каждой записи
            foreach ($result as $qa) { ?>
                <div class='faq'>
                    <div class='question'>
                        <h3>
                            <?php echo $qa['question']; ?>
                        </h3>
                        <svg width="15" height="10" viewBox="0 0 42 25">
                            <path
                                    d="M3 3L21 21L39 3"
                                    stroke="white"
                                    stroke-width="7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <div class='answer'>
                        <p>
                            <?php echo $qa['answer']; ?>
                        </p>
                    </div>
                    <div class="button-group">
                        <form method="post" action="functions/delete_faq.php" class="delete-form">
                            <input type="hidden" name="question" value="<?php echo $qa['question']; ?>">
                            <button type="submit" name="delete" class="delete-button">Delete</button>
                        </form>
                        <a href="update_values.php?question=<?php echo urlencode($qa['question']); ?>" class="update-button">Update</a>
                    </div>
                </div>
            <?php }
        } else {
            // Если нет записей FAQ
            echo "<p>No FAQs found.</p>";
        }
    } catch (Exception $e) {
        // Вывод сообщения об ошибке, если произошла ошибка
        echo "Error: " . $e->getMessage();
    }
    ?>
</section>

<?php include 'parts/footer.php'; ?>
<script src="js/hamburgermenu.js"></script>
<script src="js/faq-accordion.js"></script>
<script src="js/confirmation_faq.js"></script>
</body>
</html>
