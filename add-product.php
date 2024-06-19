<?php
  session_start();
  include("logincon.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //$user_username = $_POST['user_username'];
    //$product_type=$_POST['product_type'];
    $product_name = isset($_POST['product_name'])? $_POST['product_name'] : '';
    $product_type = $_POST['product_type'];
    //$product_type = isset($_POST['product_type'])? $_POST['product_type'] : '';
    $product_price = isset($_POST['product_price'])? $_POST['product_price'] : '';
    //$product_image = isset($_FILES['product_image'])? $_POST['product_image'] : '';
    //$temp_image = isset($_FILES['product_image'])? $_POST['product_image'] : '';
    $product_image = $_FILES['product_image']['name'];
    // $product_image1 = $_POST['product_image1']['name']? $_POST['product_image1']['name'] : '';
    // $product_image2 = $_POST['product_image2']['name']? $_POST['product_image2']['name'] : '';

    $temp_image = $_FILES['product_image']['tmp_name'];
    // $temp_image1 = $_POST['product_image1']['tmp_name']? $_POST['product_image1']['tmp_name'] : '';
    // $temp_image2 = $_POST['product_image2']['tmp_name']? $_POST['product_image2']['tmp_name'] : '';

    move_uploaded_file($temp_image, "./img/product/$product_image");
    // move_uploaded_file($temp_image1, "./img/product/$product_image1");
    // move_uploaded_file($temp_image2, "./img/product/$product_image2");
    //add product image
    // if(isset($_POST['insert_product']) && isset($_FILES['product_image']))
    // {
    //   echo "<pre>";
    //   print_r($_FILES['product_image']);
    //   echo "</pre>";

    //   $img_name = $_FILES['product_image']['name'];
    //   $img_size = $_FILES['product_image']['size'];
    //   $tmp_name = $_FILES['product_image']['tmp_name'];
    //   $error = $_FILES['product_image']['error'];
      
    //   if($error === 0)
    //   {
    //     if($img_size > 125000)
    //     {
    //       $em = "Sorry, your file is too large.";
    //       header("Location: adminhome.php?error=$em");
    //     }
    //     else
    //     {
    //       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    //       $img_ex_lc = strtolower($img_ex);

    //       $allowed_exs = array("jpg", "jpeg", "png");

    //       if(in_array($img_ex_lc, $allowed_exs))
    //       {
    //         $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
    //         $img_upload_path = 'product uploads/'.$new_img_name;
    //         move_uploaded_file($tmp_name, $img_upload_path);
    //       }
    //       else
    //       {
    //         $em = "You can't upload this type of file.";
    //         header("Location: adminhome.php?error=$em");
    //       }
    //     }
    //   }
    //   else
    //   {
    //     $em = "Unknown error occured!";
    //     header("Location: adminhome.php?error=$em");
    //   }
    // }
    //store to db
    $insert_query="insert into products (product_name, product_type, product_price, product_image) values('$product_name', '$product_type', '$product_price', '$product_image')";
    $result=mysqli_query($con,$insert_query);
    if($result)
    {
      $_SESSION['message'] = "Product has been insert succesfully";
      header("Location: products.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin | Add Product</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>
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
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-shopping-cart"></i>
                            Products
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
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Add Product</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="" class="tm-edit-product-form" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input id="name" name="product_name" type="text" class="form-control validate" required>
                  </div>
                  <div class="form-group mb-3"><label for="category">Category</label>
                    <select name="product_type" class="custom-select tm-select-accounts" id="category">
                      <option selected>Select category</option>
                      <option value="Men Casual">Men Casual</option>
                      <option value="Men T-shirt">Men T-shirt</option>
                      <option value="Men Trousers">Men Trousers</option>
                      <option value="Women Casual">Women Casual</option>
                      <option value="Women Formal">Women Formal</option>
                      <option value="Women Trousers">Women Trousers</option>
                      <option value="Kids Casual">Kids Casual</option>
                      <option value="Kids T-shirt">Kids T-shirt</option>
                      <option value="Kids Trousers">Kids Trousers</option>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Product Price</label>
                    <input id="name" name="product_price" type="text" class="form-control validate" placeholder = "RM" required/>
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Product Image</label>
                    <br>
                    <?php if(isset($_GET['error'])): ?>
                    <p><?php echo $_GET['error']; ?></p>
                    <?php endif ?>
                    <input type="file" name="product_image">
                  </div>
              </div>

              
              


              <div class="col-12">
                <input type="submit" name="insert_product" value="Add Product" class="btn btn-primary btn-block text-uppercase">
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>        
    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved. 
            
            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
        </div>
    </footer> 
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!-- ALERTIFY JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>
            <?php if(isset($_SESSION['message']))
            {?>
                alertify.set('notifier','position', 'top-right');
                alertify.success('<?= $_SESSION['message'] ?>');
    <?php   
            unset($_SESSION['message']);
            } ?>
        </script>
    <script>
      $(function() {
        $("#expire_date").datepicker();
      });
    </script>
  </body>
</html>