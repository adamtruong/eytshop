<?php
  session_start();

  if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== "shipper"){
    header("Location: ./login-shipper.php");
  }

  $json = json_decode(file_get_contents("./database.json"), TRUE);
  $all_orders = $json["orders"];
  $filtered_orders = [];

  for ($i = 0; $i < count($all_orders); $i++) {
    if (isset($_SESSION["username"]) && $all_orders[$i]["assigned_shipper"] === $_SESSION["username"]) {
      $filtered_orders[] = $all_orders[$i];
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
    <title>Shipment page</title>
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
          <h2>WELCOME TO THE SHIPMENT PAGE</h2>
          <p>Manage your orders here</p>
        </div>
      </section>
      <section class="clean-block slider dark">
        <div class="container-fluid">
          <h1
            class="text-center text-dark mb-4"
            style="margin-top: 26px; font-weight: bold"
          >
            VIEW ORDER
          </h1>
          <div class="card shadow">
            <div class="card-header py-3" style="background: #332c54">
              <p
                class="text-primary m-0 fw-bold"
                style="--bs-primary: #f1f1f1; --bs-primary-rgb: 241, 241, 241"
              >
                IN HANOI
              </p>
            </div>
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
                      <th>No.</th>
                      <th>Customer Name</th>
                      <th>Purchase date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i = 0; $i < count($filtered_orders); $i++): ?>
                      <tr>
                        <td><?php echo $filtered_orders[$i]["id"]; ?></td>
                        <td><?php echo $filtered_orders[$i]["customer"]; ?></td>
                        <td><?php echo $filtered_orders[$i]["date_placed"]; ?></td>
                        <td>
                          <a
                            class="btn btn-danger"
                            role="button"
                            href="ship_order.php?id=<?php echo $filtered_orders[$i]["id"]; ?>"
                            >Details</a
                          >
                        </td>
                      </tr>
                    <?php endfor; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid"><div class="card shadow"></div></div>
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