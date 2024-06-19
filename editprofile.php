<?php
    session_start();
    error_reporting(0);
    include("includes/connect.php");
    include("logincon.php");
    include("authcode.php");

    if(isset($_POST['editBtn']))
    {
        $current_user = $_SESSION['auth_user']['user_email'];
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];

        // // $sql = "SELECT * FROM users  WHERE user_email='$current_user'";
        // // $run_sql= mysqli_query($con, $sql);

        // // if($run_sql)
        // // {
        // //     if(mysqli_num_rows($run_sql))
        // //     {
        // //         while($row = mysqli_fetch_array($run_sql))
        // //         {
                    
        // //         }
        // //     }
        // // }
        $update_query = "UPDATE users SET user_address='$user_address', user_phone='$user_phone' WHERE user_email='$current_user'";
        $run_update_query = mysqli_query($con, $update_query);

        if($run_update_query)
        {
            $_SESSION['message'] = 'Profile Updated';
            header('Location: editprofile.php');
            exit(0);
        }
    }
    if(isset($_POST['resetBtn']))
    {
        $current_user = $_SESSION['auth_user']['user_email'];
        $cpassword = $_POST['cpassword'];
        $npassword = $_POST['npassword'];
        $cnpassword = $_POST['cnpassword'];

        $qry = "SELECT * FROM users WHERE user_email='$current_user'";
        $run_qry = mysqli_query($con, $qry);

        if(mysqli_num_rows($run_qry) > 0)
        {
            foreach($run_qry as $qq)
            {
                if($cpassword == $qq['user_password'])
                {
                    if($npassword == $cnpassword)
                    {
                        $reset_query = "UPDATE users SET user_password='$npassword' WHERE user_email='$current_user'";
                        $run_reset_query = mysqli_query($con, $reset_query);

                        if($run_reset_query)
                        {
                            $_SESSION['message'] = 'Password Has Been Changed';
                            header('Location: editprofile.php');
                            exit(0);
                        }
                    }
                    else
                    {
                        $_SESSION['message'] = 'Password Not Match';
                        header('Location: editprofile.php');
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['message'] = "Wrong Password";
                    header('Location: editprofile.php');
                    exit(0);
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
        <title>Daily Shop | Contact</title>
        <!-- Alertify JS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
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
                    <li><a href="womentrousers.php">Trousers</a></li>              
                    <li><a href="womenformal.php">Formal</a></li>
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
    <img src="img/bpmen.png" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
            <h2>Edit Profile</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>         
                <li class="active">Edit Profile</li>
            </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->
<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="aa-myaccount-area">         
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-myaccount-login">
                            <?php
                                    $user_email = $_SESSION['auth_user']['user_email'];
                                    $users = "SELECT * FROM users WHERE user_email ='$user_email'";
                                    $users_run = mysqli_query($con, $users);

                                    if(mysqli_num_rows($users_run) > 0)
                                    {
                                        foreach($users_run as $user)
                                        {?>
                                            
                                
                                        <form action="editprofile.php" method="POST" class="aa-login-form">
                                            <p>Email : <?php
                                                            if(isset($_SESSION['auth']))
                                                            {?>
                                                                <?= $user['user_email']; ?>
                                                    <?php   } ?> </p>
                                            <p>Name : <?php
                                                            if(isset($_SESSION['auth']))
                                                            {?>
                                                                <?= $user['user_fullname']; ?>
                                                    <?php   } ?> </p>
                                            <h4>Add or Edit Profile</h4>
                                            <input type="text" name="user_address" placeholder="Current Address : <?= $user['user_address']; ?>" required>
                                            <input type="text" name="user_phone" placeholder="Current Phone Number : <?= $user['user_phone']; ?>" required pattern="^(01)[0-46-9]-*[0-9]{7,8}$" title="Invalid phone number">
                                            <input type="submit" name="editBtn" class="aa-browse-btn" value="Update Profile">
                                            <br>
                                        </form>
                                        <form action="editprofile.php" method="POST" class="aa-login-form">
                                            <h4>Change Password</h4>
                                            <input type="password" name=cpassword placeholder="Current Password" required>
                                            <input type="password"  name=npassword placeholder="New Password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            <input type="password" name=cnpassword placeholder="Confirm New Password" required>
                                            <input type="submit" name="resetBtn" class="aa-browse-btn" value="Reset Password">
                                        </form>
                                        <?php   }
                                    }
                                    else
                                    {?>
                                        <h4>No Record Found</h4>
                            <?php   }?>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->

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


    <script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    }
    </script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- ALERTIFY JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>
            alertify.set('notifier','position', 'top-right');
            <?php if(isset($_SESSION['message']))
            {?>
                alertify.success('<?= $_SESSION['message'] ?>');
    <?php   
            unset($_SESSION['message']);
            } ?>
        </script>
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
</body>
</html>