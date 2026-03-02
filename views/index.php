<?php
session_start();
if(!isset($_SESSION['id']))
    header('Location:login.php');

require('../models/EquipmentDAO.php');
$dao = new EquipmentDAO();
$equipments = $dao->getByOwner($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu inventário | Mybox</title>
    <link rel="stylesheet" href="../css/index.css">
    
</head>
    <body>
         <header>
            <button>FILTER</button>
            <button id="btn-show">ADD +</button>
         </header>

         <div id="modal-equipments" class="modal-container">
            <div id="modal-content">
                <span id="btn-close" class="close">&times</span>
                <form action="../controllers/equipments_register.php">
                    <input type="text" name="name" id="" placeholder="Name">
                    <input type="file" name="photo" id="" placeholder="Photo">
                    <input type="number" name="quantity" id="" placeholder="Quantity">
                    <input type="text" name="manufacturer" id="" placeholder="Manufacturer">
                    <input type="date" name="date" id="">
                    <input type="number" name="warranty" id="" placeholder="Warranty">
                    <select name="warranty_type" id="">
                        <option value="month">MONTH</option>
                        <option value="year">YEAR</option>
                    </select>
                    <button>ADD +</button>
                </form>
            </div>
         </div>

         <main>
            <?php 
            if($equipments != []){
                foreach($equipments as $equipment){
                    echo $equipment->name;
                }
            }
            ?>
         </main>
    </body>
    <script src="../js/modal.js"></script>
</html>