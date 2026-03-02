<?php
// Impede que haja uma tentativa de Login forçada sem usar o login.
if(!isset($_POST['login']) || !isset($_POST['password'])){
    header('Location:../views/login.php');
    exit;
}

require('../models/UserDAO.php');
session_start();

// Inicializa o objeto User.
$dao = new UserDAO();
$user = $dao->getUserByLogin($_POST['login']);

if(!$user){
    // Inicializa a variável de sessão de erro, para que ele seja detectado no front-end. 
    $_SESSION['login_err'] = true;
    header('Location:../views/login.php');
}

if(password_verify($_POST['password'], $user->getPassword())){
    // Atribui ao usuário as informações do banco de dados.
    $_SESSION['id'] = $user->getId();
    $_SESSION['login'] = $user->getLogin(); 
    header('Location:../views/index.php');
    exit;
}else{
    $_SESSION['login_err'] = true;
    header('Location:../views/login.php');
    exit;
}