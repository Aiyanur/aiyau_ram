<?php
require_once 'Database.php';

class Users {
    private $db;
    private $id;
    private $status;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function register($email, $password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return "Email already exists.";
        }

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
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->status = $user['status'];
            session_start();
            $_SESSION['user_id'] = $this->id;
            $_SESSION['email'] = $user['email'];
            $_SESSION['status'] = $this->status;
            return "Login successful.";
        } else {
            return "Invalid email or password.";
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getStatus() {
        return $this->status;
    }
}
?>
