<?php
  session_start();

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
    header("Location: ./woops.php");
  } 

  $json = json_decode(file_get_contents("./database.json"), TRUE);
  $all_orders = $json["orders"];
  $filtered_order = $all_orders[$_GET["id"] - 1];

  $total = 0;

  for ($i = 1; $i < count($filtered_order["cart"]) + 1; $i++) {
    $total += $filtered_order["cart"][$i]["price"];
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
    <title>Order</title>
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
    <main class="page payment-page">
      <section class="clean-block payment-form dark">
        <div class="container">
          <div class="block-heading"></div>
          <form style="border-color: #332c54">
            <div class="products" style="background: #f7f5ff">
              <h1 class="text-center title">ORDER</h1>
              <?php for ($i = 1; $i < count($filtered_order["cart"]) + 1; $i++): ?>
                <div class="item">
                  <span class="price">$<?php echo $filtered_order["cart"][$i]["price"]; ?></span>
                  <p class="item-name"><?php echo $filtered_order["cart"][$i]["product_name"]; ?>   x<?php echo $filtered_order["cart"][$i]["quantity"] ?></p>
                </div>
              <?php endfor; ?>
              <div class="total">
                <span>Total</span><span class="price">$<?php echo $total ?></span>
              </div>
            </div>
            <div class="card-details">
              <h3 class="title">Customer details</h3>
              <div class="row">
                <div class="col-sm-8" style="width: 500px">
                  <div class="mb-3">
                    <label class="form-label" for="card_number"
                      >customer name</label
                    >
                    <p><?php echo $filtered_order["customer"]; ?></p>
                  </div>
                </div>
                <div class="col-sm-8" style="width: 500px">
                  <div class="mb-3">
                    <label class="form-label" for="card_number">address</label>
                    <p><?php echo $filtered_order["address"]; ?></p>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="mb-3">
                    <?php if ($filtered_order["status"] === "active"): ?>
                    
                      <button
                        class="btn btn-primary d-block w-100"
                        style="background: var(--bs-orange); border-color: #332c54;"
                        disabled
                      >
                        ACTIVE
                      </button>

                    <?php endif; ?>

                    <?php if ($filtered_order["status"] === "delivered"): ?>
                    
                      <button 
                        class="btn btn-primary d-block w-100"
                        style="background: var(--bs-teal); border-color: #332c54"
                        disabled>
                        
                        DELIVERED
                      </button>

                    <?php endif; ?>
                    
                    <?php if ($filtered_order["status"] === "canceled"): ?>

                      <button 
                        class="btn btn-primary d-block w-100"
                        style="background: var(--bs-red); border-color: #332c54"
                        disabled>
                        
                        CANCELED
                      </button>

                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </form>
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
  </script>
</html>
