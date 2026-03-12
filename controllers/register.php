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

if(!isset($data)){
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "msg" => "Invalid data!"]);
    exit;
}

$login = trim($data['login'] ?? '');
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');
$pass_confirm = trim($data['password_confirmation'] ?? '');
$errors = [];

$regex_login = '/^(?=\S{6,}$)[\w.]+$/';
$regex_email = '/^(?=\S+$)[^\s@]+@[^\s@]+\.[^\s@]+$/';
$regex_password = '/^(?=\S{6,}$)(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

$option = [
    'memory_cost' => 65536,
    'time_cost' => 4,
    'threads' => 1
];

if(isset($login) && preg_match($regex_login, $login)){
    $user->setLogin($login);
}else{
    $erros["login"] = "Invalid login!";
}

if(isset($email) && !empty($email)){
    if(!preg_match($regex_email, $email)){
        $errors["email"] = "Invalid e-mail!";
    }else if($dao->getUserByEmail($email)){
        $errors["email"] = "E-mail already in use!";
    }else{
        $user->setEmail($email);
    }
}

if($password === '' || $pass_confirm === '' || !preg_match($regex_password, $password) || !preg_match($regex_password, $pass_confirm)){
    $errors['password_confirmation'] = "Invalid password!";
}else if($password !== $pass_confirm){
    $errors['password_confirmation'] = "Password don't match!";
}else{
    // Criptografa a senha usando as configurações de memória.
    $hash = password_hash($password, PASSWORD_ARGON2ID,  $option);
    $user->setPassword($hash);
}

// Insere o objeto no banco.
if(!empty($errors)){
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "errors" => $errors, "passwordaa" => $login]);
}else{
    $dao->insertUser($user);
    $_SESSION['id'] = $user->getId();
    $_SESSION['login'] = $user->getLogin();
    $_SESSION['email'] = $user->getEmail();

    header('Content-Type: application/json');
    echo json_encode(["status" => "success", "msg" => "User registered!"]);
}