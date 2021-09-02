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
    <div class="background-img">
        <div class="div container-login">
            <h2>Registration</h2>
            <form action="../controller/CONregister.php" method="POST">
                <label>E-Mail</label>
                <input type="email" name="email">
                <?php
                if(@$_GET["error"]==1){
                    echo "<p class='error'>Enter a E-Mail</p>";
                }elseif(@$_GET["error"]==2){
                    echo "<p class='error'>E-Mail already taken</p>";
                }
                if(@$_GET["error"]==3){
                    echo "<p class='error'>E-Mail not valid</p>";
                }
                ?>
                <label>Username</label>
                <input type="text" name="username">
                <?php
                if(@$_GET["error"]==4){
                    echo "<p class='error'>Username already taken</p>";
                }
                if(@$_GET["error"]==5){
                    echo "<p class='error'>Enter a Username!</p>";
                }
                if(@$_GET["error"]==7){
                    echo "<p class='error'>Username to Long!</p>";
                }
                ?>
                <label>Password</label>
                <input type="password" name="password">
                <?php
                if(@$_GET["error"]==6){
                    echo "<p class='error'>Enter a Password!</p>";
                }
                if(@$_GET["error"]==8){
                    echo "<p class='error'>Password to Long!</p>";
                }
                ?>
                <input class="submit-btn" type="submit" value="Create Account">
                <?php
                if(@$_GET["success"]==1){
                    echo "<p class='success'>Successfully Registrated</p>";
                }
                ?>
            </form>
        </div>
    </div> 
</body>
</html>