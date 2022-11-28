<?php
  session_start();

  $data = json_decode(file_get_contents("./database.json"), TRUE);

  if (isset($_POST["username"]) && isset($_POST["user_password"]) && isset($_POST["full_name"]) && isset($_POST["address"])) {
    $check = TRUE;

    for ($i = 0; $i < count($data["users"]); $i++) {
      if ($data["users"][$i]["username"] === $_POST["username"]) {
        $check = "existed";
        break;
      }
    }
  }

  if (isset($check) && $check === TRUE) {
    $hashed_password = password_hash($_POST["user_password"], PASSWORD_DEFAULT);

    $newdata = array (
      "id" => count($data["users"]) + 1,
      "username" => $_POST["username"],
      "password" => $hashed_password,
      "full_name" => $_POST["full_name"],
      "address" => $_POST["address"]
    );

    $data["users"][] = $newdata;

    file_put_contents("./database.json", json_encode($data, JSON_PRETTY_PRINT));
  }
?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
   <?php include_once("header.php"); ?>
    <main class="page login-page">
      <section class="clean-block clean-form dark" style="background: #332c54">
        <div class="container" style="margin: 0px 35px">
          <div class="block-heading"></div>
          <form
            style="
              --bs-info: #332c54;
              --bs-info-rgb: 51, 44, 84;
              border-color: #332c54;
            "
            action=""
            method="post"
            enctype="multipart/form-data"
            autocomplete="off"
          >
            <h2
              class="text-uppercase text-info"
              style="
                --bs-info: #332c54;
                --bs-info-rgb: 51, 44, 84;
                text-align: center;
              "
            >
              <strong>Create an account</strong>
            </h2>
            <div class="mb-3">
              <label class="form-label" for="username">Username</label
              ><input class="form-control item" type="text" name="username" id="username" required pattern="[a-zA-Z0-9]{8,15}" title="Only letters (both lowercase and uppercase) and numbers, between 8 to 15 characters in length."/>
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Password</label
              ><input class="form-control" type="password" name="user_password" id="user_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}", title="Must contain at least a number, a lowercase letter, an uppercase letter, and between 8 to 20 characters long." />
            </div>
            <div class="mb-3">
              <label class="form-label" for="full_name">Full name</label
              ><input class="form-control" type="text" name="full_name" id="full_name" required pattern=".{5,}" title="Required field with at least 5 character long."/>
            </div>
            <div class="mb-3">
              <label class="form-label" for="address">Address</label
              ><input class="form-control" type="text" name="address" id="address" required pattern=".{5,}" title="Required field with at least 5 character long."/>
            </div>
            <div class="mb-3">
              <label class="form-label" for="profile"
                >Upload your profile picture</label
              ><label
                class="form-label"
                id="user_group_label"
                for="user_group_logo"
                style="margin-left: 110px; margin-right: 103px"
                ><i class="fas fa-upload"></i>&nbsp;Choose an image...</label>
            </div>
            <div class="mb-3"></div>
            <button
              class="btn btn-primary d-block btn-user w-100"
              type="submit"
              vale="verify"
              style="background: #332c54"
            >
              Register Account
            </button>
            <p style="color: <?php if (isset($check) && $check === TRUE) { echo "green";} if (isset($check) && $check === "existed") { echo "red"; } ?>">
              <?php 
                if (isset($check) && $check === TRUE) { echo "Successfully registered! You can login now.";} 
                if (isset($check) && $check === "existed") { echo "Username already existed, please try again with a different username."; }
              ?>
            </p>
            <hr />
            <a class="link-dark" href="login.php"
              ><p
                style="
                  font-weight: bold;
                  text-decoration: underline;
                  text-align: center;
                "
              >
                Already have an account? Login
              </p></a
            >
          </form>
        </div>
        <div class="container">
          <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0"></div>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <?php include_once ('footer.php'); ?>
  </body>

  <script>
    <?php if (isset($_SESSION["user_type"]) && $_SESSION["logged_in"] === "true"): ?>
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
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
