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
                <form method="POST">
                    <div class="input-form" data-name="name">
                        <label for="input-name">Name</label>
                        <input type="text" name="name" id="input-name" placeholder="Name" class="json-value" >
                    </div>
                    
                    <div class="input-form" data-name="photo"> 
                        <label for="input-date" class="json-key">Photo</label>
                        <input type="file" name="photo" id="input-photo" placeholder="Photo" class="json-value">
                    </div>
                    
                    <div class="input-form" data-name="quantity">
                        <label for="input-quantity" class="json-key">Quantity</label>
                        <input type="number" name="quantity" id="input-quantity" placeholder="Quantity" class="json-value">
                    </div>
                    
                    <div class="input-form" data-name="manufacturer">
                        <label for="input-manufacturer" class="json-key">Manufacturer</label>
                        <input type="text" name="manufacturer" id="input-manufacturer" placeholder="Manufacturer" class="json-value">
                    </div>
                    
                    <div class="input-form" data-name="date">
                        <label for="input-date" class="json-key">Date</label>
                        <input type="date" name="date" id="input-date" class="json-value">
                    </div>
                    
                    <div class="input-form" data-name="warranty">
                        <label for="input-warranty" class="json-key">Warranty</label>
                        <input type="number" name="warranty" id="input-warranty" placeholder="Warranty" class="json-value" data-name="warranty_type">
                    </div>

                    <div class="input-form" data-name="warranty_type">
                        <label for="input-warranty-type">Type</label>
                        <select name="warranty_type" id="input-warranty-type" class="json-value">
                            <option value="month">MONTH</option>
                            <option value="year">YEAR</option>
                        </select>
                    </div>
                    
                    <div id="input-container" class="input-container"></div>
                    <button type="button" id="add-input" onclick="addInput()">ADD +</button>
                    <button type="button" onclick="submitData()">ADD</button>
                </form>
            </div>
         </div>

         <main>
            <?php 
            if($equipments != []){
                foreach($equipments as $equipment){
                    echo '<p>'.$equipment->getName().'</p>';
                    echo '<p>'.$equipment->getQuantity().'</p>';
                    echo '<p>'.$equipment->getManufacturer().'</p>';
                    echo '<p>'.$equipment->getWarranty().'</p>';
                }
            }
            ?>
         </main>
    </body>

    <script src="../js/submit.js"></script>
    <script src="../js/add_input.js"></script>
    <script src="../js/modal.js"></script>
    <script src="../js/stringBuilder.js"></script>
</html>