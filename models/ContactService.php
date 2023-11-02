<?php
class ContactService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function formatData($data)
    {
        return date('d/m/Y', strtotime($data));
    }

    public function getAllContacts()
    {
        $contacts = [];
        $query = $this->conn->query("SELECT * FROM estoque_laboratorio WHERE st = 1");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact = new Contact();
            $contact->id = $row["id"];
            $contact->name = $row["nome"];
            $contact->laboratory = $row["laboratorio"];
            $contact->date = $row["data"];
            $contact->quantity = $row["quantidade"];
            $contact->reagent = $row["reagente"];
            $contacts[] = $contact;
        }
        return $contacts;
    }

    public function insertContacts(Contact $contact)
    {
        try {
            $query = "INSERT INTO estoque_laboratorio(nome, laboratorio, quantidade, data, reagente) VALUES (:name, :laboratory, :quantity, :date, :reagent)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', $contact->getName());
            $stmt->bindValue(':laboratory', $contact->getLaboratory());
            $stmt->bindValue(':quantity', $contact->getQuantity());
            $stmt->bindValue(':date', $contact->getDate());
            $stmt->bindValue(':reagent', $contact->getReagent());
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir" . $e);
        }
    }


    public function updateContacts(Contact $contact)
    {
        $query = "UPDATE estoque_laboratorio SET id = :id, nome = :name, laboratorio = :laboratory, quantidade = :quantity, data = :date, reagente = :reagent WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $contact->getId());
        $stmt->bindValue(':name', $contact->getName());
        $stmt->bindValue(':laboratory', $contact->getLaboratory());
        $stmt->bindValue(':quantity', $contact->getQuantity());
        $stmt->bindValue(':date', $contact->getDate());
        $stmt->bindValue(':reagent', $contact->getReagent());
        $stmt->execute();
    }

    public function removeItem($id){
        $query = "UPDATE estoque_laboratorio SET st = 2 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
