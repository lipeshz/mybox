<?php
session_start();
if(isset($_SESSION['login'])){
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "msg" => "Sessão inválida!"]);
    exit;
}
require('../models/UserDAO.php');

$dao = new UserDAO();
$user = new User();
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$login = $data['login'];
$email = $data['email'];
$password = $data['password'];
$errors = [];

$regex_login = '/^[^\s]{6,}$/';
$regex_email = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
$regex_password = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

$option = [
    'memory_cost' => 65536,
    'time_cost' => 4,
    'threads' => 1
];

if(isset($login) && preg_match($regex_login, $login)){
    $user->setLogin($login);
}else{
    $erros["login_err"] = "Login inválido!";
}

if(isset($email) && preg_match($regex_email, $email)){
    if(!$dao->getUserByEmail($email)){
        $user->setEmail($email);
    }
}

if(isset($password) && preg_match($regex_password, $password)){
    // Criptografa a senha usando as configurações de memória.
    $hash = password_hash($_POST['pass'], PASSWORD_ARGON2ID,  $option);
    $user->setPassword($hash);
}

// Insere o objeto no banco.
$dao->insertUser($user);

$_SESSION['id'] = $user->getId();
$_SESSION['login'] = $user->getLogin();
$_SESSION['email'] = $user->getEmail();
header('Location:../views/index.php');
exit;