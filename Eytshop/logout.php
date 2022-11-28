<?php
  session_start();

  if (isset($_POST["logout"])) {
    session_unset();

    $cart = json_decode(file_get_contents("./cart.json"), TRUE);
    $cart["cart"] = [];
    file_put_contents("./cart.json", $cart["cart"]);
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
    <title>Bye bye!</title>
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
  <main class="page">
      <section class="clean-block about-us">
        <div class="container">
          <div class="block-heading">
            <h1
              class="text-info"
              style="--bs-info: #332c54; --bs-info-rgb: 51, 44, 84"
            >
              Bye bye!
            </h1>
            <h4
              class="text-info"
              style="--bs-info: #332c54; --bs-info-rgb: 51, 44, 84"
            >
              Successfully logged out from the store. We hope to see you again!
            </h4>
          </div>
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
