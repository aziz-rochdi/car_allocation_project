<?php

// Include the database configuration file 
include_once 'dbConfig.php';

//recuperer les données du formulaire
session_start();
$nombre_de_jours = $_POST['nbr_jours'];
$id_client = $_SESSION['id'];
$id_voiture = $_POST['id_voiture'];

try{
    $requete = $bdd->prepare('CALL reserver_voiture(?,?,?)');
    $requete->execute(array($id_client,$id_voiture,$nombre_de_jours));
    // echo 'reservation effectuée avec succes';
}
catch(Exception $exp){
    die('erreur : '. $exp->getMessage());
} 

header('Location: cars.php');

?>