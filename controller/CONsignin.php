<?php
session_start();
include "../model/include.php";

/*Eingabe wird überprüft, sonst redirected*/
if(empty($_POST["username"])){
    if(empty($_POST["password"])){
        header("Location: ../view/signin.php?error=1&error=2");
        exit(0);
    }else{
        header("Location: ../view/signin.php?error=1");
        exit(0);
    }
}
if(empty($_POST["password"])){
    header("Location: ../view/signin.php?error=2");
    exit(0);
}

/*Benutzername auf DB suchen*/
$stmt = $mysql->prepare("SELECT id, username, email, password FROM user WHERE username=(?)");

$stmt->bind_param("s",$_POST["username"]);
$stmt->execute();
$stmt->bind_result($id, $username, $email, $password);

/*PW wird überrüft, falls stimmt wird der User eingeloggt*/
if($stmt->fetch()){	
    if($_POST["username"]==$username && password_verify($_POST["password"], $password)){
        $_SESSION["username"] = $username;
	    $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
	    header("Location: ../view/signin.php?success=1");
        exit(0);
    }
	else{
		header("Location: ../view/signin.php?error=3");
        exit(0);
	}
}	
else{
		header("Location: ../view/signin.php?error=4");
        exit(0);
	}
$stmt->close();
$mysql->close();
?>