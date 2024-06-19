<?php
  session_start();
  error_reporting(0);
  include("includes/connect.php");
  include("logincon.php");
  
  if(isset($_POST['placeOrderBtn']))
  {
    //$current_user = $_SESSION['auth_user']['user_email'];
    $credit_num = mysqli_real_escape_string($con, $_POST['credit_num']);
    $credit_cvc = mysqli_real_escape_string($con, $_POST['credit_cvc']);
    // $credit_num = $_POST['credit_num'];
    // $credit_cvc = $_POST['credit_cvc'];

    $qry = "SELECT * FROM credits WHERE credit_num='$credit_num' AND credit_cvc='$credit_cvc' ";
    $run_qry = mysqli_query($con, $qry);
    if(mysqli_num_rows($run_qry) > 0)
    {
        $user_email = $_SESSION['auth_user']['user_email'];
        $users = "SELECT * FROM users WHERE user_email ='$user_email'";
        $users_run = mysqli_query($con, $users);

        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
              //$user_id = $_SESSION['auth_user']['user_id'];
                $user_id = $user['user_id'];
                $user_email = $user['user_email'];
                $user_fullname = $user['user_fullname'];
                $user_address = $user['user_address'];
                $user_phone = $user['user_phone'];
                $order_tracking = "mmuOutlet".rand(1111,9999).substr($order_phone,2);
                
                $total_query = "SELECT * FROM carts c, products p  WHERE c.product_id=p.product_id AND c.user_id ='$user_id'";
                $run_total_query = mysqli_query($con, $total_query);
                
                $query = "SELECT c.cart_id as cid, c.product_id, p.product_id as pid, p.product_name, p.product_image, p.product_price 
                          FROM carts c, products p WHERE c.product_id=p.product_id AND c.user_id ='$user_id' ORDER BY c.cart_id DESC";
                $query_run = mysqli_query($con, $query);

                if(is_array($query_run) || is_object($query_run))
                {
                  foreach($query_run as $item)
                  {
                    $total = $total + $item['product_price'];
                  }
                }
                $insert_query = "INSERT INTO orders (order_tracking, user_id, order_name, order_email, order_phone, order_address, order_total, order_cnum, order_ccvc) 
                VALUES ('$order_tracking', '$user_id', '$user_fullname', '$user_email', '$user_phone', '$user_address', '$total', '$credit_num', '$credit_cvc')";
                $insert_query_run = mysqli_query($con, $insert_query);
                
                header('Location: myorder.php');
            }
        }
    }    
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Checkout Page</title>
    
    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">
    <!-- Top Slider CSS -->
    <link href="css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

  </head>
  <body>
  <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
<!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <header id="aa-header">
      <!-- start header top  -->
      <div class="aa-header-top">
      <div class="container">
          <div class="row">
          <div class="col-md-12">
              <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                  <!-- start language -->
                  <div class="aa-language">
                      <div class="dropdown">
                          <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <img src="img/flag/english.jpg" alt="english flag">ENGLISH
                          <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <li><a href="#"><img src="img/flag/english.jpg" alt="">ENGLISH</a></li>
                          </ul>
                      </div>
                  </div>
                  <!-- / language -->
  
                  <!-- start currency -->
                  <div class="aa-currency">
                      <div class="dropdown">
                          <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <i class="fa fa-usd"></i>MYR
                          <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <li><a href="#"><i class="fa fa-usd"></i>MYR</a></li>
                          </ul>
                      </div>
                  </div>
                  <!-- / currency -->
                  <!-- start cellphone -->
                  <div class="cellphone hidden-xs">
                      <p><span class="fa fa-phone"></span>013-781 5280</p>
                  </div>
                  <!-- / cellphone -->
              </div>
              <!-- / header top left -->
                  <div class="aa-header-top-right">
                      <ul class="aa-head-top-nav-right">
                      <?php
                        if(!isset($_SESSION['auth']))
                        {?>
                            <li class="hidden-xs"><a href="login.php">Login </a></li>
                <?php   } ?> 
                        <li class="hidden-xs"><a href="editprofile.php">Edit Profile</a></li>
                        <li class="hidden-xs"><a href="cart.php">My Cart</a></li>
                        <li class="hidden-xs"><a href="checkout.php">Checkout</a></li>
                        <li class="hidden-xs"><a href="myorder.php">My Order</a></li>
                        <?php
                        if(isset($_SESSION['auth']))
                        {?>
                            <li class="hidden-xs"><a href="logout.php">Log out</a></li>
                <?php   } ?> 
                      </ul>
                  </div>
              </div>
          </div>
          </div>
      </div>
      </div>
      <!-- / header top  -->
  
      <!-- start header bottom  -->
      <div class="aa-header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="aa-header-bottom-area">
                <!-- logo  -->
                <div class="aa-logo">
                  <!-- Text based logo -->
                  <!-- Text based logo -->
                <a href="index.php">
                <span class="fa fa-shopping-cart"></span>
                <?php
                    if(isset($_SESSION['auth']))
                    {?>
                        <p>MMU<strong>OULET</strong> <span>Hello, <?= $_SESSION['auth_user']['user_fullname']; ?></span></p>
            <?php   } ?>    
                </a>
                  <!-- img based logo -->
                  <!-- <a href="index.php"><img src="img/logo.jpg" alt="logo img"></a> -->
                </div>
                <!-- / logo  -->        
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
        <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="#">Men <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="mencasual.php">Casual</a></li>                                                
                  <li><a href="menshirt.php">T-Shirts</a></li>
                  <li><a href="mentrousers.php">Trousers</a></li>
                </ul>
              </li>
              <li><a href="#">Women <span class="caret"></span></a>
                <ul class="dropdown-menu">  
                  <li><a href="womencasual.php">Casual</a></li>                                                   
                  <li><a href="womenformal.php">Formal</a></li>              
                  <li><a href="womentrousers.php">Trousers</a></li>
                </ul>
              </li>
              <li><a href="#">Kids <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="kidcasual.php">Casual</a></li>                                              
                  <li><a href="kidshirt.php">T-Shirts</a></li>
                  <li><a href="kidtrousers.php">Trousers</a></li>
                </ul>
              </li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->  
      
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="img/bpkids.png" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
        <div class="aa-catg-head-banner-content">
          <h2>Checkout Page</h2>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>                   
            <li class="active">Checkout</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <form action="checkout.php" method="POST">
        <div class="checkout-area">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Shipping Address -->
                      <?php
                        $user_email = $_SESSION['auth_user']['user_email'];
                        $users = "SELECT * FROM users WHERE user_email ='$user_email'";
                        $users_run = mysqli_query($con, $users);

                        if(mysqli_num_rows($users_run) > 0)
                        {
                            foreach($users_run as $user)
                            {?>
                                <div class="panel panel-default aa-checkout-billaddress">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        Shippping Address
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="aa-checkout-single-bill">
                                            <p>Email: <?php
                                                  if(isset($_SESSION['auth']))
                                                  {?>
                                                      <?= $_SESSION['auth_user']['user_email']; ?>
                                          <?php   } ?> </p>
                                          </div>                             
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="aa-checkout-single-bill">
                                            <p>Full Name: <?php
                                                    if(isset($_SESSION['auth']))
                                                    {?>
                                                        <?= $_SESSION['auth_user']['user_fullname']; ?>
                                            <?php   } ?> </p>
                                          </div>                             
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="aa-checkout-single-bill">
                                            <p>Address: <?php
                                                      if(isset($_SESSION['auth']))
                                                      {?>
                                                          <?= $_SESSION['auth_user']['user_address']; ?>
                                              <?php   } ?> </p>
                                          </div>                             
                                          </div>
                                          <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                              <p>Phone Number: <?php
                                                          if(isset($_SESSION['auth']))
                                                          {?>
                                                              <?= $_SESSION['auth_user']['user_phone']; ?>
                                                  <?php   } ?> </p>
                                            </div>
                                          </div>
                                        <button><a href="editprofile.php">Change Shipping Detail</a></button>
                                        </div>
                                      </div>             
                                    </div>
                                  </div>
                                <br>
                            <?php   }
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <?php
                        $userID = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT c.cart_id as cid, c.product_id, p.product_id as pid, p.product_name, p.product_image, p.product_price 
                                  FROM carts c, products p WHERE c.product_id=p.product_id AND c.user_id ='$userID' ORDER BY c.cart_id DESC";
                        $query_run = mysqli_query($con, $query);

                        if(is_array($query_run) || is_object($query_run))
                        {
                          foreach($query_run as $item)
                          {
                            $total = $total + $item['product_price'];?>
                            <tbody>
                              <tr>
                                <td><?= $item['product_name']; ?></td>
                                <td>RM <?= $item['product_price']; ?></td>
                              </tr>
                            </tbody>
                    <?php }
                        }
                      ?>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <td>RM <?= number_format($total,2); ?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Credit Card</h4>
                  <div class="aa-payment-method">
                    <!--<select name="order_method">
                      <option selected> Select category </option>
                      <option value="Cash on Delivery">Cash on Delivery</option>
                      <option value="Debit Card">Debit Card</option>
                      <option value="Credit Card">Credit Card</option>
                    </select>-->
                    <input type="text" name="credit_num" placeholder="Credit Card Number" required>
                    <input type="text" name="credit_cvc" placeholder="CVC" required>
                    <!-- <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark"> -->  
                    <input type="submit" name="placeOrderBtn" value="Place Order" class="aa-browse-btn">
                    <!-- <button  type="submit" name="placeOrderBtn" class="aa-browse-btn">Place Order</button> -->         
                  </div>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- / Cart view section -->

  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
      <div class="container">
          <div class="row">
          <div class="col-md-12">
              <div class="aa-footer-top-area">
              <div class="row">
                  <div class="col-md-3 col-sm-6">
                  <div class="aa-footer-widget">
                      <h3>Main Menu</h3>
                      <ul class="aa-footer-nav">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="cart.php">My Cart</a></li>
                      <li><a href="checkout.php">Checkout</a></li>
                      <li><a href="contact.php">Contact Us</a></li>
                      </ul>
                  </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                  <div class="aa-footer-widget">
                      <div class="aa-footer-widget">
                      <h3>Contact Us</h3>
                      <address>
                          <p> Multimedia University, Melaka CampusJalan Ayer Keroh Lama, 75450 Melaka</p>
                          <p><span class="fa fa-phone"></span>013- 781 5280</p>
                          <p><span class="fa fa-envelope"></span>1201202218@student.mmu.edu.myModalLabel</p>
                      </address>
                      </div>
                  </div>
                  </div>
              </div>
              </div>
          </div>
          </div>
      </div>
      </div>
  <!-- / footer -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>  
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
    
    

    <!-- Product view slider -->
    <script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="js/jquery.simpleLens.js"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="js/slick.js"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="js/nouislider.js"></script>
    <!-- Custom js -->
    <script src="js/custom.js"></script> 
    
  </body>
</html>