<?php
    session_start();
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['user_role'] != 1)
        {
            $_SESSION['message'] = "You are not authorized to access this page";
            echo "<script>alert('You are not authorized to access this page')</script>"; 
            header('Location: index.php');
        }
    }
    else
    {
        $_SESSION['message'] = "Log in to continue";
        echo "<script>alert('Log in to continue')</script>"; 
        header('Location: login.php');
    }
?>