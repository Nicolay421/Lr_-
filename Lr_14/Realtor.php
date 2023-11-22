<?php
class Realtor {
    private $pdo;
    public $id;
    public $name;
    public $contact_number;
    public $email;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public static function all(PDO $pdo) {
        $sql = "SELECT * FROM realtors";
        $stmt = $pdo->query($sql);

        $realtors = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $realtor = new Realtor($pdo);
            $realtor->id = $row['id'];
            $realtor->name = $row['name'];
            $realtor->contact_number = $row['contact_number'];
            $realtor->email = $row['email'];
            $realtors[] = $realtor;
        }

        return $realtors;
    }
    public function find($id) {
        $sql = "SELECT * FROM realtors WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $realtor = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($realtor) {
                $this->id = $realtor['id'];
                $this->name = $realtor['name'];
                $this->contact_number = $realtor['contact_number'];
                $this->email = $realtor['email'];
                return true;
            }
        }

        return false;
    }
    public function create($name, $contact_number, $email) {
        $sql = "INSERT INTO realtors (name, contact_number, email) VALUES (:name, :contact_number, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update() {
        $sql = "UPDATE realtors SET name = :name, contact_number = :contact_number, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':contact_number', $this->contact_number);
        $stmt->bindParam(':email', $this->email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete() {
        $sql = "DELETE FROM realtors WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
