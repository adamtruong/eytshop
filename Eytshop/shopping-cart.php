<?php
  session_start();

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] !== "user") {
    header("Location: ./woops.php");
  }

  $cart = json_decode(file_get_contents("./cart.json"), TRUE);

  $subtotal = 0;
  $discount = 0;
  $shipping = 0;
  

  for ($i = 0; $i < count($cart["cart"]); $i++) {
    $subtotal += $cart["cart"][$i]["price"];
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
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
  </head>
  <body>
  <?php
  include_once 'header.php';
  ?>
    <main class="page shopping-cart-page">
      <section class="clean-block clean-cart dark">
        <div class="container">
          <div class="block-heading">
            <h2 class="text-info">Shopping Cart</h2>
          </div>
          <div class="content">
            <div class="row g-0">
              <div class="col-md-12 col-lg-8">
                <div class="items">
                  <?php for ($i = 0; $i < count($cart["cart"]); $i++): ?>
                    <div class="product">
                      <div class="row justify-content-center align-items-center">
                        <div class="col-md-3">
                          <div class="product-image">
                            <img
                              class="img-fluid d-block mx-auto image"
                              
                              src="assets/img/<?php echo $cart["cart"][$i]["item_id"]; ?>.jpg"
                            />
                          </div>
                        </div>
                          <div class="col-md-5 product-info">
                            <a
                            class="product-name"
                            href="product-page.php?id=<?php echo $cart["cart"][$i]["item_id"]; ?>"
                            style="color: #332c54; border-color: #332c54"
                            ><?php echo $cart["cart"][$i]["item_name"]; ?></a>
                            <div class="product-specs"></div>
                          </div>
                        

                        
                          <div class="col-6 col-md-2 quantity">
                            <label
                              class="form-label d-none d-md-block"
                              for="quantity"
                              >Quantity: </label
                            ><?php echo $cart["cart"][$i]["quantity"]; ?>
                          </div>
                          <div class="col-6 col-md-2 price"><span>$<?php echo $cart["cart"][$i]["price"]; ?></span></div>
                        </div>
                      </div>
                    </div>
                  <?php endfor; ?>
               </div>
              <div class="col-md-12 col-lg-4">
                <div class="summary" style="background: #f7f5ff">
                  <h3>Summary</h3>
                  <h4 style="border-color: #332c54">
                    <span class="text">Subtotal</span
                    ><span class="price">$<?php echo $subtotal; ?></span>
                  </h4>
                  <h4>
                    <span class="text">Discount</span
                    ><span class="price">$<?php echo $discount; ?></span>
                  </h4>
                  <h4>
                    <span class="text">Shipping fees</span
                    ><span class="price">$<?php echo $shipping; ?></span>
                  </h4>
                  <h4>
                    <span class="text" style="color: #332c54">Total</span
                    ><span
                      class="price"
                      style="color: #332c54; font-weight: bold"
                      >$<?php echo $total; ?></span
                    >
                  </h4>
                  <form action="payment-page.php">
                    <input 
                      class="btn btn-primary btn-lg d-block w-100"
                      style="background: #332c50; border-color: #332c54"
                      type="submit" 
                      value="Checkout">
                  </form>
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
    <?php if (isset($_SESSION["user_type"]) && $_SESSION["logged_in"] === "true"): ?>
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    <?php endif; ?>
  </script>
</html>
