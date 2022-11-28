<?php
  session_start();
  $check = NULL;

  if (isset($_POST["username"]) && isset($_POST["password"])) {
    $data = json_decode(file_get_contents("./database.json"), TRUE);
    $check = FALSE;
    
    foreach ($data["vendor"] as $line) {
      if (($_POST["username"] == $line["username"]) && (password_verify($_POST["password"], $line["password"]))) {
        session_unset();
        $check = TRUE;
        $_SESSION["logged_in"] = "true";
        $_SESSION["user_type"] = "vendor";
        $_SESSION["vendor_id"] = $line["id"];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["business_name"] = $line["business_name"];
        $_SESSION["business_address"] = $line["business_address"];
        break;
      }
    }
  }

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === "true" && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
    header("Location: ./index_vendor.php");
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
    <title>Login - Vendor</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
  <?php
  include_once('header.php');
  ?>
    <main class="page login-page">
      <section class="clean-block clean-form dark" style="background: #332c54">
        <div class="container">
          <div class="block-heading"></div>
          <form
            action="login-vendor.php"
            method="post"
            style="
              --bs-info: #332c54;
              --bs-info-rgb: 51, 44, 84;
              border-color: #332c54;
            "
            id="form"
          >
            <h1
              class="text-center text-info"
              style="--bs-info: #332c54; --bs-info-rgb: 51, 44, 84"
            >
              <strong>Login for Vendors</strong>
            </h1>
            <div class="mb-3">
              <label class="form-label" for="username">Username</label
              ><input class="form-control item" type="text" name = "username" id="username" required/>
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Password</label
              ><input class="form-control" type="password" name = "password" id="password" required/>
            </div>
            <div class="mb-3">
              <div class="form-check">
                  <p style="color: red"><?php if ($check === FALSE) { echo "Incorrect username or password."; } ?></p>
              </div>
            </div>
            <button
              class="btn btn-primary d-block btn-user w-100"
              type="submit"
              style="background: #332c54"
            >
              Login</button
            ><a class="link-dark" href="signup-vendor.php"
              ><p
                class="text-center"
                style="font-weight: bold; text-decoration: underline"
              >
                Create your Eytshop vendor account
              </p></a>
          </form>
          <section class="clean-block clean-hero" id="text" style="display: none">
            <h2>Welcome to our store!</h2>
            <p>Refer to the toolbar above to start navigating our website.</p>
          </section>
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

    if (logged_in === false) {
      document.getElementById("text").style.display = "none";
      document.getElementById("form").style.display = "block";
    }

    if (logged_in === true && user_type !== "vendor") {
      document.getElementById("text").style.display = "none";
      document.getElementById("form").style.display = "block";
      document.getElementById("cart").style.display = "none";
      document.getElementById("catalog").style.display = "none";

      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    }

    if (logged_in === true && user_type === "vendor") {
      document.getElementById("form").style.display = "none";
      document.getElementById("text").style.display = "block";
      document.getElementById("cart").style.display = "none";
      document.getElementById("catalog").style.display = "none";

      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    }
  </script>
</html>