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
  
//$requete->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>cars</title>
    <style>
        .photo_principale{
            width: 100%;
            height: auto; 
        }

    </style>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="assets/css/Button-modal-ecommerce-1.css">
    <link rel="stylesheet" href="assets/css/Button-modal-ecommerce.css">
    <link rel="stylesheet" href="assets/css/Card-Group-Classic.css">
    <link rel="stylesheet" href="assets/css/Card-Group1-Shadow.css">
    <link rel="stylesheet" href="assets/css/Filter.css">
    <link rel="stylesheet" href="assets/css/gradient-navbar-1.css">
    <link rel="stylesheet" href="assets/css/gradient-navbar.css">
    <link rel="stylesheet" href="assets/css/project-card.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body style="background: rgb(234,206,206);">
    <nav class="navbar navbar-dark navbar-expand-md" id="app-navbar">
        <div class="container-fluid"><a class="navbar-brand" href="#"><i class="icon ion-model-s" id="brand-logo"></i></a><span>ROCHDI CAR</span><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="cars.html">Cars</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                    <li class="nav-item text-center"><a class="nav-link" href="#"></a>
                        <div class="nav-item dropdown" style="color: red;"><a aria-expanded="false" data-toggle="dropdown" href="#" style="color: white;"><i class="fa fa-user-circle-o"></i></a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="login.html">log in</a><a class="dropdown-item" href="sign_up.html">sign up</a><a class="dropdown-item" href="#">profil</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="filter">
    <form>
        <input placeholder="e.g Blue Chair, Sofa or Post Modern"></input><br>
        <select>
             <option value="">Type</option>
        </select>
    <select>
             <option value="">Colours</option>
        </select>
    <select>
             <option value="">Size</option>
        </select>
    <select>
             <option value="">Price</option>
        </select>
    <select>
             <option value="">Delivery</option>
        </select>
    
    
    </form>
</div>
    <div>
        <div class="container">
            <div class="cust_bloglistintro">
                <h2 class="text-center">Latest Articles</h2>
                <p class="text-muted text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae.&nbsp; </p>
            </div>
            <div class="row">
                <?php
                    $sql = $bdd->query('SELECT * FROM tvoitures');
                    foreach ($sql as $row) {
                ?>
                <div class="col-md-4 cust_blogteaser card_container"><a href="#"><img class="img-fluid photo_principale" src="http://localhost/fichiers/<?=$row['image_path']?>"></a>
                    <h3>Heading</h3>
                    <p class="text-secondary">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id. </p>
                    <div><a class="bs4_modal_trigger" href="#" data-modal-id="bs4_sldr_cmrce_1_1<?=$row['id_voiture']?>" data-toggle="modal">Trigger</a>
                        <div id="bs4_sldr_cmrce_1_1<?=$row['id_voiture']?>" class="modal fade bs4_modal bs4_blue bs4_bg_white bs4_bd_black bs4_bd_semi_trnsp bs4_none_radius bs4_shadow_none bs4_center bs4_animate bs4FadeInDown bs4_duration_md bs4_easeOutQuint bs4_size_sldr_cmrce" role="dialog" data-modal-backdrop="true" data-show-on="click" data-modal-delay="false" data-modal-duration="false">
                            <div class="modal-dialog">
                                <div class="modal-content"><a class="bs4_btn_x_out_shtr bs4_sldr_cmrce_close" href="#" data-dismiss="modal">close</a>
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div id="bs4_sldr_commerce<?=$row['id_voiture']?>" class="carousel slide bs4-carousel bs4_sldr_cmrce_indicators thumb-scroll-x swipe-x bs4s_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active"><img src="http://localhost/fichiers/<?=$row['image_path']?>" alt="bs4_slider_commerce_01"></div>
                                                </div>
                                            </div>
                                            <form action="modifier_voiture_action.php" method="POST" enctype="multipart/form-data">
                                                <input type="text" name="id_voiture" class="d-none" value="<?=$row['id_voiture']?>"/>
                                                <input type="file" name="fileToUpload[]" multiple/><br><br>
                                                
                                                <select class="" name="choix_image">
                                                    <optgroup label="selectionner une choix">
                                                        <option value="many_images" selected="">ajouter images</option>
                                                        <option value="one_image">modifier image principale</option>
                                                    </optgroup>
                                                </select>
                                                
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <div class="bs4_sldr_cmrce_txt">

                                                <h1>veuillez remplir les informations du nouvelle voiture </h1>

                                                    <div class="bs4_form_num"><label>prix</label><input class="form-control" type="number" name="prix" min="0" value="<?=$row['prix_jour']?>" ></div>
                                                    <div class="bs4_form_color"><label>couleur</label>
                                                        <select class="form-control form-control-sm" name="couleur">
                                                            <optgroup label="Pick a color">
                                                                <?php
                                                                    if($row['couleur'] == "RED"){
                                                                ?>
                                                                <option value="RED" selected="">RED</option>
                                                                <option value="BLUE">BLUE</option>
                                                                <option value="GREEN">GREEN</option>
                                                                <?php
                                                                    }else if($row['couleur'] == "BLUE"){
                                                                ?>
                                                                <option value="RED">RED</option>
                                                                <option value="BLUE" selected="">BLUE</option>
                                                                <option value="GREEN">GREEN</option>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <option value="RED">RED</option>
                                                                <option value="BLUE">BLUE</option>
                                                                <option value="GREEN" selected="">GREEN</option>
                                                                <?php
                                                                    }
                                                                ?>

                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="bs4_form_num"><label>modele</label><input class="form-control" type="number" name="modele" min="1998" max="2021" value="1998"></div>
                                                    <div class=""><label>marque</label>
                                                        <select class="form-control" name="marque">
                                                            <optgroup label="selectionner une marque">
                                                                <option value="<?=$row['marque']?>" selected=""><?=$row['marque']?></option>
                                                                <option value="ford" >ford</option>
                                                                <option value="mercides">mercides</option>
                                                                <option value="audi">audi</option>
                                                                <option value="dacia">dacia</option>
                                                                <option value="range">range</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class=""><label>disponibilite</label>
                                                        <select class="form-control" name="dispo">
                                                            <optgroup label="select a un option">
                                                            <?php
                                                                    if($row['dispo'] == "false"){
                                                                ?>
                                                                <option value="false" selected="">non</option>
                                                                <option value="true">oui</option>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <option value="true" selected="">oui</option>
                                                                <option value="false">non</option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class=""><label>type de carburant</label>
                                                        <select class="form-control" name="type_carb">
                                                            <optgroup label="select a un option">
                                                            <?php
                                                                    if($row['type_carb'] == "diesel"){
                                                                ?>
                                                                <option value="diesel" selected="">diesel</option>
                                                                <option value="essence">essence</option>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <option value="diesel" >diesel</option>
                                                                <option value="essence" selected="">essence</option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class=""><label>type</label>
                                                        <select class="form-control" name="manual">
                                                            <optgroup label="select a un option">
                                                                <?php
                                                                    if($row['manual'] == "false"){
                                                                ?>
                                                                <option value="false" selected="">automatique</option>
                                                                <option value="true">manuelle</option>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <option value="true" selected="">manuelle</option>
                                                                <option value="false">automatique</option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class=""><label>matricule</label>
                                                        <input type="text" value="<?=$row['matricule']?>" name="mat"/>
                                                    </div>

                                                    <div class="bs4_form_cmrce_btn"><button class="btn btn-primary bs4_btn_x_out_shtr" name="submit" type="submit" >valider la modification</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    $sql->closeCursor();
                ?>
                <div class="col-md-4 cust_blogteaser"><a href="#">
                        <div><a class="bs4_modal_trigger" href="#" data-modal-id="bs4_sldr_cmrce_1" data-toggle="modal">ajouter</a>
                            <div id="bs4_sldr_cmrce_1" class="modal fade bs4_modal bs4_blue bs4_bg_white bs4_bd_black bs4_bd_semi_trnsp bs4_none_radius bs4_shadow_none bs4_center bs4_animate bs4FadeInDown bs4_duration_md bs4_easeOutQuint bs4_size_sldr_cmrce" role="dialog" data-modal-backdrop="true" data-show-on="click" data-modal-delay="false" data-modal-duration="false">
                                <div class="modal-dialog">
                                    <div class="modal-content"><a class="bs4_btn_x_out_shtr bs4_sldr_cmrce_close" href="#" data-dismiss="modal">close</a>
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <div id="bs4_sldr_commerce" class="carousel slide bs4-carousel bs4_sldr_cmrce_indicators thumb-scroll-x swipe-x bs4s_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active"><img src="assets/img/bs4_slider_commerce_01.png" alt="bs4_slider_commerce_01"></div>

                                                    </div>
                                                </div>
                                                <form action="ajouter_car_action.php" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="fileToUpload"><br>

                                            </div>
                                            <div class="col-12 col-md-7">
                                                <div class="bs4_sldr_cmrce_txt">

                                                    <h1>veuillez remplir les informations du nouvelle voiture </h1>

                                                        <div class="bs4_form_num"><label>prix</label><input class="form-control" type="number" name="prix" min="0" ></div>
                                                        <div class="bs4_form_color"><label>couleur</label>
                                                            <select class="form-control form-control-sm" name="couleur">
                                                                <optgroup label="Pick a color">
                                                                    <option value="RED" selected="">RED</option>
                                                                    <option value="BLUE">BLUE</option>
                                                                    <option value="GREEN" selected="">GREEN</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class="bs4_form_num"><label>modele</label><input class="form-control" type="number" name="modele" min="1998" max="2021" value="1998"></div>
                                                        <div class=""><label>marque</label>
                                                            <select class="form-control" name="marque">
                                                                <optgroup label="selectionner une marque">
                                                                    <option value="ford" selected="">ford</option>
                                                                    <option value="mercides">mercides</option>
                                                                    <option value="audi">audi</option>
                                                                    <option value="dacia">dacia</option>
                                                                    <option value="range">range</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class=""><label>disponibilite</label>
                                                            <select class="form-control" name="dispo">
                                                                <optgroup label="select a un option">
                                                                    <option value="true" selected="">oui</option>
                                                                    <option value="false">non</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class=""><label>type de carburant</label>
                                                            <select class="form-control" name="type_carb">
                                                                <optgroup label="select a un option">
                                                                    <option value="gazoual" selected="">gazoual</option>
                                                                    <option value="diezel">diezel</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class=""><label>type</label>
                                                            <select class="form-control" name="manual">
                                                                <optgroup label="select a un option">
                                                                    <option value="true" selected="">manuelle</option>
                                                                    <option value="false">automatique</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class=""><label>matricule</label>
                                                            <input type="text" value="" name="mat"/>
                                                        </div>

                                                        <div class="bs4_form_cmrce_btn"><button class="btn btn-primary bs4_btn_x_out_shtr" type="submit">ajouter</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <footer>
        <div class="row">
            <div class="col-sm-6 col-md-4 footer-navigation">
                <h3><a href="#">rochdi car</a></h3>
                <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Cars</a><strong>&nbsp;</strong><a href="#"></a><strong> · </strong><a href="#">About</a><strong> &nbsp;· </strong><a href="#">Contact</a></p>
                <p class="company-name">rochdi car © 2021</p>
            </div>
            <div class="col-sm-6 col-md-4 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p><span class="new-line-span">211 majmaa elkair</span>settat, maroc</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left"> +212 6 13 53 44 51</p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank">aziz20rochdi@gmail.com</a></p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 footer-about">
                <h4>About the company</h4>
                <p> Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet. </p>
                <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a></div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Button-modal-ecommerce-1.js"></script>
    <script src="assets/js/Button-modal-ecommerce.js"></script>
</body>

</html>