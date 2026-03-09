<?php
require_once('../controllers/database.php');
require_once('EquipmentDTO.php');

class EquipmentDAO{
    private $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function insertEquip($equipment){
        $query = "INSERT INTO equipments (name, photo, quantity, manufacturer, date, warranty, specifications, owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $equipment->getName(),
            $equipment->getPhoto(),
            $equipment->getQuantity(),
            $equipment->getManufacturer(),
            $equipment->getDate(),
            $equipment->getWarranty(),
            $equipment->getSpecifications(),
            $equipment->getOwner()
        ]);

        return $stmt->rowCount();
    }

    public function editEquip($equipment){
        $query = "UPDATE equipments SET name = ?, photo = ?, quantity = ?, manufacturer = ?, date = ?, warranty = ?, specfications = ?, owner = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $equipment->getName(),
            $equipment->getPhoto(),
            $equipment->getQuantity(),
            $equipment->getManufacturer(),
            $equipment->getDate(),
            $equipment->getWarranty(),
            $equipment->getSpecifications(),
            $equipment->getOwner()
        ]);

        return $stmt->rowCount();
    }

    public function deleteEquip($id){
        $query = "DELETE FROM equipments WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $id
        ]);
    }

    public function getEquipmentByName($name){
        $query = "SELECT * FROM equipments WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $name
        ]);
        // Define o retorno da linha como um array associativo.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se retornou alguma linha do banco. Se sim, irá preencher o objeto com os dados retornados.
        if($row){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);
            $e->setSpecifications($row['specification']);
            $e->setOwner($row['owner']);
            return $e;
        }
        // Se não encontrar nada, retorna null.
        return null;
    }

    public function getByOwner($id){
        $query = "SELECT * FROM equipments WHERE owner = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $id
        ]);
        $equipments = [];
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);
            $e->setSpecifications($row['specifications']);
            $e->setOwner($row['owner']);
            array_push($equipments, $e);
        }
        return $equipments;
    }

    public function getEquipmentByManufacturer($manufacturer){
        $query = "SELECT * FROM equipments WHERE manufacturer = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $manufacturer
        ]);
        $equipments = [];

        

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);
            $e->setSpecifications($row['specification']);
            $e->setOwner($row['owner']);
            array_push($equipments, $e);
        }
        return $equipments;
    }

    public function getEquipmentByType($type){
        $query = "SELECT * FROM equipments WHERE type = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $type
        ]);
        $equipments = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);
            $e->setSpecifications($row['specification']);
            $e->setOwner($row['owner']);
            array_push($equipments, $e);
        }
        return $equipments;
    }

    public function getAllEquip(){
        $query = "SELECT * FROM equipments";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $equipments = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setPhoto(['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);
            $e->setSpecifications($row['specification']);
            $e->setOwner($row['owner']);
            array_push($equipments, $e);
        }
        return $equipments;
    }
}