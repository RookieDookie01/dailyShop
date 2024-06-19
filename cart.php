<?php
  session_start();
  error_reporting(0);
  include("includes/connect.php");
  include("logincon.php");

  if(isset($_POST['scope']))
  {
    $scope = $_POST['scope'];
    switch ($scope)
    {
      case "delete":
          $cart_id = $_POST['cart_id'];
          $user_id = $_SESSION['auth_user']['user_id'];

          $q = "SELECT * FROM carts WHERE cart_id = '$cart_id' and user_id = '$user_id' ";
          $q_run = mysqli_query($con, $q);

          if(mysqli_num_rows($q_run) > 0)
          {
            $delete_q = "DELETE FROM carts WHERE cart_id = '$cart_id' ";
            $delete_q_run = mysqli_query($con, $delete_q);

            if($delete_q_run)
            {
              $_SESSION['message'] = "Item Deleted";
            }
          }
          break;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Cart Page</title>
    
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
   <!-- wpf loader Two 
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> -->
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
    <img src="img/bpwomen.png" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
        <div class="aa-catg-head-banner-content">
          <h2>Cart Page</h2>
          <ol class="breadcrumb">
            <li><a href="Index.php">Home</a></li>                   
            <li class="active">Cart</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <div class="table-responsive">
                <form action="cart.php" method="POST">
                  <table class='table'>
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
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
                                <td><a href='#'><img src='./img/product/<?= $item['product_image']; ?>' alt='img'></a></td>
                                <td><?= $item['product_name']; ?></a></td>
                                <td>RM <?= $item['product_price']; ?></td>
                                <td>
                                  <button class="btn btn-primary deleteCart" value="<?= $item['cid']; ?>">Remove</button>
                                </td>
                            </tr>
                          </tbody>
                  <?php }
                      }
                    ?>
                  </table>
                </form>
                

                </div>         
                  <!-- Cart Total view -->
                    <div class="cart-view-total">
                      <!--<h4>Cart Totals</h4>-->
                      <table class="aa-totals-table">
                        <tbody>
                          <tr>
                            <th>Total</th>
                            <td>RM <?= number_format($total,2); ?></td>
                          </tr>
                        </tbody>
                      </table>
                <a href="checkout.php" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
            </div>
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
  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.php">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>  
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
    <!-- To Slider JS -->
    <!-- Product view slider -->
    <script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="js/jquery.simpleLens.js"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="js/slick.js"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="js/nouislider.js"></script>
    <!-- Custom js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/customcart.js"></script>
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