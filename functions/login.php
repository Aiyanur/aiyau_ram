<?php
require_once '../classes/Users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['usermail'];
    $password = $_POST['password'];

    $user = new Users();
    $result = $user->login($email, $password);

    session_start();
    $_SESSION['message'] = $result;

    if ($result == "Login successful.") {
        header("Location: ../index.php");
    } else {
        header("Location: ../login_form.php");
    }
    exit();
}
?>
