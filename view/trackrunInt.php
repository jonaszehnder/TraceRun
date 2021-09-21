<?php
session_start();
include "../controller/CONtrackrun.php";
include "headerLoad.php";
if(empty($_SESSION["username"])){
    header("Location: ../view/signin.php?warning=1");
}
/* http://localhost/TraceRun/view/trackrunInt.php?id=99 */
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <title>TraceRun</title>
</head>
<body>
    <?php LoadHeader(); ?>
    <div class="background-img bgi-trackrun">
        <div class="div container-trackrun">
            <h2>Track your Run</h2>
            <form action="trackrunIntIns.php" method="POST">
                <div class="div-trackrun-intervall">
                    <label for="intervall">Number of Intervalls</label>
                    <select class="selcet-type" name="nbrOfInt">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <label for="intervall">Intervall Laufzeit</label>
                    <input class="input-active" type="number" name="active" placeholder="Sec">
                    <label for="intervall">Intervall Pause</label>
                    <input class="input-pause" type="number" name="pause" placeholder="Sec">
                    <input type="hidden" name="idTrack" value=<?php echo $_GET["idTrack"]; ?>>
                    <input class="submit-btn" type="submit" name="submit" value="Continue">
                </div>
            </form>
        </div>
    </div>
</body>
</html>


