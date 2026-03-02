<?php
// CÓDIGO USADO APENAS PARA TESTE - FAVOR DESCONSIDERAR
require('../models/UserDAO.php');
session_start();

$dao = new UserDAO();
$user = new User();

$option = [
    'memory_cost' => 65536,
    'time_cost' => 4,
    'threads' => 1
];

// Criptografa a senha usando as configurações de memória.
$hash = password_hash($_POST['pass'], PASSWORD_ARGON2ID,  $option);

// Insere as informações no objeto que será cadastrado.
$user->setLogin($_POST['register']);
$user->setPassword($hash);

// Insere o objeto no banco.
$dao->insertUser($user);

$_SESSION['id'] = $user->getId();
$_SESSION['login'] = $user->getLogin();
header('Location:../views/index.php');
exit;