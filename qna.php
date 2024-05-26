<!DOCTYPE html>
<html lang="en">
<?php include 'parts/head.php' ?>
<?php include 'parts/header.php' ?>
<body>
<div class="height15"></div>
<section>
    <h2 class="title">FAQs</h2>


    <?php
    include_once "classes/QnA.php";

    try {
        $qna = new QnA();

        // Insert data
        $qna->insertQnA();

        // Retrieve data
        $result = $qna->getQnA();

        // Display Q&A pairs
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
                    <form method="post">
                        <input type="hidden" name="question" value="<?php echo $qa['question']; ?>">
                        <button type="submit" name="delete" class="delete-button">Delete</button>
                    </form>
                    <button class="update update-button" data-question="<?php echo $qa['question']; ?>">Update</button>
                </div>
            </div>
        <?php }

        // Handle delete action
        if (isset($_POST['delete'])) {
            $questionToDelete = $_POST['question'];
            $qna->deleteQnA($questionToDelete);
            // Refresh the page after successful deletion
            header("Location: index.php");
            exit();
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>


</section>

<?php include 'parts/footer.php' ?>
<script src="js/hamburgermenu.js"></script>
<script src="js/qna-accordion.js"></script>
</body>
</html>