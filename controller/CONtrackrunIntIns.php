<?php
session_start();
include "../model/include.php";

for($x = 1; $_POST["nbrOfInt"] >= $x; $x++){
    if(empty($_POST["avgheartrate".$x]) || empty($_POST["cadence".$x]) || empty($_POST["distance".$x])){
        header("Location: ../view/trackrunInt.php?idTrack=".$_POST['idTrack']."&error=1");
    exit(0);
    }
}

/*Insert aller Daten*/
$stmt = $mysql->prepare("UPDATE trackrun SET int_active = (?), int_pause = (?) WHERE id = (?)");
$stmt->bind_param("iii", $_POST["active"], $_POST["pause"], $_POST["idTrack"]);			

$fehler = 0;
if(!$stmt->execute()){
    $fehler = 1;
    echo $mysql->error . $stmt->error;
}

@$stmt->close();

for($x = 1; $_POST["nbrOfInt"] >= $x; $x++){

    /*Insert aller Daten*/
    $stmt = $mysql->prepare("INSERT INTO danielfischer_tracerun.interval (fk_trackrun, avg_heart_rate, cadence, distance) VALUES (?,?,?,?)");
    $stmt->bind_param("iiii", $_POST["idTrack"], $_POST["avgheartrate".$x], $_POST["cadence".$x], $_POST["distance".$x]);			

    $fehler = 0;
    if(!$stmt->execute()){
        $fehler = 1;
        echo $mysql->error . $stmt->error;
    }

    @$stmt->close();
}
@$mysql->close();

header("Location: ../view/runs.php");


?>