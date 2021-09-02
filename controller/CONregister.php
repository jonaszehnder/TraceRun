<?php
session_start();
include "../model/include.php";

/*Überprüfung ob E-Mail bereits vergeben ist*/
$stmt = $mysql->prepare("SELECT email FROM user WHERE email=?");
$stmt->bind_param("s", $_POST["email"]);		
$stmt->execute();
$emailExists = $stmt->fetch();
@$stmt->close();

/*Überprüfen ob Username bereits vergeben ist*/
$stmt = $mysql->prepare("SELECT username FROM user WHERE username=?");
$stmt->bind_param("s", str_replace(' ', '', $_POST["username"]));	
$stmt->execute();
$usernameExists = $stmt->fetch();
@$stmt->close();

/*Bei error, redirected zum Registrieren*/
if(empty($_POST["email"])){
    header("Location: ../view/register.php?error=1");
    exit(0);
}
elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/register.php?error=3");
    exit(0);
}
elseif($emailExists){
	header("Location: ../view/register.php?error=2");	 
    exit(0);
}

if(empty($_POST["password"])){
	header("Location: ../view/register.php?error=6");
    exit(0);
}elseif (strlen($_POST["password"]) > 30) {
    header("Location: ../view/register.php?error=8");
    exit(0);
}


if(empty($_POST["username"])){
    header("Location: ../view/register.php?error=5");
    exit(0);
}elseif (strlen($_POST["username"]) > 25) {
    header("Location: ../view/register.php?error=7");
    exit(0);
}elseif ($userExists) {
	   header("Location: ../view/register.php?error=4");
       exit(0);
}

/*Falls alles valid ist, Passwort hashen und INSERT in DB durchführen*/
$pwd_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$stmt = $mysql->prepare("INSERT INTO user (username,password,email) VALUES(?,?,?)");
$stmt->bind_param("sss",str_replace(' ', '', $_POST["username"]),$pwd_hash, $_POST["email"]);			
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];	

/*Falls error auftritt*/
$fehler = 0;
if(!$stmt->execute() ){
	$fehler = 1;
	echo $mysql->error . $stmt->error;
}
@$stmt->close();

/*ID des Eintrags abfragen -> später in de Session gebraucht*/
$stmt = $mysql->prepare("SELECT id FROM user WHERE username=(?)");
$stmt->bind_param("s",$_SESSION["username"]);
$stmt->execute();
$stmt->bind_result($id);

if($stmt->fetch()){	
    $_SESSION["id"] = $id;
}

header("Location: ../view/register.php?success=1");

@$stmt->close();
@$mysql->close();
?>