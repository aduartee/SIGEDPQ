<?php
class Contact
{
    public $id;
    public $itemName;
    public $name;
    public $laboratory;
    public $date;
    public $quantity;
    public $reagent;
    public $residueGroup;
    public $pickupDate;
    public $description; 

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLaboratory()
    {
        return $this->laboratory;
    }

    public function setLaboratory($laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getReagent()
    {
        return $this->reagent;
    }
    public function setReagent($reagent)
    {
        $this->reagent = $reagent;
    }
    public function getResidueGroup()
    {
        return $this->residueGroup;
    }

    public function setResidueGroup($residueGroup)
    {
        $this->residueGroup = $residueGroup;
    }

    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    public function setPickupDate($pickupDate)
    {
        $this->pickupDate = $pickupDate;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    public static function getById($conn, $id)
    {
        try {
            $query = "SELECT * FROM estoque_laboratorio WHERE id = :id";
            $prepare = $conn->prepare($query);
            $prepare->bindParam(':id', $id, PDO::PARAM_INT);
            $prepare->execute();
            $row = $prepare->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $contact = new Contact();
                $contact->setName($row['nome']);
                $contact->setLaboratory($row['laboratorio']);
                $contact->setDate($row['data']);
                $contact->setQuantity($row['quantidade']);
                $contact->setReagent($row['reagente']);
                $contact->setResidueGroup($row['grupo_residuo']);
                $contact->setPickupDate($row['data_coleta']);
                $contact->setDescription($row['descricao']);
                $contact->setItemName($row['nome_item']);
                // var_dump($contact);
                return $contact;
            }
        } catch (PDOException $e) {
            echo 'Erro na query' . $e->getMessage();
            return null;
        }
    }
}
