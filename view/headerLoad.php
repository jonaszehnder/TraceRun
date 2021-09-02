<?php
function LoadHeader(){
    echo "<div class='header'>
        <input type='checkbox' id='check'>
            <label for='check' class='checkbtn'>
                <i class='fa fa-bars'></i>
            </label>
            <h1 class='logo'>TraceRun</h1>
            <ul class='nav-links'>
                <li><a href='index.php'>Home</a></li>
                <li><a href='trackrun.php'>Track Run</a></li>
                <li><a href='runs.php'>Runs</a></li>
                <li><a href='comparerunsselect.php'>Compare</a></li>";
                if(empty($_SESSION["username"])){
                    echo "<li><a href='signin.php'>Login</a></li>";
                } else {
                    echo "<li><a class='userlogin' href='../controller/CONsignout.php'>".$_SESSION["username"]."</a></li>";
                }
            echo "</ul>
    </div>";
}
?>