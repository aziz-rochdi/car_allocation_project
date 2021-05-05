<?php
  if(isset($_SESSION['id'])){
    $email = $_SESSION['email'];
  }
  else{
      $email = '';
  }             
?>

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

<nav class="navbar navbar-dark navbar-expand-md" id="app-navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"
          ><i class="icon ion-model-s" id="brand-logo"></i></a
        ><span>ROCHDI CAR</span
        ><button
          data-toggle="collapse"
          class="navbar-toggler"
          data-target="#navcol-1"
        >
          <span class="sr-only">Toggle navigation</span
          ><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cars.php">Cars</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact us</a>
            </li>
            <li class="nav-item text-center">
              <a class="nav-link" href="#"></a>
              <div class="nav-item dropdown" style="color: red">
                <a
                  aria-expanded="false"
                  data-toggle="dropdown"
                  href="#"
                  style="color: white"
                  >
                  <!-- change login <=====> profil icon --> 
                  <?php
                    if ($email !== ''){
                  ?>
                  <i class="fa fa-user-circle-o"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">profil</a>
                    <a class="dropdown-item" href="log_out.php">log out</a>
                  <?php
                  }else{
                  ?>
                  <i class="fa fa-sign-in" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="login.php">log in</a>
                    <a class="dropdown-item" href="sign_up.php">sign up</a>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>