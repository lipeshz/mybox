<?php
// Modificadores de banco.

class User{
    private $id;
    private $login;
    private $password;

    function setId($id){
        $this->id = $id;
    }

    function getId(){   
        return $this->id;
    }

    function setLogin($login){
        $this->login = $login;
    }

    function getLogin(){
        return $this->login;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }
}