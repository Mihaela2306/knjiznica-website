<?php

if(isset($_POST["submit"])){
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	
	//require_once 'pocetna.php';
	require_once 'dbh.php';
	require_once 'funkcije.php';
	
	loginUser($conn, $username, $pwd);
} else {
	header("Location: ../prijava.php");
	exit();
}
