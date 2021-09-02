<?php
function GetLastRun($id_Session){
    include "../model/include.php";

    $stmt = $mysql->prepare("SELECT MAX(running_date) FROM trackrun WHERE fk_user=(?)");
    $stmt->bind_param("i", $id_Session);
    $stmt->execute();
    $stmt->bind_result($lastRunSQL);
    $stmt->fetch();

    $lastRun = date("d.m.Y", strtotime($lastRunSQL));

    $stmt->close();
    $mysql->close();

    return $lastRun;
}


function GetRunStatsMethods($id_Session){
    include "../model/include.php";

    $enterloop = FALSE;

    $totalTimeEndurance = 0;
    $totalTimeHardWork = 0;

    $startDateSQL = date("Y-m-d", strtotime('-7day',time()));
    $endDateSQL = date("Y-m-d", time());

    $stmt = $mysql->prepare("SELECT total_time, type FROM trackrun WHERE fk_user=(?) AND running_date BETWEEN (?) AND (?)");
    $stmt->bind_param("iss", $id_Session,$startDateSQL,$endDateSQL);
    $stmt->execute();
    $stmt->bind_result($totalTimeAllRuns, $typeAllRuns);
    
    while($stmt->fetch()) {
        list($h, $m, $s) = explode(":", $totalTimeAllRuns);
        $m += $h * 60;
        $s += $m * 60;
        if($typeAllRuns == "E"){
            $totalTimeEndurance += $s;
        }else{
            $totalTimeHardWork += $s;
        }    
        $enterloop = TRUE;
    }

    if($enterloop) {
        $stmt->close();
        $mysql->close();

        $hrs = floor($totalTimeEndurance / 3600 % 60);
        $mins = floor($totalTimeEndurance / 60 % 60);
        $secs = floor($totalTimeEndurance % 60);
        $totalTimeEnduranceHTML  = sprintf('%02d:%02d:%02d', $hrs, $mins, $secs);

        $hrs = floor($totalTimeHardWork / 3600 % 60);
        $mins = floor($totalTimeHardWork / 60 % 60);
        $secs = floor($totalTimeHardWork % 60);

        $totalTimeHardWorkHTML  = sprintf('%02d:%02d:%02d', $hrs, $mins, $secs);

        $totalTimeEndurancePerc = round($totalTimeEndurance / ($totalTimeEndurance+$totalTimeHardWork) * 100);
        $totalTimeHardWorkPerc = round($totalTimeHardWork / ($totalTimeEndurance+$totalTimeHardWork) * 100);

        if($totalTimeEndurance > $totalTimeHardWork){
            $totalTimeHardWork = round($totalTimeHardWork / $totalTimeEndurance * 100);
            $totalTimeEndurance = 100;
            
        }else{
            $totalTimeEndurance = round($totalTimeEndurance / $totalTimeHardWork * 100);
            $totalTimeHardWork = 100;
        }

        $arrayTotalTimes = array($totalTimeEnduranceHTML, $totalTimeEndurance, $totalTimeEndurancePerc, $totalTimeHardWorkHTML, $totalTimeHardWork, $totalTimeHardWorkPerc);

        return $arrayTotalTimes;
    }

}
?>

