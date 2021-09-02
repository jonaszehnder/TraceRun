<?php
function GetTrackRuns() {
    include "../model/include.php";

    /*SELECT aller "Runs" die der User je abgespeichert hat, geordnet nach Datum (neu zuoberst)*/
    $stmt = $mysql->prepare("SELECT id, running_date, total_time, type FROM trackrun WHERE fk_user=(?) ORDER BY running_date DESC");

    $stmt->bind_param("i",$_SESSION["id"]);
    $stmt->execute();
    $stmt->bind_result($id_trackrun, $runningdateSQL, $totaltimeSQL, $type);

    while($stmt->fetch()){	
        $runningdate = date("d.m.Y",strtotime($runningdateSQL));
        $totaltime = date("G:i:s", strtotime($totaltimeSQL));
        echo "<a href='../view/run.php?run=$id_trackrun' class='div container-run-elements'>";
            echo "<i class='fas fa-running'></i>";
            echo "<p class='runs-runningdate runs-margin'>Date:</p>";
            echo "<p class='runs-runningdate'>$runningdate</p>";
            echo "<div class='runs-type'>";
                echo "<p class='runs-runningdate runs-margin-type'>Type:</p>";
                echo "<p class='runs-runningdate'>$type</p>";
            echo "</div>";
            echo "<br>";
            echo "<p class='runs-totaltime runs-margin'>Time:</p>";
            echo "<p class='runs-totaltime'>$totaltime</p>";
            echo "<div class='trashlogo'>";
                echo "<form method='POST'>";
                    echo "<button class='btnDel' name='btnDel' value='$id_trackrun'><img class='icon-runs' src='../view/picture/trashicon_runs.svg'></button>";
                echo "</form>";
            echo "</div>";
        echo "</a>";
    }	

if(isset($_POST['btnDel'])) {
    include "../model/include.php";
    $stmt = $mysql->prepare("DELETE FROM trackrun WHERE id=(?)");
    $stmt->bind_param("i",$_POST['btnDel']);
    $stmt->execute();
    $stmt->close();
    $mysql->close();
    header("Location: ../view/runs.php");
}

$stmt->close();
$mysql->close();

}

function GetImgHeight() {
    $counterheight = 0;
    include "../model/include.php";

    $stmt = $mysql->prepare("SELECT id FROM trackrun WHERE fk_user=(?) ");

    $stmt->bind_param("i",$_SESSION["id"]);
    $stmt->execute();
    $stmt->bind_result($id_trackrun);

    while($stmt->fetch()){	
        $counterheight++;
    }

    $stmt->close();
    $mysql->close();

    return $counterheight;
}
?>