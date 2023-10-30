<?php
class ContactService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllContacts()
    {
        $contacts = [];
        $query = $this->conn->query("SELECT * FROM estoque_laboratorio");

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
            $query = "INSERT INTO estoque_laboratorio(nome, laboratorio, quantidade, data, reagente) VALUES (:name, :laboratory, :quantity, :date, reagent)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $contact->getName());
            $stmt->bindParam(':laboratory', $contact->getLaboratory());
            $stmt->bindParam(':quantity', $contact->getQuantity());
            $stmt->bindParam(':date', $contact->getDate());
            $stmt->bindParam(':reagent', $contact->getReagent());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao inserir" . $e);
            return false;
        }
    }

    public function updateContacts(Contact $contact)
    {
        $query = "UPDATE estoque_liberato SET nome = :name, labaratorio = :laboratory, quantidade = :quantity, data = :data, reagente = :reagent WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $contact->getId());
        $stmt->bindParam(':name', $contact->getName());
        $stmt->bindParam(':laboratory', $contact->getLaboratory());
        $stmt->bindParam(':quantity', $contact->getQuantity());
        $stmt->bindParam(':date', $contact->getDate());
        $stmt->bindParam(':reagent', $contact->getReagent());
        $stmt->execute();
    }
}