<?php
function GetRun() {
    include "../model/include.php";

    $makeHidden = False;

    /*SELECT aller Daten eines bestimmten "Run"*/
    $stmt = $mysql->prepare("SELECT running_date, total_time, distance, active_calories, avg_heart_rate, max_heart_rate, cadence, vertical_meters, type, comment FROM trackrun WHERE id=(?)");
    $stmt->bind_param("i", $_GET["run"]);	
    $stmt->execute();		
    $stmt->bind_result($runningdateSQL, $totaltimeSQL, $distance, $activecalories, $avgheartrate, $maxheartrate, $cadence, $vertiaclmeters, $type, $comment);

    $id_run = $_GET["run"];

    if($stmt->fetch()){	
        $runningdate = date("d.m.Y",strtotime($runningdateSQL));
        $totaltime = date("G:i:s", strtotime($totaltimeSQL));
        list($h, $m, $s) = explode(":", $totaltime);
        $m += $h * 60;
        $s += $m * 60;
        $space = $s/$distance;
        $mins = floor($space / 60 % 60);
        $secs = floor($space % 60);
        $avgpace  = sprintf('%02d:%02d', $mins, $secs);

        if(empty($comment)){
            $comment = "-";
        }

        echo "<table class='table-run'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Running Date</th>";
                    echo "<th>Total Time</th>";
                    echo "<th>Distance</th>";
                    echo "<th>Avg. Pace/ km</th>";
                    echo "<th>Active Calories</th>";
                    echo "<th>Avg. Heart Rate</th>";
                    echo "<th>Max. Heart Rate</th>";
                    echo "<th>Cadence</th>";
                    echo "<th>Vertical Meter</th>";
                    echo "<th>Type</th>";
                    echo "<th>Comment</th>";
                    echo "<th>Edit</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                echo "<tr>";
                    echo "<td data-label='Running Date'>$runningdate</td>";
                    echo "<td data-label='Total Time'>$totaltime</td>";
                    echo "<td data-label='Distance'>$distance KM</td>";
                    echo "<td data-label='Avg. Pace/ km'>$avgpace /KM</td>";
                    echo "<td data-label='Active Calories'>$activecalories KCAL</td>";
                    echo "<td data-label='Avg. Heart Rate'>$avgheartrate BPM</td>";
                    echo "<td data-label='Max. Heart Rate'>$maxheartrate BPM</td>";
                    echo "<td data-label='Cadence'>$cadence SPM</td>";
                    echo "<td data-label='Vertical Meter'>$vertiaclmeters M</td>";
                    echo "<td data-label='Type'>$type</td>";
                    echo "<td data-label='Comment'>$comment</td>";
                    echo "<td data-label='Edit'>";
                        echo "<form method='POST'>";
                            echo "<button class='btnEdit' name='btnEdit' value='$id_run'><img class='icon-run' src='../view/picture/editicon_run.svg'></button>";
                        echo "</form>";
                    echo "</td>";
                echo "</tr>";
            echo "</tbody>";
        echo "</table>";
    }	

    if(isset($_POST['btnEdit'])) {
        header("Location: ../view/trackrun.php?run=$id_run");

    }
    if(isset($_POST['btnAdd'])) {
        $makeHidden = TRUE;
        echo "<form action='../view/comparerun.php' class='input-run' method='POST'>";
            echo "<input type='hidden' name='runningdate' value=$runningdate>";
            echo "<input type='hidden' name='totaltime' value=$totaltime>";
            echo "<input type='hidden' name='distance' value=$distance>";
            echo "<input type='hidden' name='avgpace' value=$avgpace>";
            echo "<input type='hidden' name='activecalories' value=$activecalories>";
            echo "<input type='hidden' name='avgheartrate' value=$avgheartrate>";
            echo "<input type='hidden' name='maxheartrate' value=$maxheartrate>";
            echo "<input type='hidden' name='cadence' value=$cadence>";
            echo "<input type='hidden' name='vertiaclmeters' value=$vertiaclmeters>";
            echo "<input type='hidden' name='type' value=$type>";
            echo "<input type='hidden' name='comment' value='".$comment."'>";
            echo "<input type='hidden' name='id_run' value=$id_run>";
            echo "<input class='run-sbmit' type='text' name='search' placeholder='Username'>";
            echo "<input class='run-sbmit' type='date' name='searchStartDate'>";
            echo "<input class='run-sbmit' type='date' name='searchEndDate'>";
            echo "<input class='submit-btn run-sbmit' type='submit' name='Add-Run' value='Add'>";
        echo "</form>";
    }
    
    echo "<form method='POST'>";
    if(!$makeHidden){
        echo "<button class='btnAdd' name='btnAdd'><img class='icon-run add-run' src='picture/plusicon_run.svg'></button>";
    }
    echo "</form>";

    
    @$stmt->close();
    @$mysql->close();
}
?>