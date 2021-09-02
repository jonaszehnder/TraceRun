<?php
function GetRunsUser($id_userSession, $usernameTwo, $searchStartDate, $searchEndDate, $chBoxS, $orderByVar){
    include "../model/include.php";

    if(!empty($orderByVar)){
        $orderByVar .= " ,";
    }

    $id_userSearch = "";

    if(!empty($usernameTwo)){ 
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
    }else{
        $id_userSearch = $_SESSION["id"];
    }

    echo "<table class='table-run table-run-childcolor'>";
    echo "<thead>";
        echo "<tr>";
            echo "<th>User</th>";
            if($chBoxS[0]){echo "<th>Total Time</th>";}
            if($chBoxS[1]){echo "<th>Distance</th>";}
            if($chBoxS[2]){echo "<th>Avg. Pace/ km</th>";}
            if($chBoxS[3]){echo "<th>Active Calories</th>";}
            if($chBoxS[4]){echo "<th>Avg. Heart Rate</th>";}
            if($chBoxS[5]){echo "<th>Max. Heart Rate</th>";}
            if($chBoxS[6]){echo "<th>Cadence</th>";}
            if($chBoxS[7]){echo "<th>Vertical Meter</th>";}
            if($chBoxS[8]){echo "<th>Type</th>";}
            if($chBoxS[9]){echo "<th class='comment'>Comment</th>";}
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    

    /*Datum wird für die DB richtig formatiert*/
    $timezone = date_default_timezone_get();
    if(empty($searchStartDate)){
        $searchStartDateSQL = "2000-01-01";
    }else{
        $searchStartDateSQL = date("Y-m-d",strtotime($searchStartDate));
    }
    if(empty($searchEndDate)){
        $searchEndDateSQL = date("Y-m-d", time());
    }else{
        $searchEndDateSQL = date("Y-m-d", strtotime($searchEndDate));
    }

    $setTrue = true;
    $runningdateChaned = "";

    $stmt = $mysql->prepare("SELECT fk_user, running_date, total_time, distance, active_calories, avg_heart_rate, max_heart_rate, cadence, vertical_meters, type, comment FROM trackrun WHERE (fk_user=(?) OR fk_user=(?)) AND (running_date BETWEEN (?) AND (?)) ORDER BY " .$orderByVar. "running_date, fk_user DESC");
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

        if(empty($comment_u)){
            $comment_u = "-";
        }

        echo "<tr>";
           if(!($runningdateChaned == $runningdate_u) || $setTrue){ echo "<td class='table-run-date' data-label='' colspan='11'>$runningdate_u</td>";}
        echo "</tr>";

        if($fk_user_u == $id_userSession){
            $username = $_SESSION['username'];
            echo "<tr class='table-run-color-userOne'>";
        }else{
            $username = $usernameTwo;
            echo "<tr class='table-run-color-userTwo'>";
        }
    
            echo "<td data-label='User'>$username</td>";
            if($chBoxS[0]){echo "<td data-label='Total Time'>$totaltime_u</td>";}
            if($chBoxS[1]){echo "<td data-label='Distance'>$distance_u KM</td>";}
            if($chBoxS[2]){echo "<td data-label='Avg. Pace/ km'>$avgpace_u /KM</td>";}
            if($chBoxS[3]){echo "<td data-label='Active Calories'>$activecalories_u KCAL</td>";}
            if($chBoxS[4]){echo "<td data-label='Avg. Heart Rate'>$avgheartrate_u BPM</td>";}
            if($chBoxS[5]){echo "<td data-label='Max. Heart Rate'>$maxheartrate_u BPM</td>";}
            if($chBoxS[6]){echo "<td data-label='Cadence'>$cadence_u SPM</td>";}
            if($chBoxS[7]){echo "<td data-label='Vertical Meter'>$vertiaclmeters_u M</td>";}
            if($chBoxS[8]){echo "<td data-label='Type'>$type_u</td>";}
            if($chBoxS[9]){echo "<td class='comment' data-label='Comment'>".$comment_u."</td>";}
        echo "</tr>";
        $setTrue = false;
        $runningdateChaned = $runningdate_u;
    }	
echo "</tbody>";
echo "</table>";


echo "<div class='compare-graph'></div>";

$stmt->close();
$mysql->close();
} 
?>