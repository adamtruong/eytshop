<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>About Us</title>
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
            <h2
              class="text-info"
              style="--bs-info: #332c54; --bs-info-rgb: 51, 44, 84"
            >
              About Us
            </h2>
            <p style="color: rgb(0, 0, 0)">
              The shop was established in 2022.We are a group of people who love
              books and want to spread the love for books to others as well as
              let people get the chance to learn English through books.For that,
              our shop mainly sells English books with many categories that can
              fit different types of people.Our shop, for the moment, is only
              working online and does not have a physical store, so if you have
              any questions, feel free to email us.eyt@gmail.com
            </p>
          </div>
          <iframe
            allowfullscreen=""
            frameborder="0"
            loading="lazy"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAyRokN4YJfoKH4RmmeDEISWYmbEJLHVJI&amp;q=RMIT+hanoi&amp;zoom=11"
            width="100%"
            height="400"
          ></iframe>
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
