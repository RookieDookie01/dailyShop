<?php
  session_start();
  include("logincon.php");
  
  if(isset($_POST['placeOrderBtn']))
  {
    //$current_user = $_SESSION['auth_user']['user_email'];
    $credit_num = mysqli_real_escape_string($con, $_POST['credit_num']);
    $credit_name = mysqli_real_escape_string($con, $_POST['credit_name']);
    $credit_month = mysqli_real_escape_string($con, $_POST['credit_month']);
    $credit_year = mysqli_real_escape_string($con, $_POST['credit_year']);
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
                $order_tracking = "mmuOutlet".rand(1111,9999).substr($user_phone,2);
                
                $total_query = "SELECT * FROM carts c, products p  WHERE c.product_id=p.product_id AND c.user_id ='$user_id'";
                $run_total_query = mysqli_query($con, $total_query);
                
                $query = "SELECT c.cart_id as cid, c.product_id, p.product_id as pid, p.product_name, p.product_image, p.product_price 
                          FROM carts c, products p WHERE c.product_id=p.product_id AND c.user_id ='$user_id' ORDER BY c.cart_id DESC";
                $query_run = mysqli_query($con, $query);

                if(is_array($query_run) || is_object($query_run))
                {
                  foreach($query_run as $item)
                  {
                    $total = 0;
                    $total = $total + $item['product_price'];
                  }
                }
                $insert_query = "INSERT INTO orders (order_tracking, user_id, order_name, order_email, order_phone, order_address, order_total, order_cnum, order_ccvc) 
                VALUES ('$order_tracking', '$user_id', '$user_fullname', '$user_email', '$user_phone', '$user_address', '$total', '$credit_num', '$credit_cvc')";
                $insert_query_run = mysqli_query($con, $insert_query);
                
                if($insert_query_run)
                {
                  $order_id = mysqli_insert_id($con);
                  foreach($query_run as $citem)
                  {
                    $product_id = $citem['product_id'];
                    $product_price = $citem['product_price'];
                    $insert_item_query = " INSERT INTO order_items (order_id, product_id, price) VALUES ($order_id, $product_id, $product_price) ";
                    $insert_item_query_run = mysqli_query($con, $insert_item_query);
                  }
                }
                header('Location: myorder.php');
            }
        }
    }
    else
    {
      $_SESSION['message'] = "Incorrect Payment Details";
      header('Location: index.php');
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
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

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
                                    <form action="checkout.php" method="">
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="aa-checkout-single-bill">
                                            <p>Email: <?php
                                                  if(isset($_SESSION['auth']))
                                                  {?>
                                                      <?= $user['user_email']; ?>
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
                                                        <?= $user['user_fullname']; ?>
                                            <?php   } ?> </p>
                                          </div>                             
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="aa-checkout-single-bill">
                                            <p>Address: <?= $user['user_address']; ?> </p>
                                            
                                          </div>                             
                                          </div>
                                          <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                              <p>Phone Number: <?= $user['user_phone']; ?> </p>
                                            </div>
                                          </div>
                                        <button><a href="editprofile.php">Change Shipping Detail</a></button>
                                        </div>
                                      </div>             
                                    </div>
                                    </form>
                                    
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
                            $total = 0;
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
                    <div id="card-success" class="hidden">
                      <i class="fa fa-check"></i>
                      <p>Payment Successful!</p>
                    </div>
                    <div id="form-errors" class="hidden">
                      <i class="fa fa-exclamation-triangle"></i>
                      <p id="card-error">Card error</p>
                    </div>
                    <div id="form-container">

                      <div id="card-front">
                        <div id="shadow"></div>
                        <div id="image-container">
                          <span id="amount"><strong>Kindly enter your Credit Card details</strong></span>
                          <span id="card-image"></span>
                        </div>
                        <!--- end card image container --->

                        <label for="card-number">Card Number</label>
                        <input type="text" name="credit_num" id="card-number" placeholder="1234 5678 9101 1112" length="16">
                        <div id="cardholder-container">
                          <label for="card-holder">Card Holder</label>
                          <input type="text" name="credit_name" id="card-holder" placeholder="e.g. Abu Debu" />
                        </div>
                        <!--- end card holder container --->
                        <div id="exp-container">
                          <label for="card-exp">Expiration</label>
                          <input id="card-month" name="credit_month" type="text" placeholder="MM" length="2">
                          <input id="card-year" name="credit_year" type="text" placeholder="YY" length="2">
                        </div>
                            <div id="cvc-container">
                          <label for="card-cvc"> CVC/CVV</label>
                          <input id="card-cvc" name="credit_cvc" placeholder="XXX" type="text">
                        </div>
                        <!--- end CVC container --->
                        <!--- end exp container --->
                      </div>
                      <!--- end card front --->
                      <div id="card-back">
                        <div id="card-stripe">
                        </div>

                      </div>
                      <!--- end card back --->
                      <!-- <input type="text" id="card-token" /> -->
                      <input type="submit" name="placeOrderBtn" id="card-btn" value="Place Order">
                    </div>  
                    <!-- <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark"> -->  
                    <!--<input type="submit" name="placeOrderBtn" value="Place Order" class="aa-browse-btn">-->         
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
  <style>
                        #amount {
                          font-size: 12px;
                        }

                        #amount strong {
                          font-size: 14px;
                        }

                        #card-back {
                          top: 40px;
                          right: 0;
                          z-index: -2;
                        }

                        #card-btn {
                          background-color: rgba(255, 0, 0, .5);
                          color: #ffb242;
                          position: absolute;
                          bottom: -55px;
                          right: 0;
                          width: 150px;
                          border-radius: 8px;
                          height: 42px;
                          font-size: 12px;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          text-transform: uppercase;
                          letter-spacing: 1px;
                          font-weight: 400;
                          outline: none;
                          border: none;
                          cursor: pointer;
                        }

                        #card-btn:hover {
                          background-color: rgba(251, 251, 251, 1);
                        }

                        #card-cvc {
                          width: 60px;
                          margin-bottom: 0;
                        }

                        #card-front,
                        #card-back {
                          position: absolute;
                          background-color: #498ee4;
                          width: 390px;
                          height: 250px;
                          border-radius: 6px;
                          padding: 20px 30px 0;
                          box-sizing: border-box;
                          font-size: 10px;
                          letter-spacing: 1px;
                          font-weight: 300;
                          color: white;
                        }

                        #card-image {
                          float: right;
                          height: 100%;
                        }

                        #card-image i {
                          font-size: 40px;
                        }

                        #card-month {
                          width: 45% !important;
                        }

                        #card-number,
                        #card-holder {
                          width: 100%;
                        }

                        #card-stripe {
                          width: 100%;
                          height: 55px;
                          background-color: #3d5266;
                          position: absolute;
                          right: 0;
                        }

                        #card-success {
                          color: #00b349;
                        }

                        #card-token {
                          display: none;
                        }

                        #card-year {
                          width: 45%;
                          float: right;
                        }

                        #cardholder-container {
                          width: 60%;
                          display: inline-block;
                        }

                        #cvc-container {
                          position: absolute;
                          width: 110px;
                          right: -115px;
                          bottom: -10px;
                          padding-left: 20px;
                          box-sizing: border-box;
                        }

                        #cvc-container label {
                          width: 100%;
                        }

                        #cvc-container p {
                          font-size: 6px;
                          text-transform: uppercase;
                          opacity: 0.6;
                          letter-spacing: .5px;
                        }

                        #form-container {
                          margin: auto;
                          width: 500px;
                          height: 290px;
                          position: relative;
                        }

                        #form-errors {
                          color: #eb0000;
                        }

                        #form-errors,
                        #card-success {
                          background-color: white;
                          width: 500px;
                          margin: 0 auto 10px;
                          height: 50px;
                          border-radius: 8px;
                          padding: 0 20px;
                          font-weight: 400;
                          box-sizing: border-box;
                          line-height: 46px;
                          letter-spacing: .5px;
                          text-transform: none;
                        }

                        #form-errors p,
                        #card-success p {
                          margin: 0 5px;
                          display: inline-block;
                        }

                        #exp-container {
                          margin-left: 10px;
                          width: 32%;
                          display: inline-block;
                          float: right;
                        }

                        .hidden {
                          display: none;
                        }

                        #image-container {
                          width: 100%;
                          position: relative;
                          height: 55px;
                          margin-bottom: 5px;
                          line-height: 55px;
                        }

                        #image-container img {
                          position: absolute;
                          right: 0;
                          top: 0;
                        }

                        input {
                          border: none;
                          outline: none;
                          background-color: #5a9def;
                          height: 30px;
                          line-height: 30px;
                          padding: 0 10px;
                          margin: 0 0 25px;
                          color: white;
                          font-size: 10px;
                          box-sizing: border-box;
                          border-radius: 4px;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          letter-spacing: .7px;
                        }

                        input::-webkit-input-placeholder {
                          color: #fff;
                          opacity: 0.7;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          letter-spacing: 1px;
                          font-weight: 300;
                          letter-spacing: 1px;
                          font-size: 10px;
                        }

                        input:-moz-placeholder {
                          color: #fff;
                          opacity: 0.7;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          letter-spacing: 1px;
                          font-weight: 300;
                          letter-spacing: 1px;
                          font-size: 10px;
                        }

                        input::-moz-placeholder {
                          color: #fff;
                          opacity: 0.7;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          letter-spacing: 1px;
                          font-weight: 300;
                          letter-spacing: 1px;
                          font-size: 10px;
                        }

                        input:-ms-input-placeholder {
                          color: #fff;
                          opacity: 0.7;
                          font-family: lato, 'helvetica-light', 'sans-serif';
                          letter-spacing: 1px;
                          font-weight: 300;
                          letter-spacing: 1px;
                          font-size: 10px;
                        }

                        input.invalid {
                          border: solid 2px #eb0000;
                          height: 34px;
                        }

                        label {
                          display: block;
                          margin: 0 auto 7px;
                        }

                        #shadow {
                          position: absolute;
                          right: 0;
                          width: 284px;
                          height: 214px;
                          top: 36px;
                          background-color: #000;
                          z-index: -1;
                          border-radius: 8px;
                          box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
                          -moz-box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
                          -webkit-box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
                        }
                      </style>
  
    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>  
<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="js/jquery.smartmenus.js"></script>
<!-- SmartMenus jQuery Bootstrap Addon -->
<script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  

<!-- To Slider JS -->
<script src="js/sequence.js"></script>
<script src="js/sequence-theme.modern-slide-in.js"></script>  

<!-- Product view slider -->
<script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="js/jquery.simpleLens.js"></script>
<!-- slick slider -->
<script type="text/javascript" src="js/slick.js"></script>
<!-- Price picker slider -->
<script type="text/javascript" src="js/nouislider.js"></script>
<!-- Custom js -->
<script src="js/custom.js"></script> 
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
  </body>
</html>