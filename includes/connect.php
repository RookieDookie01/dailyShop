<?php

    $con=mysqli_connect('localhost','root','','dailyshop_db');

    if(!$con)
    {
        //echo "Connection succesful";
        echo "Connection failed";
    }
    else
    {
        //echo "Connection failed";
        //die(mysqli_error($con));
    }
?>