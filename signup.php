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
        <title>MMU OUTLET | Sign Up</title>
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
                        <header>Sign Up</header>
                    </div>
                    <div class="input-field">
                        <input type="email" class="input" placeholder="Email" required name="user_email" >
                        <i class='bx bx-user' ></i>
                    </div>
                    <div class="input-field">
                        <input type="text" class="input" placeholder="Full name" name="user_fullname" required>
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="input" placeholder="Password" name="user_password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                    <div class="input-field">
                        <input type="password" class="input" placeholder="Confirm Password" required name="user_cpassword" >
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="submit" value="Create Account" name="register_btn">
                    </div>
                    <div class="two-col">
                        <div class="two">
                            <label><a href="login.php">Already Have an Account</a></label>
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
        <script>
            var myInput = document.getElementById("psw");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");

            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
            }

            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
            }

            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
            }
            </script>
    </body>
</html>