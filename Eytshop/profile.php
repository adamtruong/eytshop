<?php
  session_start();

  $attr1;
  $attr2;
  $attr3;
  $id;
  $avatar_decider;

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user") {
    $attr1 = "Username";
    $attr2 = "Full name";
    $attr3 = "Address";
    $id = $_SESSION["user_id"];
    $avatar_decider = "user";
  }

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
    $attr1 = "Username";
    $attr2 = "Business name";
    $attr3 = "Business address";
    $id = $_SESSION["vendor_id"];
    $avatar_decider = "vendor";
  }

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
    $attr1 = "ID";
    $attr2 = "Username";
    $attr3 = "Assigned hub";
    $id = $_SESSION["shipper_id"];
    $avatar_decider = "shipper";
  }


  if (!isset($_SESSION["logged_in"])) {
    header("Location: ./login.php");
  }

  $_SESSION['profile_image']= $avatar_decider;
  $_SESSION['profile_id']= $id;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
  <?php
  include_once('header.php');?>
     <main class="page service-page">
      <section class="clean-block clean-services dark">
        <div class="container-fluid text-center" style="margin-top: 40px">
          <h1 class="text-uppercase text-dark mb-4">
            <br>
            <strong>Profile</strong>
          </h1>
          <div class="row mb-3">
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-body text-center shadow" style="height: 360px">
                  <img
                    class="img-thumbnail mb-3 mt-4"
                    src="assets/img/<?php echo $avatar_decider; ?>_<?php echo $id; ?>.jpg" alt="a profile picture"
                    width="375"
                    height="253"
                  />
                  <div class="mb-3">
                  <form enctype="multipart/form-data" method="post" action="./upload.php">
                    <input type="file" name="profile_image">
                    <input type="submit" name="submit" value="Upload">
                  </form>
                  </div>
                </div>
              </div>
              <div class="card shadow mb-4"></div>
            </div>
            <div class="col-lg-8">
              <div class="row mb-3 d-none">
              </div>
              <div class="row">
                <div class="col">
                  <div class="card shadow mb-3">
                    <div class="card-header py-3">
                      <p class="text-primary m-0 fw-bold">User</p>
                    </div>
                    <div class="card-body" style="height: 305px">
                      <form>
                        <div class="row">
                          <div class="col">
                            <div class="mb-3">
                              <label><?php echo $attr1; ?></label
                              >
                            </div>
                            <h1>
                              <?php
                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user") {
                                  echo $_SESSION["username"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
                                  echo $_SESSION["username"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
                                  echo $_SESSION["shipper_id"];
                                }
                              ?>
                            </h1>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="mb-3">
                              <label><?php echo $attr2; ?></label>
                            </div>
                            <h1>
                              <?php
                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user") {
                                  echo $_SESSION["full_name"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
                                  echo $_SESSION["business_name"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
                                  echo $_SESSION["username"];
                                }
                              ?>
                            </h1>
                          </div>
                          <div class="col">
                            <div class="mb-3">
                              <label><?php echo $attr3; ?></label>
                            </div>
                            <h1>
                            <?php
                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user") {
                                  echo $_SESSION["address"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
                                  echo $_SESSION["business_address"];
                                }

                                if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
                                  echo $_SESSION["assigned_hub"];
                                }
                              ?>
                            </h1>
                          </div>
                        </div>
                        <div class="mb-3"></div>
                      </form>
                    </div>
                  </div>
                  <div class="card shadow"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- <button
            class="btn btn-primary btn-sm"
            action="logout.php"
            type="submit"
            style="
              background: var(--bs-red);
              border-color: #332c54;
              height: 60px;
              width: 200px;
            "
          >
            LOGOUT
            
          </button> -->
          <!--Log out-->
          <form action="logout.php" method="post">
            <input type="submit" id="logout" value="Logout" name="logout">
          </form>

        </div>
      </section>
    </main>
    <!-- Footer -->
    <?php include_once ('footer.php'); ?>
  </body>
  <script>
    <?php if (isset($_SESSION["logged_in"]) && isset($_SESSION["user_type"])): ?>
      let logged_in = <?php echo $_SESSION["logged_in"]; ?>;
      let user_type = "<?php echo $_SESSION["user_type"]; ?>";
    <?php endif; ?>

    if (logged_in === true && user_type === "user") {
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    }

    if (logged_in === true && user_type === "vendor") {
      document.getElementById("cart").style.display = "none";
      document.getElementById("catalog").style.display = "none";
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    }

    if (logged_in === true && user_type === "shipper") {
      document.getElementById("cart").style.display = "none";
      document.getElementById("catalog").style.display = "none";
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    }
  </script>
</html>
