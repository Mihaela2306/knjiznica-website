<?php

if(isset($_POST["submit"])){ //provjeravamo ako je korisnik došao sa signup stranice, a ne preko URL-a
	$name = $_POST["name"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdRepeat"];
	$admin = $_POST["admin"];
	
	require_once 'dbh.php';
	require_once 'funkcije.php';
	
	if(invalidUid($username) !== false){
		header("Location: knjiznica-mihaela.herokuapp.com/registriraj_se.php?error=invaliduid");
		exit();
	}
	
	if(pwdMatch($pwd, $pwdRepeat) !== false){
		header("Location: knjiznica-mihaela.herokuapp.com/registriraj_se.php?error=passwordsdontmatch");
		exit();
	}
	
	if(uidExists($conn, $username, $email) !== false){
		header("Location: knjiznica-mihaela.herokuapp.com/registriraj_se.php?error=usernametaken");
		exit();
	}
	
	createUser($conn, $name, $email, $username, $pwd, $admin);
	
} else {
	header("Location: knjiznica-mihaela.herokuapp.com/registriraj_se.php");
	exit();
}
