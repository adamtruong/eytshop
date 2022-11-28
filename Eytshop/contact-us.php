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
    <title>Contact Us</title>
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
    <main class="page contact-us-page">
      <section class="clean-block clean-form dark">
        <div class="container">
          <div class="block-heading">
            <h2 class="text-info">Contact Us</h2>
            <p>For any support, we are here to answer any question</p>
          </div>
          <form class="text-center" style="border-color: #332c54">
            <div class="mb-3">
              <label class="form-label" for="name">Name</label
              ><input class="form-control" type="text" id="name" name="name" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="subject">Subject</label
              ><input
                class="form-control"
                type="text"
                id="subject"
                name="subject"
              />
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email</label
              ><input
                class="form-control"
                type="email"
                id="email"
                name="email"
              />
            </div>
            <div class="mb-3">
              <label class="form-label" for="message">Message</label
              ><textarea
                class="form-control"
                id="message"
                name="message"
              ></textarea>
            </div>
            <div class="mb-3">
              <button
                class="btn btn-primary"
                type="submit"
                style="
                  background: #332c54;
                  border-color: #332c54;
                  width: 100px;
                  height: 50px;
                "
              >
                Send
              </button>
            </div>
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
