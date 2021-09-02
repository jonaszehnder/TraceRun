<?php
function GetRunUpdate() {
    include "../model/include.php";
    
    /*SELECT aller Daten eines bestimmten "Run"*/

    $stmt = $mysql->prepare("SELECT running_date, total_time, distance, active_calories, avg_heart_rate, max_heart_rate, cadence, vertical_meters, type, comment FROM trackrun WHERE id=(?)");
    $stmt->bind_param("i", $_GET["run"]);	
    $stmt->execute();		
    $stmt->bind_result($runningdateSQL, $totaltimeSQL, $distance, $activecalories, $avgheartrate, $maxheartrate, $cadence, $vertiaclmeters, $type, $comment);

    if($stmt->fetch()){	
        $arraySQL = array($runningdateSQL, $totaltimeSQL, $distance, $activecalories, $avgheartrate, $maxheartrate, $cadence, $vertiaclmeters, $type, $comment);
    }

    return $arraySQL;

    $stmt->close();
    $mysql->close();
}
?>