<?php
    session_start();

    include("logincon.php");
?>

<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="boxicons-master/css/boxicons.css">
        <title>MMU OUTLET | Login</title>
        <link href="CSS/login.css" rel="stylesheet">
        <!-- Alertify JS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    </head>
    <body>
        <div class="box">
            <form action="authcode.php" method="POST">
                <div class="container">
                    <div class="top">
                        <header>Login</header>
                    </div>
                    <div class="input-field">
                        <input type="email" class="input" placeholder="Email" required name="user_email" >
                        <i class='bx bx-user' ></i>
                    </div>
                    <div class="input-field">
                    <input type="password" class="input" placeholder="Password" required name="user_password" >
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="submit" value="Login" name="login_btn">
                    </div>
                    <div class="two-col">
                        <div class="two">
                            <label><a href="signup.php">Create New Account</a></label>
                            <br>
                            <label><a href="index.php">Back to Main Page</a></label>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
        <!-- ALERTIFY JS -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>
            <?php if(isset($_SESSION['message']))
            {?>
                alertify.set('notifier','position', 'top-right');
                alertify.success('<?= $_SESSION['message'] ?>');
    <?php   
            unset($_SESSION['message']);
            } ?>
        </script>
    </body>
</html>