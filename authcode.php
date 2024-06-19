<?php

session_start();
include("logincon.php");

if(isset($_POST['register_btn']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_fullname = mysqli_real_escape_string($con, $_POST['user_fullname']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $user_cpassword = mysqli_real_escape_string($con, $_POST['user_cpassword']);
    // $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    // $user_fullname = mysqli_real_escape_string($con, $_POST['user_fullname']);
    // $user_password = mysqli_real_escape_string($con, $_POST['user_password']);

    //check if username already registered
    $check_useremail_query = "SELECT user_email FROM users WHERE user_email = '$user_email' ";
    $check_useremail_query_run = mysqli_query($con, $check_useremail_query);

    if(mysqli_num_rows($check_useremail_query_run) > 0)
    {
        $_SESSION['message'] = "Email already registered";
        header('Location: signup.php');
    }
    else
    {
        if($user_password == $user_cpassword)
        {
            $insert_query = "INSERT INTO users (user_email, user_fullname, user_password) VALUES ('$user_email', '$user_fullname', '$user_password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Succesfully";
                header('Location: login.php');
            }
            else
            {
                $_SESSION['message'] = "Something went wrong";
                header('Location: signup.php');
            }
        }
        else
        {
            $_SESSION['message'] = "Password do not match";
            header('Location: signup.php');
        }
    }
    
}
elseif(isset($_POST['login_btn']))
{
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);

    $login_query = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run);
        $user_id = $userdata['user_id'];
        $user_email = $userdata['user_email'];
        $user_fullname = $userdata['user_fullname'];
        $user_role = $userdata['user_role'];
        $user_address = $userdata['user_address'];
        $user_phone = $userdata['user_phone'];

        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_email' => $user_email,
            'user_fullname' => $user_fullname,
            'user_address' => $user_address,
            'user_phone' => $user_phone
        ];

        $_SESSION['user_role'] = $user_role;

        if($user_role == 1)
        {
            $_SESSION['message'] = "Logged in succesfully";
            echo "<script>alert('Logged in succesfully')</script>"; 
            header('Location: adminhome.php');
        }
        else
        {
            $_SESSION['message'] = "Logged in succesfully";
            echo "<script>alert('Logged in succesfully')</script>"; 
            header('Location: index.php');
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid user";
        echo "<script>alert('Invalid user')</script>"; 
        header('Location: login.php');
    }
}