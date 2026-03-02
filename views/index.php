<?php
session_start();
if(!isset($_SESSION['id']))
    header('Location:login.php');

echo "Bem-vindo " . $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu inventário | Mybox</title>
</head>
    <body>
         <header>
            <button>FILTER</button>
            <button>ADD +</button>
            
         </header>
    </body>
</html>