<?php
session_start();
include "../controller/CONindex.php";
include "headerLoad.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/charts.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
    <div class="background-img"></div>
        <div class='div-home-welcome'>
        <h3>Welcome to TraceRun :D</h3>
        <?php 
        if(@$_SESSION['username']){
            $lastRun = GetLastRun($_SESSION['id']);
            $timeEasyZones = GetRunStatsMethods($_SESSION['id'])[0];
            $timeEasyZonesCalc = GetRunStatsMethods($_SESSION['id'])[1];
            $timeEasyZonesPerc = GetRunStatsMethods($_SESSION['id'])[2];
            $timeHardZones = GetRunStatsMethods($_SESSION['id'])[3];
            $timeHardZonesCalc = GetRunStatsMethods($_SESSION['id'])[4];
            $timeHardZonesPerc = GetRunStatsMethods($_SESSION['id'])[5];

            echo "<p class='p-margin'>Your last Run was: $lastRun</p>";
            echo "<p class='p-margin'>Running Distribution last 7 days</p>";

            echo "<table class='charts-css column show-heading show-labels show-primary-axis data-spacing-10' id='chart'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Zone</th>";
                        echo "<th>Time</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    echo "<tr>";
                        echo "<th>E</th>";
                        if($timeEasyZonesCalc == 0){
                            echo "<td style='--size: calc($timeEasyZonesCalc / 100); --color:rgba(100,210,80,0.75);'></td>";
                        }else{
                            echo "<td style='--size: calc($timeEasyZonesCalc / 100); --color:rgba(100,210,80,0.75);'>$timeEasyZones, $timeEasyZonesPerc%</td>";
                        }
                    echo "</tr>";
                    echo "<tr>";
                        echo "<th>I/P</th>";
                        if($timeHardZonesCalc == 0){
                            echo "<td style='--size: calc($timeHardZonesCalc / 100); --color:rgba(240,50,50,0.75);'></td>";
                        }else{
                            echo "<td style='--size: calc($timeHardZonesCalc / 100); --color:rgba(240,50,50,0.75);'>$timeHardZones, $timeHardZonesPerc%</td>";
                        }
                        echo "</tr>";
                echo "</tbody>";
            echo "</table>";
        } else {
                echo "<h4>Track your Runs and Compare them!</h4>";
                echo "<ol>";
                    echo "<li>Create an Acccount</li>";
                    echo "<li>Track your Runs</li>";
                    echo "<li>See your Progress</li>";
                    echo "<li>Compare your Runs with Others</li>";
                echo "</ol>";
        }
        ?>
        
    
        </div>
    </div>
</body>
</html>