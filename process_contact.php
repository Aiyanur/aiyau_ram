<?php
require_once '../classes/ContactForm.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $message = $_POST['Message'];

    $contactForm = new ContactForm($name, $email, $message);

    if ($contactForm->save()) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>