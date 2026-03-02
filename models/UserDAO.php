<?php
// Chama a classe do banco de dados e dos getters e setters.
require_once('../controllers/database.php');
require_once('UserDTO.php');

class UserDAO{
    // Variável de controle da conexão com o banco de dados.
    private $conn;

    // Verifica se já há uma conexão toda vez que um objeto do tipo user for instanciado ou modificado.
    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function insertUser($user){
        // Prepara a query SQL
        $query = "INSERT INTO users (login, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Subdtitui os campos pelos dados do objeto.
        $stmt->execute([
            $user->getLogin(),
            $user->getPassword()
        ]);

        // Verifica se alterou algo no banco.
        return $stmt->rowCount();
    }

    public function editUser($user){
        $query = "UPDATE users SET login = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getId()
        ]);

        return $stmt->rowCount();
    }

    public function deleteUser($id){
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $id
        ]);

        return $stmt->rowCount();
    }

    public function getUserByLogin($login){
        $query = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $login
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $u = new User;
            $u->setId($row['id']);
            $u->setLogin($row['login']);
            $u->setPassword($row['password']);

            return $u;
        }
        return null;
    }
}