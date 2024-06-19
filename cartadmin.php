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
                <h1 class="tm-site-title mb-0">USER CART</h1>
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
                    <a class="nav-link d-block" href="index.php">
                        Admin, <b>Logout</b>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="container">
            
        <?php
                                    $order_tracking = $_GET['t'];
                                    $order_query = "SELECT o.order_id as oid, o.order_name, o.order_phone, o.order_address, o.order_total, o.order_tracking, o.user_id, oi.*, p.* FROM orders o, order_items oi, products p
                                                    WHERE oi.order_id = o.order_id AND p.product_id = oi.product_id AND o.order_tracking = '$order_tracking' ";
                                    $order_query_run = mysqli_query($con, $order_query);
                                    $data = mysqli_fetch_array($order_query_run);
                                    if(mysqli_num_rows($order_query_run) > 0)
                                    {?>
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5"><b>Cart details:</b></p>
                    <p class="text-white mt-2 mb-2"><b>Name :</b>  <?= $data['order_name']; ?></p>
                    <p class="text-white mt-2 mb-2"><b>Tracking Number :</b>  <?= $data['order_tracking']; ?></p>
                    <p class="text-white mt-2 mb-2"><b>Address :</b>  <?= $data['order_address']; ?></p>
                    <p class="text-white mt-2 mb-2"><b>Phone :</b>  <?= $data['order_phone']; ?></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                            </tr>
                                        </thead><?php
                                        foreach($order_query_run as $item)
                                        {?>
                                            <tbody>
                                                <tr>
                                                <td><a href='#'><img src='./img/product/<?= $item['product_image']; ?>' alt='img'></a></td>
                                                <td><?= $item['product_name']; ?></a></td>
                                                <td>RM <?= $item['product_price']; ?></td>
                                                </tr>
                                            </tbody>
                                <?php   }
                                    }
                                    else
                                    {
                                        echo "Error";
                                    }
                                ?>
                        <tfoot>
                            <tr>
                            <th>Total</th>
                            <td>RM <?= $item['order_total']; ?></td>
                            </tr>
                        </tfoot>
                        </table>
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