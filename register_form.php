<!doctype html>
<html lang="en">
<?php include_once "parts/head.php" ?>
<body>
<?php include 'parts/header.php' ?>
<div class="form-container">

    <form action="" method="post">
        <h3>register now</h3>
        <input type="email" name="usermail" placeholder="enter your email" class="box" required>
        <input type="password" name="password" placeholder="enter your password" class="box" required>
        <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
        <input type="submit" value="register now" name="submit" class="form-btn">
        <p>already have an account? <a href="login_form.php">login now</a></p>
    </form>


</div>
<script src="js/hamburgermenu.js"></script>
</body>
</html>