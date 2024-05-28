<?php
//error_reporting(E_ALL); //turning on error messages
//ini_set("display_errors","On");
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/classes/Database.php');
class Users extends Database{
    private $status;
    protected $connection;
    public function __construct() {
        $this->status= "user";
        $this->connect();
        $this->connection = $this->getConnection();
    }
    public function register($username, $email, $password){
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            //verifying whether the user is in the db
            $sql = "SELECT * FROM user WHERE (username = ? OR email = ?) LIMIT 1;";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $email);
            $statement->execute();
            $existingUser = $statement->fetch();
            if ($existingUser) {
                throw new Exception("The user already exists.");
            }
            $sql = "INSERT INTO user (username, email, password, status) VALUES (?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $hashedPassword);
            $statement->bindParam(4, $this->status);
            $statement->execute();
        }catch (Exception $e){
            echo "Error when entering data into the database: " . $e->getMessage();
        } finally {
            $this->connection=null;
        }
    }
    public function username($email, $password) {
        //User existence check
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $email);
        $statement->execute();
        $user = $statement->fetch();
        if (!$user) {
            throw new Exception("The user with the given name does not exist.");
        }
        //The password parameter is the name of a column in the db
        $storedPassword = $user['password'];
        // Password verification
        if (!password_verify($password, $storedPassword)) {
            throw new Exception("Incorrect password.");
        }
        // Starting a session and storing user information
        session_start();
        $_SESSION['idUSer'] = $user['ID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['status'] = $user['status'];
    }
    public function logout() {
        session_start();
        session_unset(); // Delete all session variables
        session_destroy();
        header('Location: http://localhost/aiyau_ram/index.php');
        exit();
    }
    public function isAdmin(){
        session_start();
        if (isset($_SESSION['status']) && $_SESSION['idUSer']) {
            if($_SESSION['status'] == 'admin'){
                echo "admin is here";
                return true;
            }else{
                echo "session started, but there is no admin";
            }
        }else{
            echo "session not found";
            return false;
        }
    }
}