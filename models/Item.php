<?php
class StockItem
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
    public $imagePath;

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

    public function getImagePath()
    {
        return $this->imagePath;
    }
    public function setImagePath($uploadFile)
    {
        $this->imagePath = $uploadFile;
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
                $item = new StockItem();
                $item->setName($row['nome']);
                $item->setLaboratory($row['laboratorio']);
                $item->setDate($row['data']);
                $item->setQuantity($row['quantidade']);
                $item->setReagent($row['reagente']);
                $item->setResidueGroup($row['grupo_residuo']);
                $item->setPickupDate($row['data_coleta']);
                $item->setDescription($row['descricao']);
                $item->setItemName($row['nome_item']);
                $item->setImagePath($row['caminho_imagem']);
                // var_dump($item);
                return $item;
            }
        } catch (PDOException $e) {
            echo 'Erro na query' . $e->getMessage();
            return null;
        }
    }
}
