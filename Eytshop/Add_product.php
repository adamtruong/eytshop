<?php
  $data_json = json_decode(file_get_contents("./database.json"), TRUE);
  $data_csv = fopen("product.csv", "a");

  if (isset($_POST["product_name"]) && isset($_POST["price"]) && isset($_POST["author"]) && isset($_POST["length"]) && isset($_POST["category"]) && isset($_POST["description"])) {
    $newdata_json = array (
      "submit_id" => count($data_json["vendor_submissions"]) + 1,
      "product_name" => $_POST["product_name"],
      "price" => $_POST["price"],
      "author" => $_POST["author"],
      "category" => $_POST["category"],
      "length" => $_POST["length"],
      "description" => $_POST["description"]
    );

    $newdata_csv = count(file("./product.csv")) . "|" . $_POST["product_name"] . "|" . $_POST["author"] . "|" . $_POST["price"] . "|". $_POST["category"] . "|". $_POST["length"] . "|". $_POST["description"];

    $data_json["vendor_submissions"][] = $newdata_json;
    file_put_contents("./database.json", json_encode($data_json, JSON_PRETTY_PRINT));

    fputcsv($data_csv, explode(",", $newdata_csv));
    fclose($data_csv);
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
    <title>Add product</title>
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
  
    <main class="page login-page">
      <section class="clean-block clean-form dark" style="background: #332c54">
        <div class="container" style="margin: 0px 35px">
          <div class="block-heading"></div>
          <form
            style="
              --bs-info: #332c54;
              --bs-info-rgb: 51, 44, 84;
              border-color: #332c54;
            "
            action="Add_product.php"
            method="post"
          >
            <h2
              class="text-uppercase text-info"
              style="
                --bs-info: #332c54;
                --bs-info-rgb: 51, 44, 84;
                text-align: center;
              "
            >
              <strong>ADD PRODUCT</strong>
            </h2>
            <div class="mb-3">
              <label class="form-label" for="product_name">Product Name</label
              ><input class="form-control item" type="text" name="product_name" id="product_name" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="price">Price</label
              ><input class="form-control" type="number" step=0.01 name="price" id="price" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="author">Author</label
              ><input class="form-control item" type="text" name="author" id="author" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="length">Length</label
              ><input class="form-control" type="number" name="length" id="length" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="category">Category</label
              ><input class="form-control item" type="text" name="category" id="category"/>
            </div>
            <div class="mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control" type="text" name="description" id="description"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label" for="profile"
                >Upload product picture</label>
                <label
                class="form-label"
                id="user_group_label"
                for="user_group_logo"
                style="margin-left: 110px; margin-right: 103px">
              <i class="fas fa-upload"></i>&nbsp;Choose an image...</label>
            </div>
            <div class="mb-3"></div>
            <button
              class="btn btn-primary d-block btn-user w-100"
              type="submit"
              style="background: #332c54"
            >
              CONFIRM PRODUCT</button
            ><a href="index.php" style="color: rgb(0, 0, 0)"></a
            ><a class="link-dark" href="login.php"></a>
          </form>
        </div>
        <div class="container">
          <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0"></div>
          </div>
        </div>
      </section>
    </main>
   <!-- Footer -->
   <?php include_once ('footer.php'); ?>
  </body>

  <script>
    function add_product() {
      let name = document.getElementById("product_name").getAttribute("value");
      
      alert(name);
    }
  </script>
</html>

