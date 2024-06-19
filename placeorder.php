<?php
    session_start();
    error_reporting(0);
    include("includes/connect.php");
    include("logincon.php");
    
    if(isset($_SESSION['auth']))
    {
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
                header('Location: myorder.php');
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
                        
                        $total_query = "SELECT c.cart_id as cid, c.product_id, p.product_id as pid, p.product_name, p.product_image, p.product_price 
                        FROM carts c, products p WHERE c.product_id=p.product_id AND c.user_id ='$userID' ORDER BY c.cart_id DESC";
                        $run_total_query = mysqli_query($con, $total_query);
                        
                        if(is_array($run_total_query) || is_object($run_total_query))
                        {
                            foreach($run_total_query as $item)
                            {
                                $order_total += $item['product_price'];
                            }
                        }
                        $insert_query = "INSERT INTO orders (order_tracking, user_id, order_name, order_email, order_phone, order_address, order_total, order_cnum, order_ccvc) 
                        VALUES ('$order_tracking', '$user_id', '$user_fullname', '$user_email', '$user_phone', '$user_address', '$order_total', '$credit_num', '$credit_cvc')";
                        $insert_query_run = mysqli_query($con, $insert_query);

                        header('Location: myorder.php');
                    }
                }
            }    
        }
    }
    else
    {
        header('Location: index.php');
    }
?>