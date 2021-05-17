<?php
 session_start();
// Include the database configuration file 
include_once 'dbConfig.php';
  
//$requete->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>cars</title>
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #table_details{
        margin-left: 50px;
        margin-right: auto;
        width: 100%;
        }
        #table_details tr{
            text-align: left;
        }
        .images{
            height: 200px;
            width: auto;
        }
    </style>
    <script>
        function resizeImage(id,largeur)
            {
                var prop = parseInt(document.getElementById(id).style.height)/parseInt(document.getElementById(id).style.width);
                var hauteur = largeur*prop;
                document.getElementById(id).style.height=hauteur+'px';
                document.getElementById(id).style.width=largeur+'px';
            }

    </script>
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <div class="filter">
            <br>
            <h2 class="text-center">chercher avec filtres </h2>
            <select class="filter" id="filter_marque">
                <option value=""></option>
                <option value="ford">ford</option>
                <option value="mercides">mercides</option>
                <option value="audi">audi</option>
            </select>

            <select class="filter" id="filter_couleur">
                <option value=""></option>
                <option value="red">rouge</option>
                <option value="green">vert</option>
                <option value="blue">bleu</option>
            </select>

            <select class="filter" id="filter_prix">
                <option value=""></option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="3000">3000</option>
            </select>

            <button id="button_filter" onclick="remplirPageVoitures()">chercher</button>
        
    </div>
    <div>
        <div class="container">
            <div class="cust_bloglistintro">
                <h2 class="text-center">Latest Articles</h2>
                <p class="text-muted text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae.&nbsp; </p>
            </div>
            <div class="row" id="row_cars">
            <?php
                $sth = $bdd->prepare('SELECT * FROM tvoitures');
                $sth->execute();
                $result = $sth->fetchAll();
                $sth->closeCursor();
                foreach ($result as $row) {
                ?>

                <div class="col-md-4 cust_blogteaser card myCard">
                    <a href="#"><img class="img-fluid images" src="http://localhost/fichiers/<?=$row['image_path']?>" ></a>
                    <h3><?=$row['marque']?></h3>
                
                    <!--<div><a class="bs4_modal_trigger btn btn-primary" href="#" data-modal-id="bs4_sldr_cmrce<?//=$row['id_voiture']?>" data-toggle="modal">details</a></div>-->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bs4_sldr_cmrce<?=$row['id_voiture']?>">Open modal</button>
                </div>

                <!-- car infos modal -->
                <div id="bs4_sldr_cmrce<?=$row['id_voiture']?>" class="modal fade bs4_modal bs4_blue bs4_bg_white bs4_bd_black bs4_bd_semi_trnsp bs4_none_radius bs4_shadow_none bs4_center bs4_animate bs4FadeInDown bs4_duration_md bs4_easeOutQuint bs4_size_sldr_cmrce" role="dialog" data-modal-backdrop="true" data-show-on="click" data-modal-delay="false" data-modal-duration="false">
                    <div class="modal-dialog">
                        <div class="modal-content"><a class="bs4_btn_x_out_shtr bs4_sldr_cmrce_close" href="#" data-dismiss="modal">close</a>
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div id="bs4_sldr_commerce<?=$row['id_voiture']?>" class="carousel slide bs4-carousel bs4_sldr_cmrce_indicators thumb-scroll-x swipe-x bs4s_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active"><img src="http://localhost/fichiers/<?=$row['image_path']?>" alt="image du voiture" class="images"></div>
                                            <?php

                                                $requete = $bdd->prepare('CALL get_voiture_images(?)');
                                                $requete->execute(array($row['id_voiture']));
                                                $images = $requete->fetchAll();
                                                $requete->closeCursor();
                                                $images2 = $images;
                                                foreach($images as $donne)
                                                {
                                            ?>
                                                    <div class="carousel-item"><img src="http://localhost/fichiers/<?=$donne['nom']?>" alt="image du voiture" class="images"></div>
                                                <?php
                                                }
                                                ?>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li class="active" data-target="#bs4_sldr_commerce<?=$row['id_voiture']?>" data-slide-to="0"><img src="http://localhost/fichiers/<?=$row['image_path']?>" alt="image du voiture"></li>
                                            <?php
                                                $comteur = 1;
                                                foreach($images2 as $donne)
                                                {
                                            ?>
                                            <li data-target="#bs4_sldr_commerce<?=$row['id_voiture']?>" data-slide-to="<?=$comteur?>"><img src="http://localhost/fichiers/<?=$donne['nom']?>" alt="image du voiture"></li>
                                            <?php
                                                $comteur+=1;
                                                }

                                            ?>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="bs4_sldr_cmrce_txt">
                                        <h1>name of product, company plus modal number</h1>
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>

                                        <table id="table_details">
                                            <tr>
                                                <th>marque</th>
                                                <td><?=$row['marque']?></td>
                                            </tr>
                                            <tr>
                                                <th>modele</th>
                                                <td><?=$row['modele']?></td>
                                            </tr>
                                            <tr>
                                                <th>type<?=$row["manual"]?></th>
                                                <?php
                                                if(!(bool)$row['manual'])
                                                    echo "<td>automatique</td>";
                                                else
                                                    echo "<td>manuelle</td>";
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>type de carburent</th>
                                                <td><?=$row['type_carb']?></td>
                                            </tr>
                                            <tr>
                                                <th>disponibilite<?=$row['dispo']?></th>
                                                <?php
                                                if(!(bool)$row['dispo'])
                                                    echo "<td>non</td>";
                                                else
                                                    echo "<td>oui</td>";
                                                ?>

                                            </tr>
                                            <tr>
                                                <th>prix par jour</th>
                                                <td><?=$row['prix_jour']?><span>DH</span></td>
                                            </tr>
                                        </table>
                                        <form action="reserver_voiture.php" method="POST">
                                            <input class="d-none" name="id_voiture" value="<?=$row['id_voiture']?>" />
                                            <div class="bs4_form_num"><label>nombre de jours</label><input class="form-control" type="number" name="nbr_jours" min="1" max="20"></div>
                                            <div class="bs4_form_cmrce_btn"><button class="btn btn-primary bs4_btn_x_out_shtr" type="submit">reserver</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
    // Include the database configuration file 
    include_once 'footer.php';
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Button-modal-ecommerce.js"></script>
</body>

</html>