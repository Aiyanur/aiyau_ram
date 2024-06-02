<?php
require_once 'classes/Faq.php';
session_start();

// Vytvorenie inštancie triedy Faq
$faq = new Faq();

//$faq->insertFaq();        #ak chceme pridať niektoré otázky odomknúť tieto
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
    try {
        // Vyhľadanie všetkých záznamov FAQ
        $result = $faq->getFaq();

        // Kontrola dostupnosti záznamov
        if ($result) {
            // Iterovať cez výsledky a zobraziť každý záznam
            foreach ($result as $qa) { ?>
                <div class='faq'>
                    <div class='question'>
                        <h3>
                            <?php echo htmlspecialchars($qa['question']); ?>
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
                            <?php echo htmlspecialchars($qa['answer']); ?>
                        </p>
                    </div>
                    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'admin'): ?>
                        <div class="button-group">
                            <form method="post" action="functions/delete_faq.php" class="delete-form">
                                <input type="hidden" name="question" value="<?php echo htmlspecialchars($qa['question']); ?>">
                                <button type="submit" name="delete" class="delete-button">Delete</button>
                            </form>
                            <a href="update_values.php?question=<?php echo urlencode($qa['question']); ?>" class="update-button">Update</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php }
        } else {
            // Ak nie sú k dispozícii žiadne položky FAQ
            echo "<p>No FAQs found.</p>";
        }
    } catch (Exception $e) {
        // Zobrazenie chybovej správy, ak došlo k chybe
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
