<?php

// Include the database configuration file 
include_once 'dbConfig.php';

$prix = 0;
$marque = '';
$couleur = '';

if(isset($_GET['marque'])){
    $marque = $_GET['marque'];
    $prix1 = $_GET['prix'];
    $couleur = $_GET['couleur'];
}


if ($prix1 != ''){
    $prix = (int)$prix1;
}

                $sth = $bdd->prepare('CALL filter_voitures(?,?,?)');
                $sth->execute(array($marque,$prix,$couleur));
                $result = $sth->fetchAll();
                $sth->closeCursor();
                foreach ($result as $row) {
                ?>
                <div class="col-md-4 cust_blogteaser">

                    <a href="#"><img class="img-fluid images" src="http://localhost/fichiers/<?=$row['image_path']?>" ></a>
                    <h3><?=$row['marque']?></h3>
                
                    <div><a class="bs4_modal_trigger" href="#" data-modal-id="bs4_sldr_cmrce<?=$row['id_voiture']?>" data-toggle="modal">details</a>
                        <div id="bs4_sldr_cmrce<?=$row['id_voiture']?>" class="modal fade bs4_modal bs4_blue bs4_bg_white bs4_bd_black bs4_bd_semi_trnsp bs4_none_radius bs4_shadow_none bs4_center bs4_animate bs4FadeInDown bs4_duration_md bs4_easeOutQuint bs4_size_sldr_cmrce" role="dialog" data-modal-backdrop="true" data-show-on="click" data-modal-delay="false" data-modal-duration="false">
                            <div class="modal-dialog">
                                <div class="modal-content"><a class="bs4_btn_x_out_shtr bs4_sldr_cmrce_close" href="#" data-dismiss="modal">close</a>
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div id="bs4_sldr_commerce<?=$row['id_voiture']?>" class="carousel slide bs4-carousel bs4_sldr_cmrce_indicators thumb-scroll-x swipe-x bs4s_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active"><img src="http://localhost/fichiers/<?=$row['image_path']?>" alt="image du voiture" class="images"></div>
                                                    <?php
                                                        // $requete = $bdd->prepare('CALL get_voiture_images(?)');
                                                        // $requete2 = $bdd->prepare('CALL get_voiture_images(?)');
                                                        // $requete->execute(array($row['id_voiture']));

                                                        // while($donnee = $requete->fetch())

                                                        $requete = $bdd->prepare('CALL get_voiture_images(?)');
                                                        $requete->execute(array($row['id_voiture']));
                                                        $images = $requete->fetchAll();
                                                        $requete->closeCursor();
                                                        $images2 = $images;
                                                        foreach($images as $donne)
                                                        {
                                                    ?>
                                                            <div class="carousel-item"><img src="http://localhost/fichiers/<?=$donnee['nom']?>" alt="image du voiture" class="images"></div>
                                                        <?php
                                                        }
                                                        ?>
                                                </div>
                                                <ol class="carousel-indicators">
                                                    <li class="active" data-target="#bs4_sldr_commerce<?=$row['id_voiture']?>" data-slide-to="0"><img src="http://localhost/fichiers/<?=$row['image_path']?>" alt="image du voiture"></li>
                                                    <?php
                                                        $comteur = 1;
                                                        // $requete2->execute(array($row['id_voiture']));
                                                        // while($donnee = $requete2->fetch())
                                                        foreach($images2 as $donne)
                                                        {
                                                    ?>
                                                    <li data-target="#bs4_sldr_commerce<?=$row['id_voiture']?>" data-slide-to="<?=$comteur?>"><img src="http://localhost/fichiers/<?=$donnee['nom']?>" alt="image du voiture"></li>
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
                                                <form action="#">
                                                    <div class="bs4_form_num"><label>nombre de jours</label><input class="form-control" type="number" name="quantity" min="1" max="20"></div>
                                                    <div class="bs4_form_cmrce_btn"><button class="btn btn-primary bs4_btn_x_out_shtr" type="submit">reserver</button></div>
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
                    // $sql->closeCursor();
                ?>