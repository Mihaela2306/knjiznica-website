<?php

require_once 'dbh.php';

if(isset($_POST["submit"])){
	$korisnik = $_POST["idkorisnika"];
	$knjiga = $_POST["idknjige"];
	
	require_once 'dbh.php';
	require_once 'funkcije.php';
	
	posudi($korisnik, $knjiga, $conn);
	
} else {
	header("Location: ../posudba.php");
	exit();
}
