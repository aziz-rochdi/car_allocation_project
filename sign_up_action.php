<?php

function email_valide($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}



try{
    $bdd = new PDO('mysql:host=localhost;dbname=allocation_voiture','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exp){
    die('erreur : '. $exp->getMessage());
}

if( strcmp($_POST['firstname'],"") == 0 OR strcmp($_POST['lastname'],"") == 0){
    echo "veuillez vérifier que vous avez remplir tous les champs !";
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "Email n 'est pas valide !\n";
}

else if (strcmp($_POST['password'],"") == 0 OR strcmp($_POST['password-repeat'],$_POST["password"]) != 0){
    echo "veuillez vérifier que le champ de mot de passe contient plus que 8 caracteres et que vous avez le resaisi correctement !";
}

$requete1 = $bdd->prepare('CALL email_existe(?)');
$requete1->execute(array($_POST['email']));
/*
if($requete1->fetchAll()){
    echo "email deja existe !";
    $requete1->closeCursor();
}

else{*/
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];

    // Hachage du mot de passe
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    try{
        $requete = $bdd->prepare('CALL ajouter_client(?,?,?,?)');
        $requete->execute(array($fname,$lname,$email,$password));
        $requete->closeCursor();
        header('Location: login.html');
    }
    catch(Exception $exp){
        die('erreur : '. $exp->getMessage());
    }
        
    

//}



?>