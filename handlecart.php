<?php
    session_start();
    error_reporting(0);
    include("logincon.php");
    
    if(isset($_SESSION['auth']))
    {
        if(isset($_GET['t']))
    {
        $product_id = $_GET['t'];
        $user_id = $_SESSION['auth_user']['user_id'];

        $insert_query = "INSERT INTO carts (user_id, product_id) VALUES ('$user_id', '$product_id')";
        $insert_query_run = mysqli_query($con, $insert_query);
        if($insert_query_run)
        {
            echo $_SESSION['message'] = "Item Added To Cart";
        }
    }
    }
    else
    {
        echo 401;
    }
?>
<script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
<script src="js/customproduct.js"></script>