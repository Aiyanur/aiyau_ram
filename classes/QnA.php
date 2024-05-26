<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once('db/config.php');

class QnA
{      //a basic database class
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $config = DATABASE;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
        try {
            $this->conn = new PDO('mysql:host=' . $config['HOST'] . ';dbname=' . $config['DBNAME'] . ';port=' . $config['PORT'], $config['USER_NAME'],
                $config['PASSWORD'], $options);
        } catch (PDOException $e) {
            die("Error connection: " . $e->getMessage());
        }
    }

    public function insertQnA()
    {            //function allows entering data into the database
        try {
            // Načítanie JSON súboru
            $data = json_decode(file_get_contents('data/datas.json'), true);
            $questions = $data["questions"];
            $answers = $data["answers"];
            // Vloženie otázok a odpovedí v rámci transakcie
            $this->conn->beginTransaction();
            $sqlCheck = "SELECT COUNT(*) AS count FROM faq WHERE question = :question AND answer = :answer";
            $statementCheck = $this->conn->prepare($sqlCheck);

            $sqlInsert = "INSERT INTO faq (question, answer) VALUES (:question, :answer)";
            $statementInsert = $this->conn->prepare($sqlInsert);

            for ($i = 0; $i < count($questions); $i++) {
                // Kontrola, či takýto záznam už existuje
                $statementCheck->bindParam(':question', $questions[$i]);
                $statementCheck->bindParam(':answer', $answers[$i]);
                $statementCheck->execute();
                $result = $statementCheck->fetch(PDO::FETCH_ASSOC);

                if ($result['count'] == 0) {
                    // Ak záznam neexistuje, vložim nový
                    $statementInsert->bindParam(':question', $questions[$i]);
                    $statementInsert->bindParam(':answer', $answers[$i]);
                    $statementInsert->execute();
                }
            }
            $this->conn->commit();
        } catch (Exception $e) {
            // Zobrazenie chybového hlásenia
            echo "Chyba pri vkladaní dát do databázy: " . $e->getMessage();
            $this->conn->rollback();
            // Vrátenie späť zmien v prípade chyby
        }
    }

    public function getQnA()
    {      //retrieving questions and answers from the database
        try {
            $sql = "SELECT DISTINCT question, answer FROM faq";
            $statement = $this->conn->query($sql);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Chyba pri dostavani dát z databázy: " . $e->getMessage());
        } finally {
            // Uzatvorenie spojenia
            $this->conn = null;
        }
    }


    public function deleteQnA($question)
    {
        try {
            $sql = "DELETE FROM faq WHERE question = :question";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':question', $question);
            $statement->execute();
            echo "Q&A pair deleted successfully.";
        } catch (PDOException $e) {
            throw new Exception("Error deleting Q&A pair: " . $e->getMessage());
        }
    }

    public function updateQnA($question, $newAnswer)
    {
        try {
            $sql = "UPDATE faq SET answer = :newAnswer WHERE question = :question";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':question', $question);
            $statement->bindParam(':newAnswer', $newAnswer);
            $statement->execute();
            echo "Q&A pair updated successfully.";
        } catch (PDOException $e) {
            throw new Exception("Error updating Q&A pair: " . $e->getMessage());
        }
    }

}


?>