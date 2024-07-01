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
    public $location; 
    public $classification;
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

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    { 
        $this->location = $location;
    }

    public function getClassification()
    { 
        return $this->classification;
    }

    public function setClassification($classification)
    { 
        $this->classification = $classification;
    }
    public function getImagePath()
    {
        return $this->imagePath;
    }
    public function setImagePath($uploadFile)
    {
        $this->imagePath = $uploadFile;
    }
}
