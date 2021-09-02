<?php
function GetRunCompare(){
    include "../model/include.php";

    $stmt = $mysql->prepare("SELECT id FROM user WHERE username=(?)");
    $stmt->bind_param("s", $_POST['search']);
    $stmt->execute();
    $stmt->bind_result($id_userSearch);

    if($stmt->fetch()){	
        
        $id_userSearch;
    }else{
        header("Location: run.php?run=".$_POST['id_run']."&error=1");
        exit(0);
    }

    $stmt->close();

    echo "<table class='table-run'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>User</th>";
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
                echo "<th class='comment'>Comment</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr>";
            echo "<td data-label='User'>".$_SESSION["username"]."</td>";
            echo "<td data-label='Running Date'>".$_POST['runningdate']."</td>";
            echo "<td data-label='Total Time'>".$_POST['totaltime']."</td>";
            echo "<td data-label='Distance'>".$_POST['distance']." KM</td>";
            echo "<td data-label='Avg. Pace/ km'>".$_POST['avgpace']." /KM</td>";
            echo "<td data-label='Active Calories'>".$_POST['activecalories']." KCAL</td>";
            echo "<td data-label='Avg. Heart Rate'>".$_POST['avgheartrate']." BPM</td>";
            echo "<td data-label='Max. Heart Rate'>".$_POST['maxheartrate']." BPM</td>";
            echo "<td data-label='Cadence'>".$_POST['cadence']." SPM</td>";
            echo "<td data-label='Vertical Meter'>".$_POST['vertiaclmeters']." M</td>";
            echo "<td data-label='Type'>".$_POST['type']."</td>";
            echo "<td class='comment' data-label='Comment'>".$_POST['comment']."</td>";
        echo "</tr>";



        /*Datum wird für die DB richtig formatiert*/
        if(empty($_POST["searchStartDate"])){
            $searchStartDateSQL = date("Y-m-d");
        }else{
            $searchStartDateSQL = date("Y-m-d",strtotime($_POST["searchStartDate"]));
        }
        if(empty($_POST["searchEndDate"])){
            $searchEndDateSQL = date("Y-m-d");
        }else{
            $searchEndDateSQL = date("Y-m-d", strtotime($_POST["searchEndDate"]));
        }
        $stmt = $mysql->prepare("SELECT running_date, total_time, distance, active_calories, avg_heart_rate, max_heart_rate, cadence, vertical_meters, type, comment FROM trackrun WHERE fk_user=(?) AND (running_date BETWEEN (?) AND (?))");
        $stmt->bind_param("iss", $id_userSearch,$searchStartDateSQL,$searchEndDateSQL);
        $stmt->execute();		
        $stmt->bind_result($runningdateSQL_u, $totaltimeSQL_u, $distance_u, $activecalories_u, $avgheartrate_u, $maxheartrate_u, $cadence_u, $vertiaclmeters_u, $type_u, $comment_u);
    
        while($stmt->fetch()){	
            $runningdate_u = date("d.m.Y",strtotime($runningdateSQL_u));
            $totaltime_u = date("G:i:s", strtotime($totaltimeSQL_u));
            list($h, $m, $s) = explode(":", $totaltime_u);
            $m += $h * 60;
            $s += $m * 60;
            $space = $s/$distance_u;
            $mins = floor($space / 60 % 60);
            $secs = floor($space % 60);
            $avgpace_u  = sprintf('%02d:%02d', $mins, $secs);

            if(empty($comment_u)){
                $comment_u = "-";
            }
    
                    echo "<tr>";
                        echo "<td data-label='User'>".$_POST['search']."</td>";
                        echo "<td data-label='Running Date'>$runningdate_u</td>";
                        echo "<td data-label='Total Time'>$totaltime_u</td>";
                        echo "<td data-label='Distance'>$distance_u KM</td>";
                        echo "<td data-label='Avg. Pace/ km'>$avgpace_u /KM</td>";
                        echo "<td data-label='Active Calories'>$activecalories_u KCAL</td>";
                        echo "<td data-label='Avg. Heart Rate'>$avgheartrate_u KCAL</td>";
                        echo "<td data-label='Max. Heart Rate'>$maxheartrate_u BPM</td>";
                        echo "<td data-label='Cadence'>$cadence_u</td>";
                        echo "<td data-label='Vertical Meter'>$vertiaclmeters_u M</td>";
                        echo "<td data-label='Type'>$type_u</td>";
                        echo "<td class='comment' data-label='Comment'>".$comment_u."</td>";
                    echo "</tr>";
        }	
        echo "</tbody>";
    echo "</table>";

    $stmt->close();
    $mysql->close();
}
?>