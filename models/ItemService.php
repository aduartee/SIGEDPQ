<?php
class ItemService
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
            $item = new StockItem();
            $item->id = $row["id"];
            $item->name = $row["nome"];
            $item->laboratory = $row["laboratorio"];
            $item->date = $row["data"];
            $item->quantity = $row["quantidade"];
            $item->reagent = $row["reagente"];
            $item->residueGroup = $row["grupo_residuo"];
            $item->pickupDate = $row["data_coleta"];
            $item->description = $row["descricao"];
            $item->itemName = $row["nome_item"];
            $contacts[] = $item;
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

    public function insertContacts(StockItem $item)
    {
        try {
            $query = "INSERT INTO estoque_laboratorio(nome, laboratorio, quantidade, data, reagente, grupo_residuo, data_coleta, descricao, nome_item) VALUES (:name, :laboratory, :quantity, :date, :reagent, :residueGroup, :pickupDate, :description, :itemName)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', $item->getName());
            $stmt->bindValue(':laboratory', $item->getLaboratory());
            $stmt->bindValue(':quantity', $item->getQuantity());
            $stmt->bindValue(':date', $item->getDate());
            $stmt->bindValue(':reagent', $item->getReagent());
            $stmt->bindValue(':residueGroup', $item->getresidueGroup());
            $stmt->bindValue(':pickupDate', $item->getPickupDate());
            $stmt->bindValue(':description', $item->getDescription());
            $stmt->bindValue(':itemName', $item->getItemName());
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir" . $e);
        }
    }


    public function updateContacts(StockItem $item)
    {
        $query = "UPDATE estoque_laboratorio SET id = :id, nome = :name, laboratorio = :laboratory, quantidade = :quantity, data = :date, reagente = :reagent,  descricao = :description, grupo_residuo = :residueGroup, data_coleta = :pickupDate, nome_item = :itemName, caminho_imagem = :imagePath WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $item->getId());
        $stmt->bindValue(':name', $item->getName());
        $stmt->bindValue(':laboratory', $item->getLaboratory());
        $stmt->bindValue(':quantity', $item->getQuantity());
        $stmt->bindValue(':date', $item->getDate());
        $stmt->bindValue(':reagent', $item->getReagent());
        $stmt->bindValue(':residueGroup', $item->getresidueGroup());
        $stmt->bindValue(':residueGroup', $item->getresidueGroup());
        $stmt->bindValue(':pickupDate', $item->getPickupDate());
        $stmt->bindValue(':description', $item->getDescription());
        $stmt->bindValue(':itemName', $item->getItemName());
        $stmt->bindValue(':imagePath', $item->getImagePath());
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
            'lab1' => 0,
            'lab2' => 1,
            'lab3' => 2,
            'lab4' => 3,
            'lab5' => 4,
            'lab6' => 5,
            'lab7' => 6,
            'lab8' => 7,
            'lab9' => 8,
            'lab10' => 9,
            'lab11' => 10,
            'salaCoor' => 11,
            'sala101' => 12,
            'sala101A' => 13,
            'sala102' => 14,
            'sala104' => 15,
            'sala111' => 16,
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
