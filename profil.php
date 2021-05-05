
<?php
session_start();
if(isset($_SESSION['id'])){
  $id_client = $_SESSION['id'];
  
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sweet Home - Home</title>
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
    <!--|| Import Bootstrap ||-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

    <!--|| Import FontAwsome for icons ||-->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
      integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu"
      crossorigin="anonymous"
    />

    <!--|| Import style file => home.css ||-->
    <link rel="stylesheet" href="profile.css" />

    <!--|| Import OpenSans font style ||-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php
    include_once 'dbConfig.php';
    include 'header.php';
    ?>
    <!-- user Profile -->
    <div class="container profile-container">
      <form action="" method="">
        <div class="row">
          <div class="col-md-4">
            <div class="profile-img">
              <img
                src="./assets/img/car1.jpg"
                alt="profile image"
                id="userProfileImage"
              />
              <div class="file btn btn-lg">
                change photo
                <input type="file" name="photo" id="pdp" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="profile-head">
              <div class="name">
                <!-- Client's name -->
                <h4></h4>
              </div>
              <div class="statue">
                <!-- client's statu => Buyer or seller -->
                <h6>
                  status : <span class="buyer">Buyer</span> |
                  <span class="seller">Seller</span>
                </h6>
              </div>
              <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link active"
                    id="home-tab"
                    data-bs-toggle="tab"
                    href="#aboutUser"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    >About you</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="profile-tab"
                    data-bs-toggle="tab"
                    href="#settings"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    >Settings</a
                  >
                </li>
              </ul>
              <div class="tab-content" id="userTableData">
                <div
                  class="tab-pane fade show active"
                  id="aboutUser"
                  role="tabpanel"
                  aria-labelledby="home-tab"
                >
                  <table class="table table-borderless mt-2">
                    <!-- static values -->
                    <?php
                    //fetch profile infos
                      $requete = $bdd->prepare('CALL get_profile_infos(?)');
                      $requete->execute(array($id_client));
                      $result = $requete->fetchAll();
                      $requete->closeCursor();
                      foreach ($result as $row) {
                      ?>
                    <tbody>
                      <tr>
                        <th scope="row">Username</th>
                        <td class="userNameField"><?=$row['email']?></td>
                      </tr>
                      <tr>
                        <th scope="row">First Name</th>
                        <td class="firstNameField"><?=$row['prenom']?></td>
                      </tr>
                      <tr>
                        <th scope="row">Last Name</th>
                        <td class="lastNameField"><?=$row['nom']?></td>
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                        <td class="emailField"><?=$row['email']?></td>
                      </tr>
                      <tr>
                        <th scope="row">CIN</th>
                        <td class="addressField"><?=$row['cin']?></td>
                      </tr>
                      <tr>
                        <th scope="row">Phone</th>
                        <td class="phoneField"></td>
                      </tr>
                      <tr class="editInfoline">
                        <th>
                          <button
                            type="button"
                            class="btn bg-secondary text-white editProfile"
                            data-bs-toggle="modal"
                            data-bs-target="#editProfile"
                          >
                            Edit profile
                          </button>
                        </th>
                      </tr>
                    </tbody>
                    <?php
                      }
                    ?>
                  </table>
                </div>
                <div
                  class="tab-pane fade"
                  id="settings"
                  role="tabpanel"
                  aria-labelledby="profile-tab"
                >
                  <form action="" method="">
                    <div class="row my-3 mx-1">
                      <div class="col-6">
                        <div class="title">Change Password</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 mb-2">
                        <div class="form-floating">
                          <input
                            type="password"
                            class="form-control"
                            id="oldPassword"
                            placeholder="Password"
                          />
                          <label for="oldPassword">Old password</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 mb-2">
                        <div class="form-floating">
                          <input
                            type="password"
                            class="form-control"
                            id="newPassword"
                            placeholder="Password"
                          />
                          <label for="newPassword">New password</label>
                        </div>
                      </div>
                      <div class="col-6 mb-2">
                        <div class="form-floating">
                          <input
                            type="password"
                            class="form-control"
                            id="confirmePassword"
                            placeholder="Password"
                          />
                          <label for="confirmePassword">confirm password</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button
                          type="submit"
                          class="btn btn-secondary text-white submitChangePassword"
                        >
                          Change Password
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

     <!-- Modals -->

    <!-- Edit profile -->
    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Change Personal Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method=''>
              <div class="row">
                <div class="col-sm-12 col-md-4 img">
                  <div class="profile-img">
                    <img class='img-thumbnail' src="" alt="profile image" id="user-ProfileImage">
                    <div class="file btn btn-lg">
                      change photo
                    <input type="file" name="photo" id="changepdp">
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-8 product-content">
                  <div class="row mb-2">
                    <div class="col-6">
                      <div class="form-floating Fname">
                        <input type="text" class="form-control" id="user-firstName" placeholder=" ">
                        <label for="user-firstName">First Name</label>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-floating Lname">
                        <input type="text" class="form-control" id="user-lastName" placeholder=" ">
                        <label for="user-lastName">Last Name</label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <div class="form-floating Email">
                        <input type="email" class="form-control" id="user-emailAddress" placeholder=" ">
                        <label for="user-emailAddress">Email Address</label>
                      </div>
                    </div>                    
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <div class="form-floating Adresse">
                        <textarea type="email" class="form-control" id="user-Address" placeholder=" " style="max-height: 130px; min-height:100px;"> </textarea>
                        <label for="user-Address">Address</label>
                      </div>
                    </div>                                       
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <div class="form-floating Email">
                        <input type="phone" class="form-control" id="user-phone" placeholder=" ">
                        <label for="user-phone">Phone</label>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
              <button type="submit" class="d-none" id="saveProfileChanges"></button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary saveProfileChanges" data-bs-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
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

