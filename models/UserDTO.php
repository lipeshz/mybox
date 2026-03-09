<?php
// Modificadores de banco.

class User{
    private $id;
    private $login;
    private $email;
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

    function setEmail($email){
        $this->email = $email;
    }

    function getEmail(){
        return $this->email;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }
}