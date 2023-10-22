<?php

class Contact
{
    public $id;
    public $laboratory;
    public $date;
    public $quantity;
    public $reagent;
    public $esporte_preferido;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }

    public function getEmail() { 
        return $this->email;
    }
    public function setEmail($email) { 
        $this->email = $email;
    }

    public function getPhone() { 
        return $this->phone;
    }
    public function setPhone($phone) { 
        $this->phone = $phone;
    }    
}
