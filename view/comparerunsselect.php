<?php
session_start();
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
    <div class="background-img bgi-comparerunsselcet"></div>
        <div class="div container-compareruns-select">
            <h2>Compare Runs</h2>
            <form action="compareruns.php" method="POST">
                <p class="comparerunsselcet-p">Search User</p>
                <input class='run-sbmit' type='text' name='search' placeholder='Username'>
                <p class="comparerunsselcet-p">From</p>
                <input class='run-sbmit' type='date' name='searchStartDate'>
                <p class="comparerunsselcet-p">To</p>
                <input class='run-sbmit' type='date' name='searchEndDate'>
                <div class="comparerunsselcet-scale">
                    <p>Only Show</p>
                    <div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='totaltimecheck' name='totaltimecheck' checked>
                            <label for="totaltimecheck">Total Time</label>
                        </div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='distancecheck' name='distancecheck' checked>
                            <label for="distancecheck">Distance</label>
                        </div>
                    </div>
                    <div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='avgpacecheck' name='avgpacecheck' checked>
                            <label for="avgpacecheck">Avg. Pace</label>
                        </div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='activecaloriescheck' name='activecaloriescheck' checked>
                            <label for="activecaloriescheck">Calories</label>
                        </div>
                    </div>
                    <div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='avgheartratecheck' name='avgheartratecheck' checked>
                            <label for="avgheartratecheck">Avg. HR</label>
                        </div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='maxheartratecheck' name='maxheartratecheck' checked>
                            <label for="maxheartratecheck">Max. HR</label>
                        </div>
                    </div>
                    <div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='cadencecheck' name='cadencecheck' checked>
                            <label for="cadencecheck">Cadence</label>
                        </div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='vertiaclmeterscheck' name='vertiaclmeterscheck' checked>
                            <label for="vertiaclmeterscheck">Vertical Meter</label>
                        </div>
                    </div>
                    <div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='typecheck' name='typecheck' checked>
                            <label for="typecheck">Type</label>
                        </div>
                        <div class="comparerunselect-check">
                            <input class='compare-check' type='checkbox' id='commentcheck' name='commentcheck' checked>
                            <label for="commentcheck">Comment</label>
                        </div>
                    </div>
                    <div>
                        <div class="selcet-type-comparerunsselect">
                            <p>Order By</p>
                            <select name="orderBySelect">
                                <option value="" selected>Username</option>
                                <option value="total_time">Total Time</option>
                                <option value="distance">Distance</option>
                                <option value="active_calories">Active Calories</option>
                                <option value="avg_heart_rate">Avg. Heart Rate</option>
                                <option value="max_heart_rate">Max. Heart Rate</option>
                                <option value="cadence">Cadence</option>
                                <option value="vertical_meters">Vertical Meter</option>
                                <option value="type">Type</option>
                                <option value="comment">Comment</option>
                            </select>
                        </div>    
                    </div>
                </div>
                <?php  
                    if(@$_GET["error"]==1){
                        echo "<p class='error run-notfound'>User not found!</p>";
                    }
                ?>
                <input class='submit-btn run-sbmit' type='submit' name='compare-run' value='Compare'>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
