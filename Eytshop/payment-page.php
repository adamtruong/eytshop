<?php
 session_start();

 if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] !== "user") {
  header("Location: ./woops.php"); 
 }

 $data = json_decode(file_get_contents("./cart.json"), TRUE);
 $order = $data["cart"];

$subtotal = 0;
$discount = 0;
$shipping = 0;


for ($i = 0; $i < count($order); $i++) {
  $subtotal += $order[$i]["price"];
}

$total = $subtotal + $discount + $shipping;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Payment</title>
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
          <div class="block-heading"><h2 class="text-info">Payment</h2></div>
          <form style="border-color: #332c54" method="post" action="thankyou.php">
            <div class="products" style="background: #f7f5ff">
              <h3 class="title">Checkout</h3>
              <?php for ($i = 0; $i < count($order); $i++): ?>
                <div class="item">
                  <span class="price">$<?php echo $order[$i]["price"]; ?></span>
                  <p class="item-name"><?php echo $order[$i]["item_name"]; ?></p>
                </div>
              <?php endfor; ?>
              <div class="total">
                <span>Total</span><span class="price">$<?php echo $total; ?></span>
              </div>
            </div>
            <div class="card-details">
              <h3 class="title">Credit Card Details</h3>
              <div class="row">
                <div class="col-sm-7">
                  <div class="mb-3">
                    <label class="form-label" for="card_holder"
                      >Card Holder</label
                    ><input
                      class="form-control"
                      type="text"
                      id="card_holder"
                      placeholder="Card Holder"
                      name="card_holder"
                    />
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="mb-3">
                    <label class="form-label">Expiration date</label>
                    <div class="input-group expiration-date">
                      <input
                        class="form-control"
                        type="text"
                        placeholder="MM"
                        name="expiration_month"
                      /><input
                        class="form-control"
                        type="text"
                        placeholder="YY"
                        name="expiration_year"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="mb-3">
                    <label class="form-label" for="card_number"
                      >Card Number</label
                    ><input
                      class="form-control"
                      type="text"
                      id="card_number"
                      placeholder="Card Number"
                      name="card_number"
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label class="form-label" for="cvc">CVC</label
                    ><input
                      class="form-control"
                      type="text"
                      id="cvc"
                      placeholder="CVC"
                      name="cvc"
                    />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="mb-3">
                    <input
                      class="btn btn-primary d-block w-100"
                      name="purchased"
                      value="purchased"
                      type="submit"
                      style="background: #332c54; border-color: #332c54"
                    >
                      Proceed
                    </input>
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
    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user" && $_SESSION["logged_in"] === "true"): ?>
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    <?php endif; ?>
  </script>
</html>
