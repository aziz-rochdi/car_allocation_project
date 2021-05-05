<?php

// Include the database configuration file 
include_once 'dbConfig.php';

if(isset($_POST['email'])){

    try{

        $req = $bdd->prepare('SELECT id, mot_de_passe FROM tclients WHERE email = :email');
        $req->execute(array(
        'email' => $_POST['email']));
        $resultat = $req->fetch();
        
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['mot_de_passe']);
        
        if (!$resultat)
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) {
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: index.php');
            }
            else {
                echo 'Mauvais identifiant ou mot de passe !';
            }
        }
        }
        catch(Exception $ex){
            echo 'error ';
        }
        
}

?>