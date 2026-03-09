<?php
class Equipment{
    private $id;
    private $name;
    // private $type;
    private $photo;
    private $quantity;
    private $manufacturer;
    private $date;
    private $warranty;
    private $specifications;
    private $owner;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    // public function setType($type){
    //     $this->type = $type;
    // }

    // public function getType(){
    //     return $this->type;
    // }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

    public function getPhoto(){
        return $this->photo;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setManufacturer($manufacturer){
        $this->manufacturer = $manufacturer;
    }

    public function getManufacturer(){
        return $this->manufacturer;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setWarranty($warranty){
        $this->warranty = $warranty;
    }

    public function getWarranty(){
        return $this->warranty;
    }

    public function setSpecifications($specifications){
        $this->specifications = json_encode($specifications);
    }

    public function getSpecifications(){
        return $this->specifications;
    }

    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function getOwner(){
        return $this->owner;
    }
}