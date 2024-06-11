<?php
require_once 'Database.php';

class ContactForm
{
    private $name;
    private $email;
    private $message;
    private $db;

    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->db = new Database();
    }

    public function save()
    {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':message', $this->message);

        return $stmt->execute();
    }
}
?>