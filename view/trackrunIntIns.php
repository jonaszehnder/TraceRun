<?php
session_start();
include "../controller/CONtrackrun.php";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
    <div class="background-img bgi-trackrun">
        <div class="div container-trackrun">
            <h2>Track your Run</h2>
            <form action="../controller/CONtrackrunIntIns.php" method="POST">
                <div class="div-trackrun-intervall">
                    <?php 
                        for($x = 1; $_POST["nbrOfInt"] >= $x; $x++){
                            echo "<h4>Interval $x</h4><div class='div-distance'>
                                <img class='icon-small' src='picture/routeicon_trackrun.svg'>
                                <label for='distance'>Distance</label>
                                <input type='number' name='distance$x' step='0.01' placeholder='KM'>
                            </div>
                            <div class='div-avgheartrate'>
                                <img class='icon-small'src='picture/heartbeaticon_trackrun.svg'>
                                <label for='avgheartrate'>Avg. Heart Rate</label>
                                <input type='number' name='avgheartrate$x'  placeholder='BPM'>
                            </div>
                            <div class='div-cadence'>
                                <img class='icon-small' src='picture/shoeprintsicon_trackrun.svg'>
                                <label for='cadence'>Cadence</label>
                                <input type='number' name='cadence$x' placeholder='SPM'>
                            </div>";
                        }
                    ?>
                <input type="hidden" name="active" value=<?php echo $_POST["active"]; ?>>
                <input type="hidden" name="pause" value=<?php echo $_POST["pause"]; ?>>
                <input type="hidden" name="nbrOfInt" value=<?php echo $_POST["nbrOfInt"]; ?>>
                <input type="hidden" name="idTrack" value=<?php echo $_POST["idTrack"]; ?>>
                <input class="submit-btn" type="submit" name="submit" value="Add Run">
                </div>
            </form>
        </div>
    </div>
</body>
</html>


