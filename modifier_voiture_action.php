<?php

// Include the database configuration file 
include_once 'dbConfig.php';

function email_valide($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

//recuperer les données du formulaire
$id_voiture = $_POST['id_voiture'];
$modele = $_POST['modele'];
$prix = $_POST['prix'];
$couleur = $_POST['couleur'];
$mat = $_POST['mat'];
$marque = $_POST['marque'];
$type_carb = $_POST['type_carb'];
$choix_image = $_POST['choix_image'];



if(strcmp($_POST['dispo'],"true")){
    $dispo = true;
}
else{
    $dispo = false;
}

if(strcmp($_POST['manual'],"true")){
    $manual = true;
}
else{
    $manual = false;
}

if( strcmp($mat,"") == 0){
    echo "la matricule ne doit pas etre vide !";
}


if($choix_image == "one_image") { // Si le formulaire est envoyé

  $targetDir = "C:/xampp/htdocs/fichiers/"; 
  $allowTypes = array('jpg','png','jpeg','gif'); 
   
  $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = $sizeError = ''; 
  $fileNames = array_filter($_FILES['fileToUpload']['name']); 
  if(!empty($fileNames)){ 
      foreach($_FILES['fileToUpload']['name'] as $key=>$val){ 
          // File upload path 
          $fileName = basename($_FILES['fileToUpload']['name'][$key]); 
          $targetFilePath = $targetDir . $fileName; 
          // Check if file already exists
          if (file_exists($targetFilePath)) {
            echo "Sorry, file already exists.";
          }
          else{
                // Check file size
                if ($_FILES["fileToUpload"]["size"][$key] > 500000) { 
                    $sizeError = "Sorry, your file is too large " ." | ";
                }
                else{
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetFilePath)){ 
                          try{
                            $requete = $bdd->prepare('CALL modifier_voiture(?,?,?,?,?,?,?,?,?,?)');
                            $requete->execute(array($id_voiture, $modele,$prix,$couleur,$manual,$dispo,$marque,$mat,$type_carb,$fileName));
                            echo 'modification effectuée avec succes';
                          }
                          catch(Exception $exp){
                            die('erreur : '. $exp->getMessage());
                          } 
                        }else{ 
                            $errorUpload .= $_FILES['fileToUpload']['name'][$key].' | '; 
                        } 
                    }else{ 
                        $errorUploadType .= $_FILES['fileToUpload']['name'][$key].' n\'est une image '; 
                    } 
                }
            }

        }

    }

    echo "======>".$sizeError." ".$errorUpload." ".$errorUploadType."<======";
}
else{
  $targetDir = "C:/xampp/htdocs/fichiers/"; 
  $allowTypes = array('jpg','png','jpeg','gif'); 
   
  $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = $sizeError = ''; 
  $fileNames = array_filter($_FILES['fileToUpload']['name']); 
  if(!empty($fileNames)){ 
      foreach($_FILES['fileToUpload']['name'] as $key=>$val){ 
          // File upload path 
          $fileName = basename($_FILES['fileToUpload']['name'][$key]); 
          $targetFilePath = $targetDir . $fileName; 
          // Check if file already exists
          if (file_exists($targetFilePath)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          else{
                // Check file size
                if ($_FILES["fileToUpload"]["size"][$key] > 500000) { 
                    $sizeError = "Sorry, your file is too large " ." | ";
                }
                else{
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetFilePath)){ 
                            try{
                                $requete = $bdd->prepare('CALL ajouter_voiture_image(?,?)');
                                $requete->execute(array($id_voiture, $fileName));
                                echo 'ajout d\'image effectué avec succes';
                            }
                            catch(Exception $exp){
                                die('erreur : '. $exp->getMessage());
                            } 
                        }else{ 
                            $errorUpload .= $_FILES['fileToUpload']['name'][$key].' | '; 
                        } 
                    }else{ 
                        $errorUploadType .= $_FILES['fileToUpload']['name'][$key].' | '; 
                    } 
                }
            }

        }

    }
} 

?>