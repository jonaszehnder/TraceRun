<?php
session_start();
include "../controller/CONrun.php";
include "headerLoad.php";
if(empty($_SESSION["username"])){
    header("Location: ../view/signin.php?warning=1");
}
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
        <div class="background-img background-img-override"></div>
            <div class="div container-run container-run-override">
                <?=GetRun();    
                if(@$_GET["error"]==1){
                    echo "<p class='error run-notfound'>User not found!</p>";
                }
                ?>
            </div>
    </div>
</body>
</html>