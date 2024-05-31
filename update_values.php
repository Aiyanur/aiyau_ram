<!DOCTYPE html>
<html lang="en">
<?php include 'parts/head.php'; ?>
<body>
<?php include 'parts/header.php'; ?>
    <div class="update-container">
        <form method="post" action="functions/update_faq.php">
            <h2>Update FAQ</h2>
            <label for="new_question">New Question:</label><br>
            <input type="text" id="new_question" name="new_question" placeholder="Insert new question here" required><br>
            <label for="new_answer">New Answer:</label><br>
            <textarea id="new_answer" name="new_answer" placeholder="Insert new answer here" required></textarea><br>
            <!-- Skryté pole na odovzdanie starej otázky -->
            <input type="hidden" id="old_question" name="old_question" value="<?php echo $_GET['question']; ?>">
            <button type="submit" name="update">Update FAQ</button>
        </form>
    </div>
<script src="js/hamburgermenu.js"></script>
</body>
</html>
