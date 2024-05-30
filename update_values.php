<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update FAQ</title>
    <!-- Ваши стили -->
</head>
<body>
<h2>Update FAQ</h2>
<!-- Форма для обновления FAQ -->
<form method="post" action="functions/update_faq.php">
    <label for="new_question">New Question:</label><br>
    <input type="text" id="new_question" name="new_question" required><br>
    <label for="new_answer">New Answer:</label><br>
    <textarea id="new_answer" name="new_answer" required></textarea><br>
    <button type="submit" name="update">Update FAQ</button>
</form>
</body>
</html>
