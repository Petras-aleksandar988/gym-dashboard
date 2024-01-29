<?php  
session_start();

include 'config/config.php';

$conn = mysqli_connect($config['servername'],
$config['db_username'],
$config['db_password'],
$config['database_name']);

if(!$conn){
  die();
}


require_once "header.php";

?>


