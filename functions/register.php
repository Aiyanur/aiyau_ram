<?php
require_once '../classes/Users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("POST request received.");

    $email = $_POST['usermail'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $user = new Users();
    $result = $user->register($email, $password, $cpassword);

    // Spustime reláciu na výstup správ prostredníctvom relácie
    session_start();
    $_SESSION['message'] = $result;

    // Zaznamenanie výsledku registrácie
    error_log("Registration result: " . $result);

    // Presmerovanie používateľa v závislosti od výsledku
    if ($result == "Registration successful.") {
        header("Location: ../login_form.php");
    } else {
        header("Location: ../register_form.php");
    }
    exit(); // Zabezpečme, aby sa po presmerovaní nevykonával ďalší kód
} else {
    error_log("Form not submitted via POST.");
}
?>

