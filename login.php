<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Login page</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Cookie"
    />
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css" />


    <link rel="stylesheet" href="assets/css/login.css" />
  </head>

  <body> 
    <?php
      include 'header.php';
    ?>
    <div class="container">
      <div class="row row-login">
        <div class="col-10 col-sm-6 col-md-4 offset-1 offset-sm-3 offset-md-4">
          <h1 class="text-center">Web Application</h1>
          <div class="card">
            <div class="card-body">
              <h3 class="text-danger">Login</h3>
              <form method="POST" action="login_action.php">
                <div class="form-group">
                  <label>Username </label
                  ><input class="form-control" type="text" name="email" />
                </div>
                <div class="form-group">
                  <label>Password </label
                  ><input
                    class="form-control"
                    type="password"
                    name="password"
                  />
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="formCheck-1"
                    /><label class="form-check-label" for="formCheck-1"
                      >Remember me</label
                    >
                  </div>
                </div>
                <button class="btn btn-success btn-block" type="submit">
                  LOGIN</button
                ><a class="btn btn-link center-block" role="button" href="#"
                  >Forget Password?</a
                >
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
