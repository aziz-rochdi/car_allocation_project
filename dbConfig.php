<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "allocation_voiture";

try{
    $bdd = new PDO('mysql:host=localhost;dbname=allocation_voiture','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exp){
    die('erreur : '. $exp->getMessage());
}
?>

