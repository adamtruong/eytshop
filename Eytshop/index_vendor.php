<?php
  session_start();

  if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "vendor"){
    header("Location: ./login-vendor.php");
  }

  $json = json_decode(file_get_contents("./database.json"), TRUE);
  $all_vendor_submissions = $json["vendor_submissions"];
  $filtered_submissions = [];

  for ($i = 0; $i < count($all_vendor_submissions); $i++) {
    if (isset($_SESSION["username"]) && $all_vendor_submissions[$i]["business_name"] === $_SESSION["business_name"]) {
      $filtered_submissions[] = $all_vendor_submissions[$i];
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
    <title>Vendor page</title>
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
          <h2>WELCOME TO THE VENDOR PAGE</h2>
          <p>Manage your submissions here</p>
        </div>
      </section>
      <section class="clean-block slider dark">
        <div class="container-fluid">
          <h1
            class="text-center text-dark mb-4"
            style="margin-top: 26px; font-weight: bold"
          >
            VIEW PRODUCTS
          </h1>
          <div class="card shadow">
            <div class="card-header py-3" style="background: #332c54"></div>
            <div class="card-body">
              <div
                class="table-responsive table mt-2"
                id="dataTable-1"
                role="grid"
                aria-describedby="dataTable_info"
              >
                <table class="table my-0" id="dataTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i = 0; $i < count($filtered_submissions); $i++): ?>
                      <tr>
                        <td><?php echo $filtered_submissions[$i]["product_name"]; ?></td>
                        <td><?php echo $filtered_submissions[$i]["category"]; ?></td>
                        <td>$<?php echo $filtered_submissions[$i]["price"]; ?></td>
                      </tr>
                    <?php endfor; ?>
                  </tbody>
                </table>
              </div>
              <div class="row justify-content-center">
                <div class="col-5">
                  <a
                    class="btn btn-primary d-block btn-user w-100"
                    role="button"
                    style="background: #332c54"
                    href="Add_product.php"
                    >Add new product</a
                  >
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
