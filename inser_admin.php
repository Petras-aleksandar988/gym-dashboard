<?php 
require_once "config.php";

 $username = 'aco';
 $password = 'sifra123';
 
 $hasdedPassword = password_hash($password, PASSWORD_DEFAULT);
 $sql = "INSERT INTO admins (username, password) VALUES (?,?)";
 $run = $conn -> prepare($sql); 
 $run -> bind_param("ss", $username, $hasdedPassword);
 $run -> execute();


?>