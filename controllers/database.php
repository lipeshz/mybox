<?php

abstract class Database{
    // Variável de controle da existência de uma conexão aberta. 
    public static $instance;

    // O construtor impede que uma instancia da classe seja criada.
    private function __construct(){

    }

    // Verifica se a conexão já existe. Ela é public para que outras classes possam manipular os dados do banco.
    public static function getConnection(){
        if(!isset(self::$instance)){
            self::$instance = Database::createConnection();
        }

        return self::$instance;
    }

    // Cria a conexão com o banco de dados. É private para que as outras classes não possam acessar esse atributo.
    private static function createConnection(){
        // Declaração dos atributos da classe do DB
        $host = "localhost";
        $db_name = "mybox";
        $port = "5432";
        $username = "postgres";
        $password = "root";
        $str_conn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $db_name;

        try{
            // Instancia a conexão
            $pdo = new PDO($str_conn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
        // Lança uma exception caso algo dê errado
            throw new Exception("Erro ao conectar-se com a base de dados: [" . $e->getMessage() . "]");
        }
    }
}
