<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbusername = "dailyshop_db";

    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbusername))
    {
        die("Failed to connect!");
    }