<?php
session_start();
include "../model/include.php";

if($_POST["totaltime"] == "00:00:00" || empty($_POST["distance"]) || empty($_POST["avgheartrate"])){
    header("Location: ../view/trackrun.php?error=1");
    exit(0);
}

/*Datum wird für die DB richtig formatiert*/
if(empty($_POST["runningdate"])){
    $runningdateSQL = date("Y-m-d");
}else{
    $runningdateSQL = date("Y-m-d",strtotime($_POST["runningdate"]));
}

/*Update aller Daten*/
$stmt = $mysql->prepare("UPDATE trackrun SET running_date = (?), total_time = (?), distance = (?), active_calories = (?), avg_heart_rate = (?), max_heart_rate = (?), cadence = (?), vertical_meters = (?), type=(?), comment = (?) WHERE id = (?)");
$stmt->bind_param("ssdiiiiissi", $runningdateSQL, $_POST["totaltime"], $_POST["distance"], $_POST["activecalories"], $_POST["avgheartrate"], $_POST["maxheartrate"], $_POST["cadence"], $_POST["verticalmeters"], $_POST["type"], $_POST["comment"], $_GET["run"]);			

$fehler = 0;
if(!$stmt->execute()){
	$fehler = 1;
	echo $mysql->error . $stmt->error;
}

@$stmt->close();
@$mysql->close();

header("Location: ../view/run.php?run=".$_GET['run']."");
?>