<?php

// Include the database configuration file 
include_once 'dbConfig.php';

//recuperer les données du formulaire

if ($_POST['password'] == ""){
    $id_client = $_POST['id_client'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cin = $_POST['cin'];
    if($prenom != "" and $nom != ""){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(preg_match("#[0][67][- \.?]?([0-9][0-9][- \.?]?){4}$#", $phone)){
                if(/**verifier cin */ true){
                    try{
                        $requete = $bdd->prepare('CALL modifier_client(?,?,?,?,?,?)');
                        $requete->execute(array($id_client,$cin,$email,$nom,$prenom,$phone));
                        $requete->closeCursor();
                        header('Location: profile.php');
                    }
                    catch(Exception $exp){
                        die('erreur : '. $exp->getMessage());
                    }
                }
                else{
                    echo "veulliez verirfier la format du CIN";
                }
            }
            else{
                echo "veulliez verifier la format du telephone";
            }

        }
        else{
            echo "format incorrect d'email ";
        }
    }
    else{
        echo "remplir toutes les champs";
    }
}
else{
    $id_client = $_POST['id_client'];
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $repeatNewPassword = $_POST['repeatNewPassword'];
    try{
        $req = $bdd->prepare('SELECT mot_de_passe FROM tclients WHERE id = :id_client');
        $req->execute(array(
        'id_client' => $_POST['id_client']));
        $resultat = $req->fetch();
        
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['mot_de_passe']);
        
        if (!$isPasswordCorrect)
        {
            echo 'password incorrecte';
        }
        else
        {
            if ($newPassword != "" and $newPassword == $repeatNewPassword) {
                // Hachage du mot de passe
                $password = password_hash($newPassword, PASSWORD_DEFAULT); 
                $requete = $bdd->prepare('CALL modifier_mot_de_passe(?,?)');
                $requete->execute(array($id_client,$password));
                $requete->closeCursor();
                header('Location: profile.php');
            }
            else {
                echo 'verifier que les champs de mot de passe sont remplis et  !';
            }
        }
        }
        catch(Exception $exp){
            die('erreur : '. $exp->getMessage());
        }
}


?>