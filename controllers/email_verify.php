<?php
require('../models/UserDAO.php');
$email = $_GET['email'];
$dao = new UserDAO;
$user = $dao->getUserByEmail($email);

if($user){
    echo json_encode([
        "status" => "error",
        "response" => ["msg" => "E-mail already registered!"]
    ]);
}else{
    echo json_encode([
        "status" => "success",
        "response" => ["msg" => "E-mail is valid!"]
    ]);
}