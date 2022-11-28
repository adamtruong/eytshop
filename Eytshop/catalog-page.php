<?php
  session_start();

  $file = file("./product.csv");
  $data = [];
  $filtered_data = [];

  foreach ($file as $line) {
    $data[] = str_getcsv($line, "|");
  }

  unset($data[0]);

  if (!isset($_GET["category"])) {
    for ($i = 1; $i < count($data); $i++) {
      $filtered_data[] = $data[$i];
    }
  }

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] !== "user") {
    header("Location: ./woops.php");
  }

  if (isset($_GET["category"])) {
    for ($i = 1; $i < count($data); $i++) {
      if ($data[$i][4] === $_GET["category"]) {
        $filtered_data[] = $data[$i];
      }
    }
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
    <title>Catalog</title>
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
    <main class="page catalog-page">
      <section class="clean-block clean-catalog dark">
        <div class="container">
          <div class="block-heading">
            <h2 class="text-info">Catalog Page</h2>
            <p>All your favorite books are here</p>
          </div>
          <div class="content">
            <div class="row">
              <div class="col-md-3">
                <div class="d-none d-md-block">
                    <div class="filters">
                      <h3>Categories</h3>
                        <div class="form-check">
                        <form method="get" action="catalog-page.php">
                          <button class="form-check-input" type="radio" name="category" value="Business & Money"></button> <label for="min_price">Business & Money</label> <br>
                          <button class="form-check-input" type="radio" name="category" value="Light Novel"></button> <label for="min_price">Light Novel</label> <br>
                          <button class="form-check-input" type="radio" name="category" value="Mystery, Thriller & Suspense"></button> <label for="min_price">Mystery, Thriller & Suspense</label> <br>
                          <button class="form-check-input" type="radio" name="category" value="Romance"></button> <label for="min_price">Romance</label> <br> <br>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="products">
                  <div class="row g-0">
                  <?php for ($i = 0; $i < count($filtered_data); $i++): ?> 
                    <div class="col-12 col-md-6 col-lg-4">
                      <div class="clean-product-item">
                        <div class="image">
                          <a href="./product-page.php?id=<?php echo $filtered_data[$i][0] ?>"
                            ><img
                              class="img-fluid d-block mx-auto"
                              src="assets/img/<?php echo $filtered_data[$i][0] ?>.jpg"
                          /></a>
                        </div>
                        <div class="product-name"><a href="./product-page.php?id=<?php echo $filtered_data[$i][0] ?>"><?php echo $filtered_data[$i][1] ?></a></div>
                        <div class="about">
                          <div class="price"><h3>$<?php echo $filtered_data[$i][3] ?></h3></div>
                        </div>
                      </div>
                    </div>
                  <?php endfor; ?>
                  </div>
                </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <?php include_once ('footer.php'); ?>
  </body>
  
  <script>
    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user" && $_SESSION["logged_in"] === "true"): ?>
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    <?php endif; ?>
  </script>
</html>