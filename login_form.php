<!doctype html>
<html lang="en">
<?php include_once "parts/head.php"; ?>
<body>
<?php include 'parts/header.php'; ?>
<div class="form-container">
    <form action="functions/login.php" method="post">
        <h3>login now</h3>
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
        <input type="email" name="usermail" placeholder="enter your email" class="box" required>
        <input type="password" name="password" placeholder="enter your password" class="box" required>
        <input type="submit" value="login now" name="submit" class="form-btn">
        <p>don't have an account? <a href="register_form.php">register now</a></p>
    </form>
</div>
<script src="js/hamburgermenu.js"></script>
</body>
</html>
