<?php
  include("includes/connect.php");
  include("logincon.php");

  if(isset($_POST['delete_product_button']))
  {
    $product_id = $_POST['product_id'];

    $product_query = "SELECT * FROM products WHERE product_id = '$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $product_image = $product_data['product_image'];

    $delete_query = "DELETE FROM products WHERE product_id = '$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
      if(file_exists("img/product".$product_image))
      {
        unlink("img/product".$product_image);
      }
      echo 200;
    }
    else
    {
      echo 500;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin | Product</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
  <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="index.php">
          <h1 class="tm-site-title mb-0">Product Admin</h1>
        </a>
        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto h-100">
            <li class="nav-item">
              <a class="nav-link" href="adminhome.php">
                <i class="fas fa-tachometer-alt"></i> Dashboard
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="products.php">
                <i class="fas fa-shopping-cart"></i> Products
              </a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="logout.php">
                Admin, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container" id="products_table">
            <table class="table table-hover tm-table-small tm-product-table">
                    <thead>
                      <tr>
                        <th scope='col'>PRODUCT NAME</th>
                        <th scope='col'>CATEGORY</th>
                        <th scope='col'>PRICE</th>
                        <th scope='col'>&nbsp;</th>
                      </tr>
                    </thead>
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) > 0)
            {
              while($row = mysqli_fetch_assoc($result))
              {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_type = $row['product_type'];
                $product_price = $row['product_price'];

                  echo "
                    <tbody>
                      <tr>
                        <td class='tm-product-name'>$product_name</td>
                        <td>$product_type</td>
                        <td>RM $product_price</td>
                        <td>
                          <button type='button' value='$product_id' class='tm-product-delete-link delete_product_button'>
                            <i class='far fa-trash-alt tm-product-delete-icon'></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  ";
                }
              }?>
              </table>
            </div>
            <!-- table container -->
            <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
      </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/customadmin.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!-- <script>
      $(function() {
        $(".tm-product-name").on("click", function() {
          window.location.href = "edit-product.php";
        });
      });
    </script> -->
  </body>
</html>