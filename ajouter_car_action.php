<?php

function email_valide($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function resize_img($image_path,$image_dest,$max_size = 300,$qualite = 100,$type = 'auto',$upload = false){

  // Vérification que le fichier existe
  if(!file_exists($image_path)):
    return 'wrong_path';
  endif;

  if($image_dest == ""):
    $image_dest = $image_path;
  endif;
  // Extensions et mimes autorisés
  $extensions = array('jpg','jpeg','png','gif');
  $mimes = array('image/jpeg','image/gif','image/png');

  // Récupération de l'extension de l'image
  $tab_ext = explode('.', $image_path);
  $extension  = strtolower($tab_ext[count($tab_ext)-1]);

  // Récupération des informations de l'image
  $image_data = getimagesize($image_path);

  // Si c'est une image envoyé alors son extension est .tmp et on doit d'abord la copier avant de la redimentionner
  if($upload && in_array($image_data['mime'],$mimes)):
    copy($image_path,$image_dest);
    $image_path = $image_dest;

    $tab_ext = explode('.', $image_path);
    $extension  = strtolower($tab_ext[count($tab_ext)-1]);
  endif;

  // Test si l'extension est autorisée
  if (in_array($extension,$extensions) && in_array($image_data['mime'],$mimes)):
    
    // On stocke les dimensions dans des variables
    $img_width = $image_data[0];
    $img_height = $image_data[1];

    // On vérifie quel coté est le plus grand
    if($img_width >= $img_height && $type != "height"):

      // Calcul des nouvelles dimensions à partir de la largeur
      if($max_size >= $img_width):
        return 'no_need_to_resize';
      endif;

      $new_width = $max_size;
      $reduction = ( ($new_width * 100) / $img_width );
      $new_height = round(( ($img_height * $reduction )/100 ),0);

    else:

      // Calcul des nouvelles dimensions à partir de la hauteur
      if($max_size >= $img_height):
        return 'no_need_to_resize';
      endif;

      $new_height = $max_size;
      $reduction = ( ($new_height * 100) / $img_height );
      $new_width = round(( ($img_width * $reduction )/100 ),0);

    endif;

    // Création de la ressource pour la nouvelle image
    $dest = imagecreatetruecolor($new_width, $new_height);

    // En fonction de l'extension on prépare l'iamge
    switch($extension){
      case 'jpg':
      case 'jpeg':
        $src = imagecreatefromjpeg($image_path); // Pour les jpg et jpeg
      break;

      case 'png':
        $src = imagecreatefrompng($image_path); // Pour les png
      break;

      case 'gif':
        $src = imagecreatefromgif($image_path); // Pour les gif
      break;
    }

    // Création de l'image redimentionnée
    if(imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)):

      // On remplace l'image en fonction de l'extension
      switch($extension){
        case 'jpg':
        case 'jpeg':
          imagejpeg($dest , $image_dest, $qualite); // Pour les jpg et jpeg
        break;

        case 'png':
          $black = imagecolorallocate($dest, 0, 0, 0);
          imagecolortransparent($dest, $black);

          $compression = round((100 - $qualite) / 10,0);
          imagepng($dest , $image_dest, $compression); // Pour les png
        break;

        case 'gif':
          imagegif($dest , $image_dest); // Pour les gif
        break;
      }

      return 'success';
      
    else:
      return 'resize_error';
    endif;

  else:
    return 'no_img';
  endif;
}

// Include the database configuration file 
include_once 'dbConfig.php';


$target_dir = "C:/xampp/htdocs/fichiers/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$image_name = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$modele = $_POST['modele'];
$prix = $_POST['prix'];
$couleur = $_POST['couleur'];
$mat = $_POST['mat'];
$marque = $_POST['marque'];
$type_carb = $_POST['type_carb'];

$dispo = (bool)$_POST['dispo'];
$manual = (bool)$_POST['manual'];

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




if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if(isset($_FILES['fileToUpload'])) { // Si le formulaire est envoyé
  //foreach($_FILES['fileToUpload']['name'] as $file) { // On traite le tableau retourné par file
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
      return;
    }
  //}
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    try{
        $requete = $bdd->prepare('CALL ajouter_voiture(?,?,?,?,?,?,?,?,?)');
        $requete->execute(array($modele,$prix,$couleur,$manual,$dispo,$marque,$mat,$type_carb,$image_name));
        $requete->closeCursor();
        echo 'ajout effucter avec succes';
    }
    catch(Exception $exp){
        die('erreur : '. $exp->getMessage());
    }   
    
    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


?>