<?php
require_once 'Database.php';

class Users {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function register($email, $password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return "Email already exists.";
        }

        // Vloženie používateľa do databázy
        $stmt = $this->db->prepare("INSERT INTO users (email, password, status) VALUES (:email, :password, 'user')");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        if ($stmt->execute()) {
            return "Registration successful.";
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Registration failed: " . $errorInfo[2];
        }
    }

    public function login($email, $password) {
        // Získanie používateľa z databázy
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Spustenie relácie a nastavenie informácií o používateľovi
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['status'] = $user['status'];
            return "Login successful.";
        } else {
            return "Invalid email or password.";
        }
    }
}
?>
