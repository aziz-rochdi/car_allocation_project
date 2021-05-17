
<?php
 session_start();
if(isset($_SESSION['id'])){
  $id_client = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <link
      href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      rel="stylesheet"
      id="bootstrap-css"
    />
    <!--|| Import style file => profile.css ||-->
    <link rel="stylesheet" href="profile.css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css"> -->
    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--|| Import Bootstrap ||-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

    <!--|| Import FontAwsome for icons ||-->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
      integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu"
      crossorigin="anonymous"
    />



    <!--|| Import OpenSans font style ||-->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
      rel="stylesheet"
    /> -->
  </head>
  <body>
  <?php
    include_once 'dbConfig.php';
    include 'header.php';
    ?>
    <!-- user Profile -->
    <div class="container emp-profile">
    <?php
    //fetch profile infos
      $requete = $bdd->prepare('CALL get_profile_infos(?)');
      $requete->execute(array($id_client));
      $result = $requete->fetchAll();
      $requete->closeCursor();
      foreach ($result as $row) {
      ?>
      <form method="post" action="modifier_client_action.php">
      <input value="<?=$row['id']?>" name="id_client" class="d-none"/>
        <div class="row">
          <div class="col-md-4">
            <div class="profile-img">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                alt=""
              />
              <div class="file btn btn-lg btn-primary">
                Change Photo
                <input type="file" name="file" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="profile-head">
              <h5>Kshiti Ghelani</h5>
              <h6>Web Developer and Designer</h6>
              <p class="proile-rating">RANKINGS : <span>8/10</span></p>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="home-tab"
                    data-toggle="tab"
                    href="#home"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    >informations personnelles</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="profile-tab"
                    data-toggle="tab"
                    href="#profile"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    >Modifier le mot de passe</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
            <input
              type="submit"
              class="profile-edit-btn"
              name="btnAddMore"
              value="Edit Profile"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
              <div
                class="tab-pane fade show active"
                id="home"
                role="tabpanel"
                aria-labelledby="home-tab"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label>Prenom</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" value="<?=$row['prenom']?>" name="prenom" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Nom</label>
                  </div>
                  <div class="col-md-6">
                    <!-- <p>Kshiti Ghelani</p> -->
                    <input type="text" value="<?=$row['nom']?>" name="nom" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Email</label>
                  </div>
                  <div class="col-md-6">
                    <input type="email" value="<?=$row['email']?>" name="email" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Phone</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" value="0<?=$row['phone']?>" name="phone" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>CIN</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" value="<?=$row['cin']?>" name="cin" />
                  </div>
                </div>
              </div>
              <?php
                      }
                    ?>
              <div
                class="tab-pane fade"
                id="profile"
                role="tabpanel"
                aria-labelledby="profile-tab"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label>encient mot de passe </label>
                  </div>
                  <div class="col-md-6">
                    <input type="password" name="password" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Nouveau mot de passe</label>
                  </div>
                  <div class="col-md-6">
                    <input type="password" name="newPassword" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Nouveau mot de passe</label>
                  </div>
                  <div class="col-md-6">
                    <input type="password" name="repeatNewPassword" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!--|| JQuery, script file => home.js & bootstrap script file||-->
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/jQuery.js"></script>
    <script src="./js/profile.js"></script>
  </body>
</html>
<?php

}
else{
echo 'vous devrez vous connectez !';
}
?>
