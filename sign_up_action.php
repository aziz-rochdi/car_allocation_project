<?php

// Include the database configuration file 
include_once 'dbConfig.php';


$message = "";

if( strcmp($_POST['firstname'],"") == 0 OR strcmp($_POST['lastname'],"") == 0 ) {

    $message .= "veuillez vérifier que vous avez remplir tous les champs";
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message .= " || Email n 'est pas valide";
}

else if (strlen($_POST["password"]) < 8 OR strcmp($_POST['password-repeat'],$_POST["password"]) != 0){
    $message .= " || veuillez vérifier que le champ de mot de passe contient plus que 8 caracteres et que vous avez le resaisi correctement !";
}

if( $message == ""){
    $requete1 = $bdd->prepare('CALL email_existe(?)');
    $requete1->execute(array($_POST['email']));
    
    if($requete1->fetchAll()){
        echo "email deja existe !";
        $requete1->closeCursor();
    }
    
    else{
        $requete1->closeCursor();
    
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
    
        // Hachage du mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    
        try{
            $requete = $bdd->prepare('CALL ajouter_client(?,?,?,?)');
            $requete->execute(array($fname,$lname,$email,$password));
            $requete->closeCursor();
            header('Location: login.php');
        }
        catch(Exception $exp){
            die('erreur : '. $exp->getMessage());
        }
    }
}
else{
    echo $message;
}



?>