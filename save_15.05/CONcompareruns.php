<?php
function GetRunsUser($id_userSession, $usernameTwo, $searchStartDate, $searchEndDate){
    include "../model/include.php";

    $stmt = $mysql->prepare("SELECT id FROM user WHERE username=(?)");
    $stmt->bind_param("s", $usernameTwo);
    $stmt->execute();
    $stmt->bind_result($id_userSearch);

    if($stmt->fetch()){	
        $id_userSearch;
    }else{
        header("Location: ../view/comparerunsselect.php?error=1");
        exit(0);
    }

    $stmt->close();

    echo "<table class='table-run table-run-childcolor'>";
    echo "<thead>";
        echo "<tr>";
            echo "<th>User</th>";
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
    

    /*Datum wird für die DB richtig formatiert*/
    if(empty($searchStartDate)){
        $searchStartDateSQL = date("Y-m-d");
    }else{
        $searchStartDateSQL = date("Y-m-d",strtotime($searchStartDate));
    }
    if(empty($searchEndDate)){
        $searchEndDateSQL = date("Y-m-d");
    }else{
        $searchEndDateSQL = date("Y-m-d", strtotime($searchEndDate));
    }

    $setTrue = true;
    $runningdateChaned = "";
    $counterColor;

    $stmt = $mysql->prepare("SELECT fk_user, running_date, total_time, distance, active_calories, avg_heart_rate, max_heart_rate, cadence, vertical_meters, type, comment FROM trackrun WHERE (fk_user=(?) OR fk_user=(?)) AND (running_date BETWEEN (?) AND (?)) ORDER BY running_date, fk_user ASC");
    $stmt->bind_param("iiss", $id_userSession,$id_userSearch,$searchStartDateSQL,$searchEndDateSQL);
    $stmt->execute();		
    $stmt->bind_result($fk_user_u, $runningdateSQL_u, $totaltimeSQL_u, $distance_u, $activecalories_u, $avgheartrate_u, $maxheartrate_u, $cadence_u, $vertiaclmeters_u, $type_u, $comment_u);

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

        if($fk_user_u == $id_userSession){
            $username = $_SESSION['username'];
        }else{
            $username = $usernameTwo;
        }

        echo "<tr>";
           if(!($runningdateChaned == $runningdate_u) || $setTrue){ echo "<td class='table-run-date' data-label='' colspan='11'>$runningdate_u</td>";}
        echo "</tr>";

        if(!($runningdateChaned == $runningdate_u)){
            echo "<tr class='table-run-color'>";
            $counterColor = 0;
        }elseif(!($counterColor == 0) && $counterColor % 2 == 1){
            echo "<tr class='table-run-color'>";
            $counterColor++;
        }else{
            echo "<tr>";
            $counterColor++;
        }
            echo "<td data-label='User'>$username</td>";
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
        $setTrue = false;
        $runningdateChaned = $runningdate_u;
    }	
echo "</tbody>";
echo "</table>";

$stmt->close();
$mysql->close();
}
?>