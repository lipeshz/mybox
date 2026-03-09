<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "msg" => "Sessão inválida!"]);
    exit;
}
require('../models/EquipmentDAO.php');
$dao = new EquipmentDAO();
$equipment = new Equipment();
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if(!$data){
    echo json_encode(["status" => "error", "msg" => "Invalid data!"]);
    exit;
}

$name = $data['name'] ?? '';
$photo = $data['photo'] ?? '';
$quantity = $data['quantity'] ?? 0;
$manufacturer = $data['manufacturer'] ?? '';
$date = $data['date'] ?? '';
$dateObj = new DateTime($date);
$warranty = ($data['warranty'] ?? '')." ".($data['warranty_type'] ?? '');

$equipment->setName($name);
$equipment->setPhoto($photo);
$equipment->setQuantity($quantity);
$equipment->setManufacturer($manufacturer);
$equipment->setDate($dateObj->format('d/m/Y'));
$equipment->setWarranty($warranty);
$equipment->setSpecifications($data);
$equipment->setOwner($_SESSION['id']);

header('Content-Type: application/json');

if($dao->insertEquip($equipment)){
    echo json_encode([
        "status" => "success",
        "response" => ["msg" => "Cadastrado!"]
    ]);
}else{
    echo json_encode([
        "status" => "error",
        "response" => ["msg" => "Erro ao salvar no banco"]
    ]);
}
exit;