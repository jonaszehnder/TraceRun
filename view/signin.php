<?php
session_start();
include "headerLoad.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
    <div class="div background-img">
        <div class="div container-login">
            <h2>Login</h2>
            <form action="../controller/CONsignin.php" method="POST">
                <label>Username</label>
                <input type="text" name="username">
                <?php
                if(@$_GET["error"]==1){
                    echo "<p class='error'>Enter your Username!</p>";
                }
                ?>
                <label>Password</label>
                <input type="password" name="password">
                <?php
                if(@$_GET["error"]==2){
                    echo "<p class='error'>Enter your Password!</p>";
                }
                ?>
                <input class="submit-btn" type="submit" value="Login">
                <?php
                if(@$_GET["error"]==3){
                    echo "<p class='error'>Username or Password wrong!</p>";
                }
                if(@$_GET["error"]==4){
                    echo "<p class='error'>Unknown Username!</p>";
                }
                if(@$_GET["success"]==1){
                    echo "<p class='success'>Successfully Loged in</p>";
                }
                if(@$_GET["warning"]==1){
                    echo "<p class='warning'>Login first!</p>";
                }
                
                ?>
                <p>Not registered yet?</p><a href="register.php">Signup now!</a>
            </form>
        </div>
    </div>
</body>
</html>