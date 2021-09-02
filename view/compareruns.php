<?php
session_start();
include "../controller/CONcompareruns.php";
include "headerLoad.php";
$checkboxSearch = @array($_POST["totaltimecheck"], $_POST["distancecheck"], $_POST["avgpacecheck"], $_POST["activecaloriescheck"], $_POST["avgheartratecheck"], $_POST["maxheartratecheck"], $_POST["cadencecheck"], $_POST["vertiaclmeterscheck"], $_POST["typecheck"], $_POST["commentcheck"] );
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/scrollable.css">
    <link rel="stylesheet" href="css/charts.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
    <div class="background-img"></div>
        <div class="container-run">
            <div class="compare-user"><?php GetRunsUser($_SESSION["id"], @$_POST["search"], @$_POST["searchStartDate"], @$_POST["searchEndDate"], $checkboxSearch, $_POST["orderBySelect"]); ?></div>
        </div>
    </div>
</body>
</html>