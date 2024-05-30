<?php
require_once 'Database.php';

class Faq {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function insertFaq()
    {
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

    public function getFaq() {
        $sql = "SELECT * FROM faq";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function deleteFaq($question) {
        $sql = "DELETE FROM faq WHERE question = :question";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':question', $question);
        $stmt->execute();
    }

    public function updateFaq($newQuestion, $newAnswer) {
        $sql = "UPDATE faq SET answer = :newAnswer WHERE question = :newQuestion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':newQuestion', $newQuestion);
        $stmt->bindParam(':newAnswer', $newAnswer);
        $stmt->execute();
    }
}
?>
