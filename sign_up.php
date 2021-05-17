<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>sign up</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Cookie"
    />
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css" />
    <link rel="stylesheet" href="assets/css/Card-Group1-Shadow.css" />
    <link rel="stylesheet" href="assets/css/Good-login-dropdown-menu-1.css" />
    <link rel="stylesheet" href="assets/css/Good-login-dropdown-menu.css" />
    <link rel="stylesheet" href="assets/css/gradient-navbar-1.css" />
    <link rel="stylesheet" href="assets/css/gradient-navbar.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css"
    />
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css" />
    <link rel="stylesheet" href="assets/css/Modal-Login-form.css" />
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css" />
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css" />
    <link
      rel="stylesheet"
      href="assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css"
    />
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css" />
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
  </head>

  <body>
    <?php
        //Include the database header file 
        include_once 'header.php';
    ?>

    <section class="register-photo">
      <div class="form-container">
        <div class="image-holder"></div>
        <form method="post" action="sign_up_action.php">
          <h2 class="text-center"><strong>Create</strong> an account.</h2>
          <div class="form-group">
            <input
              class="form-control"
              type="text"
              name="firstname"
              placeholder="first name"
            />
          </div>
          <div class="form-group">
            <input
              class="form-control"
              type="text"
              name="lastname"
              placeholder="last name"
            />
          </div>
          <div class="form-group">
            <input
              class="form-control"
              type="email"
              name="email"
              placeholder="Email"
            />
          </div>
          <div class="form-group">
            <input
              class="form-control"
              type="password"
              name="password"
              placeholder="Password"
            />
          </div>
          <div class="form-group">
            <input
              class="form-control"
              type="password"
              name="password-repeat"
              placeholder="Password (repeat)"
            />
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
              Sign Up
            </button>
          </div>
          <a class="already" href="login.html"
            >You already have an account? Login here.</a
          >
        </form>
      </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
