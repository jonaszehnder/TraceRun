<?php
session_start();
include "../controller/CONtrackrun.php";
include "headerLoad.php";
if(empty($_SESSION["username"])){
    header("Location: ../view/signin.php?warning=1");
}
$enterValue = False;
if(!empty($_GET["run"])){
    $id_run = $_GET["run"];
    $enterValue = True;
    $arraySQLfromCon = GetRunUpdate();
    if($arraySQLfromCon[8] == "E"){
        $selectedType = 1;
    }elseif($arraySQLfromCon[8] == "I"){
        $selectedType = 2;
    }else{
        $selectedType = 3;
    }
}else{
    $selectedType = 4;
    $enterValue = False;
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
            <form  <?php if($enterValue){echo "action='../controller/CONtrackrunUpdate.php?run=$id_run'";}else{echo "action='../controller/CONtrackrunInsert.php'";} ?> method="POST">
                <div class="div-runningdate">
                    <img class="icon-small" src="picture/calendaricon_trackrun.svg">
                    <label for="runningdate">Running Date</label>
                    <input type="date" name="runningdate" <?php if($enterValue){echo "value=".$arraySQLfromCon[0]."";} ?>>
                </div>
                <div class="div-totaltime">
                    <img class="icon-small" src="picture/clockicon_trakrun.svg">
                    <label for="totaltime">Total Time</label>
                    <input type="time" name="totaltime" step="1" <?php if($enterValue){echo "value=".$arraySQLfromCon[1]."";}else{echo "value='00:00:00'";} ?>>
                </div>
                <div class="div-distance">
                    <img class="icon-small" src="picture/routeicon_trackrun.svg">
                    <label for="distance">Distance</label>
                    <input type="number" name="distance" step="0.01" placeholder="KM" <?php if($enterValue){echo "value=".$arraySQLfromCon[2]."";} ?>>
                </div>
                <div class="div-activecalories">
                    <img class="icon-small" src="picture/fireicon_trackrun.svg">
                    <label for="activecalories">Active Calories</label>
                    <input  type="number" name="activecalories" placeholder="KCAL" <?php if($enterValue){echo "value=".$arraySQLfromCon[3]."";} ?>>
                </div>
                <div class="div-avgheartrate">
                    <img class="icon-small" src="picture/heartbeaticon_trackrun.svg">
                    <label for="avgheartrate">Avg. Heart Rate</label>
                    <input type="number" name="avgheartrate" placeholder="BPM" <?php if($enterValue){echo "value=".$arraySQLfromCon[4]."";} ?>>
                </div>
                <div class="div-maxheartrate">
                    <img class="icon-small" src="picture/heartbrokenicon_trackrun.svg">
                    <label for="maxheartrate">Max. Heart Rate</label>
                    <input type="number" name="maxheartrate" placeholder="BPM" <?php if($enterValue){echo "value=".$arraySQLfromCon[5]."";} ?>>
                </div>
                <div class="div-cadence">
                    <img class="icon-small" src="picture/shoeprintsicon_trackrun.svg">
                    <label for="cadence">Cadence</label>
                    <input type="number" name="cadence" placeholder="SPM" <?php if($enterValue){echo "value=".$arraySQLfromCon[6]."";} ?>>
                </div>
                <div class="div-verticalmeters">
                    <img class="icon-small" src="picture/arrowsicon_trackrun.svg">
                    <label for="verticalmeters">Vertical Meters</label>
                    <input type="number" name="verticalmeters" placeholder="M" <?php if($enterValue){echo "value=".$arraySQLfromCon[7]."";} ?>>
                </div>
                <div class="div-comment">
                    <div class="div-comment-block">
                        <img class="icon-small" src="picture/commenticon_tarckrun.svg">
                        <label for="comment">Comment</label>
                    </div>
                        <select class="selcet-type" name="type">
                            <option value="E" <?php if($selectedType == 1){echo "selected";}?>>E</option>
                            <option value="I" <?php if($selectedType == 2){echo "selected";}?>>I</option>
                            <option value="P" <?php if($selectedType == 3){echo "selected";}?>>P</option>
                        </select>
                    <input class="imput-comment" type="text" name="comment" placeholder="Comment your Run" <?php if($enterValue){echo "value='".htmlspecialchars($arraySQLfromCon[9])."'";} ?>>
                </div>
                <input class="submit-btn" type="submit" name="submit" <?php if($enterValue){echo "value='Update Run'";}else{echo "value='Add Run'";} ?>>
                <?php
                if(@$_GET["error"]==1){
                    echo "<p class='error'>Fill out Mandatory Fields</p>";
                }
                ?>
            </form> 
        </div>
    </div>
</body>
</html>