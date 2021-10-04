<?php
session_start();
include "../controller/CONruns.php";
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
    <link rel="stylesheet" href="css/scrollable.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
        <div class="background-img"></div>
            <div class='div container-runs'>
                <?=GetTrackRuns();?>
            </div>
        </div>
    </div>
</body>
</html>