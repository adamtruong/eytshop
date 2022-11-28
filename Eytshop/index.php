<?php
  session_start();

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
    header("Location: ./index_vendor.php");
  }

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
    header("Location: ./index_shipment.php");
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
    <title>Home</title>
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
    <main class="page landing-page">
      <section
        class="clean-block clean-hero"
        style="
          color: rgba(51, 44, 84, 0.8);
          background: url('assets/img/tech/space_background.png');
        "
      >
        <div class="text">
          <h2>WELCOME TO EYTSHOP</h2>
          <figure>
            <blockquote class="blockquote">
              <p class="mb-0">
                <br /><strong
                  >“The more that you read, the more things you will know. The
                  more that you learn, the more places you’ll go.”</strong
                ><br /><br /><br />
              </p>
            </blockquote>
            <figcaption class="blockquote-footer">
              <span style="color: rgb(255, 255, 255)"
                >&nbsp;Dr. Seuss,&nbsp;</span
              ><em
                ><span style="color: rgb(255, 255, 255)"
                  >I Can Read With My Eyes Shut!</span
                ></em
              ><br />
            </figcaption>
          </figure>
        </div>
      </section>
      <section class="clean-block clean-info dark">
        <div class="container">
          <!-- Start: Lightbox Gallery -->
          <section class="photo-gallery py-4 py-xl-5">
            <div class="container">
              <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                  <h2>BEST SELLERS</h2>
                  <p class="w-lg-50">These are top selling novels&nbsp;</p>
                </div>
              </div>
              <!-- Start: Photos -->
              <div
                class="row gx-2 gy-2 row-cols-1 row-cols-md-2 row-cols-xl-3 photos"
                data-bss-baguettebox=""
              >
                <div class="col text-center item">
                  <img
                    class="img-fluid"
                    src="assets/img/1.jpg"
                    style="height: 500px"
                  />
                  <h4>$9.99</h4>
                </div>
                <div class="col text-center item">
                  <img
                    class="img-fluid"
                    src="assets/img/3.jpg"
                    style="width: 333px; height: 500px"
                  />
                  <h4>$13.99</h4>
                </div>
                <div class="col text-center item">
                  <img class="img-fluid" src="assets/img/6.jpg" />
                  <h4>$5.99</h4>
                </div>
                <div class="col text-center item">
                  <img class="img-fluid" src="assets/img/10.jpg" />
                  <h4>$9.99</h4>
                </div>
                <div class="col text-center item">
                  <img
                    class="img-fluid"
                    src="assets/img/7.jpg"
                    style="width: 333px; height: 500px"
                  />
                  <h4>$4.99</h4>
                </div>
                <div class="col text-center item">
                  <img
                    class="img-fluid"
                    src="assets/img/13.jpg"
                    style="width: 333px; height: 500px"
                  />
                  <h4>$3.99</h4>
                </div>
              </div>
              <!-- End: Photos -->
            </div>
            <div class="block-heading">
              <h2 class="text-info">
                <br /><strong
                  ><span style="color: rgb(33, 37, 41)"
                    >New book that we love</span
                  ></strong
                ><br />
              </h2>
            </div>
          </section>
          <!-- End: Lightbox Gallery -->
          <div class="row align-items-center">
            <div class="col-md-6 text-center">
              <img class="img-thumbnail" src="assets/img/10.jpg" />
            </div>
            <div class="col-md-6">
              <h3>Sword Art Online Progressive 1</h3>
              <div class="getting-started-info">
                <p>
                  "There's no way to beat this game. The only difference is when
                  and where you die..."
                  <br> <br>
                  One month has passed since Akihiko
                  Kayaba's deadly game began, and the body count continues to
                  rise. Two thousand players are already dead.Kirito and Asuna
                  are two very different people, but they both desire to fight
                  alone. Nonetheless, they find themselves drawn together to
                  face challenges from both within and without. Given that the
                  entire virtual world they now live in has been created as a
                  deathtrap, the surviving players of Sword Art Online are
                  starting to get desperate, and desperation makes them
                  dangerous to loners like Kirito and Asuna. As it becomes clear
                  that solitude equals suicide, will the two be able to overcome
                  their differences to find the strength to believe in each
                  other, and in so doing survive?
                </p>
              </div>
              <a
                class="btn btn-danger btn-lg"
                role="button"
                href="product-page.php?id=10"
                style="
                  border-color: #332c54;
                  color: #ffffff;
                  --bs-primary: #332c54;
                  --bs-primary-rgb: 51, 44, 84;
                "
                >Buy now</a
              >
            </div>
          </div>
        </div>
      </section>
      <section class="clean-block slider dark"></section>
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
