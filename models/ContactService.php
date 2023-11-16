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
        $query = $this->conn->query(" SELECT id, nome, laboratorio, data, quantidade, reagente, grupo_residuo, data_coleta, descricao, nome_item
                                      FROM estoque_laboratorio 
                                      WHERE st = 1 ");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact = new Contact();
            $contact->id = $row["id"];
            $contact->name = $row["nome"];
            $contact->laboratory = $row["laboratorio"];
            $contact->date = $row["data"];
            $contact->quantity = $row["quantidade"];
            $contact->reagent = $row["reagente"];
            $contact->residueGroup = $row["grupo_residuo"];
            $contact->pickupDate = $row["data_coleta"];
            $contact->description = $row["descricao"];
            $contact->itemName = $row["nome_item"];
            $contacts[] = $contact;
        }
        return $contacts;
    }

    public function updateImagePath($id, $imagePath)
    {
        try {
            $query = "UPDATE estoque_laboratorio SET caminho_imagem = :imagePath WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar caminho da imagem" . $e);
        }
    }

    public function insertContacts(Contact $contact)
    {
        try {
            $query = "INSERT INTO estoque_laboratorio(nome, laboratorio, quantidade, data, reagente, grupo_residuo, data_coleta, descricao, nome_item) VALUES (:name, :laboratory, :quantity, :date, :reagent, :residueGroup, :pickupDate, :description, :itemName)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', $contact->getName());
            $stmt->bindValue(':laboratory', $contact->getLaboratory());
            $stmt->bindValue(':quantity', $contact->getQuantity());
            $stmt->bindValue(':date', $contact->getDate());
            $stmt->bindValue(':reagent', $contact->getReagent());
            $stmt->bindValue(':residueGroup', $contact->getresidueGroup());
            $stmt->bindValue(':pickupDate', $contact->getPickupDate());
            $stmt->bindValue(':description', $contact->getDescription());
            $stmt->bindValue(':itemName', $contact->getItemName());
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir" . $e);
        }
    }


    public function updateContacts(Contact $contact)
    {
        $query = "UPDATE estoque_laboratorio SET id = :id, nome = :name, laboratorio = :laboratory, quantidade = :quantity, data = :date, reagente = :reagent,  descricao = :description, grupo_residuo = :residueGroup, data_coleta = :pickupDate, nome_item = :itemName, caminho_imagem = :imagePath WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $contact->getId());
        $stmt->bindValue(':name', $contact->getName());
        $stmt->bindValue(':laboratory', $contact->getLaboratory());
        $stmt->bindValue(':quantity', $contact->getQuantity());
        $stmt->bindValue(':date', $contact->getDate());
        $stmt->bindValue(':reagent', $contact->getReagent());
        $stmt->bindValue(':residueGroup', $contact->getresidueGroup());
        $stmt->bindValue(':residueGroup', $contact->getresidueGroup());
        $stmt->bindValue(':pickupDate', $contact->getPickupDate());
        $stmt->bindValue(':description', $contact->getDescription());
        $stmt->bindValue(':itemName', $contact->getItemName());
        $stmt->bindValue(':imagePath', $contact->getImagePath());
        $stmt->execute();
    }

    public function removeItem($id)
    {
        $query = "UPDATE estoque_laboratorio SET st = 2 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return true;
    }

    public function filterResidueGroup($residue)
    {
        $mapping = [
            'soh' => 0,
            'sonh' => 1,
            'sopp' => 2,
            'aquaso' => 3,
            'aquosocromo' => 4,
            'aquosocianeto' => 5,
            'solido' => 6
        ];

        if (isset($mapping[$residue])) {
            $position = $mapping[$residue];
            $listResidue = ['SOH', 'SOñH', "SOPP", 'Aquoso sem cromo e cianeto', 'Aquoso com cromo', 'Aquoso com cianeto', 'Sólido'];
            return $listResidue[$position];
        } else {
            return "Valor inválido";
        }
    }

    public function filterLaboratory($laboratory)
    {
        $mapping = [
            'lab1' => 1,
            'lab2' => 2,
            'lab3' => 3,
            'lab4' => 4,
            'lab5' => 5,
            'lab6' => 6,
            'lab7' => 7,
            'lab8' => 8,
            'lab9' => 9,
            'lab10' => 10,
            'lab11' => 11,
            'salaCoor' => 12,
            'sala101' => 13,
            'sala101A' => 14,
            'sala102' => 15,
            'sala104' => 16,
            'sala111' => 17,
        ];
        
        if (isset($mapping[$laboratory])) {
            $position = $mapping[$laboratory];
            $laboratorys = ['Laboratório 1', 'Laboratório 2', 'Laboratório 3', 'Laboratório 4', 'Laboratório de Espectrofotometria', 'Laboratório de Potenciometria', 'Laboratório de Cromatografia', 'Laboratório de Microbiologia', 'Laboratório de Polímeros', 'Laboratório de Pesquisa', 'Laboratório de Preparo', 'Sala de Coordenação', 'Sala de Aula – 101', 'Sala de Professores – 101A', 'Sala de Professores – 102', 'Sala de Aula – 104', 'Sala de Aula – 111'];
            return $laboratorys[$position];
        } else {
            return "Valor inválido";
        }

    }

    public function searchContacts($searchValue){
        $query = "SELECT * FROM estoque_laboratorio WHERE st = 1 AND nome_item LIKE :searchValue";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
