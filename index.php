<?php
    session_start();
    error_reporting(0);
    include("logincon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>MMU OUTLET | Home</title>
    
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
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
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
<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    <!-- single slide item -->
                    <li>
                    <div class="seq-model">
                        <img data-seq src="img/menbanner.png" alt="Men slide img" />
                    </div>
                    <div class="seq-title">             
                        <h2 data-seq>Men Collection</h2>
                        <a data-seq href="mencasual.php" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                    </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                    <div class="seq-model">
                        <img data-seq src="img/womenbanner.png" alt="Wristwatch slide img" />
                    </div>
                    <div class="seq-title">              
                        <h2 data-seq>Women Collection</h2>
                        <a data-seq href="womencasual.php" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                    </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                    <div class="seq-model">
                        <img data-seq src="img/kidsbanner.png" alt="Women Jeans slide img" />
                    </div>
                        <div class="seq-title">              
                            <h2 data-seq>Kids Collection</h2>
                            <a data-seq href="kidcasual.php" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>                 
                </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
        </div>
    </div>
</section>
<!-- / slider -->
<!-- Support section -->
<section id="aa-support">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>Free Shipping</h4>
                <P>Free shipping to all states in Malaysia Including Sabah and Sarawak</P>
            </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>Save Time & Efficiency</h4>
                <P>Saves time consumption and easy to make any purchase</P>
            </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>Contact 24/7</h4>
                <P>If there are any difficulties, just contact us anytime</P>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!-- / Support section -->

<footer id="aa-footer">
    <!-- footer bottom -->
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
                        <p><span class="fa fa-envelope"></span>1201202218@student.mmu.edu.my</p>
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
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            </div>
        </div>
        </div>
        </div>
    </div>
    </footer>
<!-- / footer -->

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