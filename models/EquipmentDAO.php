<?php
require_once('../controllers/database.php');
require_once('EquipmentDTO.php');

class EquipmentDAO{
    private $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function insertEquip($equipment){
        $query = "INSERT INTO equipments (name, type, photo, quantity, manufacturer, date, warranty) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $equipment->getName(),
            $equipment->getType(),
            $equipment->getPhoto(),
            $equipment->getQuantity(),
            $equipment->getManufacturer(),
            $equipment->getDate(),
            $equipment->getWarranty()
        ]);

        return $stmt->rowCount();
    }

    public function editEquip($equipment){
        $query = "UPDATE equipments SET name = ?, type = ?, photo = ?, quantity = ?, manufacturer = ?, date = ?, warranty = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $equipment->getName(),
            $equipment->getType(),
            $equipment->getPhoto(),
            $equipment->getQuantity(),
            $equipment->getManufacturer(),
            $equipment->getDate(),
            $equipment->getWarranty()
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
            $e->setType($row['type']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);

            return $e;
        }
        // Se não encontrar nada, retorna null.
        return null;
    }

    public function getEquipmentByManufacturer($manufacturer){
        $query = "SELECT * FROM equipments WHERE manufacturer = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $manufacturer
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setType($row['type']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);

            return $e;
        }

        return null;
    }

    public function getEquipmentByType($type){
        $query = "SELECT * FROM equipments WHERE type = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $type
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setType($row['type']);
            $e->setPhoto($row['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);

            return $e;
        }

        return null;
    }

    public function getAllEquip(){
        $query = "SELECT * FROM equipments";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            $e = new Equipment;
            $e->setId($row['id']);
            $e->setName($row['name']);
            $e->setType($row['type']);
            $e->setPhoto(['photo']);
            $e->setQuantity($row['quantity']);
            $e->setManufacturer($row['manufacturer']);
            $e->setDate($row['date']);
            $e->setWarranty($row['warranty']);

            return $e;
        }

        return null;
    }
}