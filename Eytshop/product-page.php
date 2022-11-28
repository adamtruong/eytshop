<?php
  session_start();

  if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] !== "user") {
    header("Location: ./woops.php");
  } 
   
  if (!isset($_GET["id"])) {
    header("Location: ./woops.php"); 
  }
  
  $file = file("./product.csv");
  $current = str_getcsv($file[$_GET["id"]], "|");


  $category = $current[4];
  $data = [];
  $related = [];

  foreach($file as $line) {
    $data[] = str_getcsv($line, "|");
  }

  for ($i = 0; $i < count($data); $i++) {
    if ($data[$i][4] === $category) {
        $related[] = $data[$i];
    }
  }

  if (isset($_POST["add_to_cart"])) {
    $cart = json_decode(file_get_contents("./cart.json"), TRUE);

    $new_product = array (
      "item_id" => $_GET["id"],
      "item_name" => $current[1],
      "quantity" => $_POST["quantity"],
      "price" => $current[3] * $_POST["quantity"]
    );

    $cart["cart"][] = $new_product;

    file_put_contents("./cart.json", json_encode($cart, JSON_PRETTY_PRINT));
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
    <title><?php echo $current[1]; ?></title>
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
    <main class="page product-page">
      <section class="clean-block clean-product dark">
        <div class="container">
          <div class="block-content">
            <div class="product-info">
              <div class="row">
                <div class="col-md-6">
                  <div class="gallery">
                    <div id="product-preview" class="vanilla-zoom">
                      <div class="zoomed-image"></div>
                      <div class="sidebar">
                        <img
                          class="img-fluid d-block small-preview"
                          src="assets/img/<?php echo $current[0]; ?>.jpg"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-6"
                  style="
                    --bs-info: #332c54;
                    --bs-info-rgb: 51, 44, 84;
                    --bs-body-color: #332c54;
                  "
                >
                  <div class="info">
                    <h1
                      class="fw-bold"
                      style="
                        margin-bottom: 0px;
                        padding-top: 0px;
                        margin-top: 130px;
                        text-align: left;
                        color: #332c54;
                      "
                    >
                      <?php echo $current[1]; ?>
                    </h1>
                    <div class="price">
                      <h3 style="text-align: left">$<?php echo $current[3]; ?></h3>
                    </div>
                    <div class="summary">
                      <form action="product-page.php?id=<?php echo $current[0] ?>" method="post">
                        <input
                          class="btn btn-primary"
                          type="submit"
                          name="add_to_cart"
                          value="Add to cart"
                          style="background: #332c54; border-color: #ffffff"
                        >
                        </input>
                        <input type="number" id="quantity" name="quantity" value=1 step=1>
                      </form>
                      <p><?php if (isset($_POST["add_to_cart"])) { echo "Successfully added " . $_POST["quantity"] . " to cart!"; } ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-info">
              <div>
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <li class="nav-item" role="presentation">
                    <a
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      id="specifications-tabs"
                      href="#specifications"
                      style="
                        --bs-info: #332c54;
                        --bs-info-rgb: 51, 44, 84;
                        color: #332c54;
                      "
                      >Details</a
                    >
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div
                    class="tab-pane fade show active description"
                    role="tabpanel"
                    id="description"
                  >
                    <p>
                      <br /><span
                        style="
                          color: rgb(0, 0, 0);
                          background-color: transparent;
                        "
                        ><?php echo nl2br($current[6]); ?></span
                      ><br />
                    </p>
                  </div>
                  <div
                    class="tab-pane fade specifications"
                    role="tabpanel"
                    id="specifications"
                  >
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="stat">Author</td>
                            <td>&nbsp;<?php echo $current[2]; ?></td>
                          </tr>
                          <tr>
                            <td class="stat">Print length</td>
                            <td>
                              <span
                                style="
                                  color: rgb(0, 0, 0);
                                  background-color: transparent;
                                "
                                ><?php echo $current[5]; ?></span
                              ><br />
                            </td>
                          </tr>
                          <tr></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" role="tabpanel" id="reviews">
                    <div class="reviews">
                      <div class="review-item">
                        <div class="rating">
                          <img src="star.svg" /><img src="star.svg" /><img
                            src="star.svg"
                          /><img src="star.svg" /><img src="star-empty.svg" />
                        </div>
                        <h4>Incredible product</h4>
                        <span class="text-muted"
                          ><a href="#">John Smith</a>, 20 Jan 2018</span
                        >
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Donec augue nunc, pretium at augue at, convallis
                          pellentesque ipsum. Lorem ipsum dolor sit amet,
                          consectetur adipiscing elit.
                        </p>
                      </div>
                    </div>
                    <div class="reviews">
                      <div class="review-item">
                        <div class="rating">
                          <img src="star.svg" /><img src="star.svg" /><img
                            src="star.svg"
                          /><img src="star.svg" /><img src="star-empty.svg" />
                        </div>
                        <h4>Incredible product</h4>
                        <span class="text-muted"
                          ><a href="#">John Smith</a>, 20 Jan 2018</span
                        >
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Donec augue nunc, pretium at augue at, convallis
                          pellentesque ipsum. Lorem ipsum dolor sit amet,
                          consectetur adipiscing elit.
                        </p>
                      </div>
                    </div>
                    <div class="reviews">
                      <div class="review-item">
                        <div class="rating">
                          <img src="star.svg" /><img src="star.svg" /><img
                            src="star.svg"
                          /><img src="star.svg" /><img src="star-empty.svg" />
                        </div>
                        <h4>Incredible product</h4>
                        <span class="text-muted"
                          ><a href="#">John Smith</a>, 20 Jan 2018</span
                        >
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Donec augue nunc, pretium at augue at, convallis
                          pellentesque ipsum. Lorem ipsum dolor sit amet,
                          consectetur adipiscing elit.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clean-related-items">
              <h3>Related Products</h3>
              <div class="items">
                <div class="row justify-content-center">
                  <div class="col-sm-6 col-lg-4">
                    <div class="clean-related-item">
                      <div class="image">
                        <a href="./product-page.php?id=<?php echo $related[0][0]; ?>"
                          ><img
                            class="img-fluid d-block mx-auto"
                            src="assets/img/<?php echo $related[0][0]; ?>.jpg"
                        /></a>
                      </div>
                      <div class="related-name">
                        <a href="./product-page.php?id=<?php echo $related[0][0]; ?>"><?php echo $related[0][1]; ?></a>
                        <div class="rating"></div>
                        <h4 style="color: #332c54"><?php echo $related[0][3]; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="clean-related-item">
                      <div class="image">
                        <a href="./product-page.php?id=<?php echo $related[1][0]; ?>"
                          ><img
                            class="img-fluid d-block mx-auto"
                            src="assets/img/<?php echo $related[1][0]; ?>.jpg"
                        /></a>
                      </div>
                      <div class="related-name">
                        <a href="./product-page.php?id=<?php echo $related[1][0]; ?>"><?php echo $related[1][1]; ?></a>
                        <h4 style="color: #332c54"><?php echo $related[1][3]; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="clean-related-item">
                      <div class="image">
                        <a href="./product-page.php?id=<?php echo $related[2][0]; ?>"
                          ><img
                            class="img-fluid d-block mx-auto"
                            src="assets/img/<?php echo $related[2][0]; ?>.jpg"
                        /></a>
                      </div>
                      <div class="related-name">
                        <a href="./product-page.php?id=<?php echo $related[2][0]; ?>"><?php echo $related[2][1]; ?></a>
                        <h4 style="color: #332c54"><?php echo $related[2][3]; ?></h4>
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
    <?php if (isset($_SESSION["user_type"]) && $_SESSION["logged_in"] === "true"): ?>
      document.getElementById("login").innerHTML = "Welcome, <?php echo $_SESSION["username"] ?>!";
      document.getElementById("login").setAttribute("href", "profile.php");
    <?php endif; ?>
  </script>
</html>
