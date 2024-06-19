<?php
include("logincon.php");
include("includes/connect.php");
function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];

        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) > 0)
        {
            $userdata = mysqli_fetch_assoc($result);
            return $userdata;
        }
    }
    //redirect to login
    header("location: login.php");
    die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length=5;
    }

    $len = rand(4,$length);

    for($i=0; $i<$len; $i++)
    {
        $text .=rand(0,9);
    }
    return $text;
}

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table";// WHERE status = '0' 
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE $id = '$id' LIMIT 1";// WHERE status = '0' 
    return $query_run = mysqli_query($con, $query);
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE '$id' = '$id' ";
    return $query_run = mysqli_query($con, $query);
}


