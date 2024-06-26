<?php
    session_start();
    error_reporting(0);
    include("includes/connect.php");
    include("logincon.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | MMUOUTLET</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
    <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
            <a class="navbar-brand" href="index.php">
                <h1 class="tm-site-title mb-0">Product Admin</h1>
            </a>
            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars tm-nav-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class="fas fa-shopping-cart"></i>
                            Products
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link d-block" href="logout.php">
                        Admin, <b>Logout</b>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Customers List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Adress</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $users = "SELECT * FROM users WHERE user_role = 0";
                                    $users_run = mysqli_query($con, $users);

                                    if(mysqli_num_rows($users_run) > 0)
                                    {
                                        foreach($users_run as $user)
                                        {?>
                                            <tr>
                                                <th><?= $user['user_email']; ?></th>
                                                <td><b><?= $user['user_fullname']; ?></b></td>
                                                <td><?= $user['user_phone']; ?></td>
                                                <td><?= $user['user_address']; ?></td>
                                            </tr>
                                        <?php   }
                                    }
                                    else
                                    {?>
                                        <h4>No Record Found</h4>
                            <?php   }?>
                            </tbody>
                        </table>
                        <br>
                        <h2 class="tm-block-title">Order List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Tracking Code</th>
                                    <th scope='col'>Total Payment</th>
                                    <th scope='col'>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $users = "SELECT * FROM orders";
                                    $users_run = mysqli_query($con, $users);

                                    if(mysqli_num_rows($users_run) > 0)
                                    {
                                        foreach($users_run as $user)
                                        {?>
                                            <tr>
                                                <td><b><?= $user['order_name']; ?></b></td>
                                                <td><?= $user['order_phone']; ?></td>
                                                <td><?= $user['order_tracking']; ?></td>
                                                <td>RM <?= $user['order_total']; ?></td>
                                                <td><a class="btn btn-primary" href="cartadmin.php?t=<?= $user['order_tracking']; ?>">View Cart</a></td>
                                            </tr>
                                        <?php   }
                                    }
                                    else
                                    {?>
                                        <h4>No Record Found</h4>
                            <?php   }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                    Copyright &copy; <b>2018</b> All rights reserved. 
                    
                    Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
                </p>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function () {
                updateLineChart();
                updateBarChart();                
            });
        })
    </script>
</body>

</html>