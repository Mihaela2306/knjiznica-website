<?php
session_start();
$idKorisnika = $_SESSION["id"];

if(isset($_POST["submit"])){
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];

	
	require_once 'dbh.php';
	require_once 'funkcije.php';
	
	if(deleteLoginConfirm($conn, $username, $pwd, $idKorisnika) === false){
		header("Location: ../knjiznica/delete.php?error=wronginput");
		exit();
	}
	
	$query = "DELETE FROM korisnici WHERE id='" . $idKorisnika ."'";
	
	$result = mysqli_query($conn, $query);
	if($result){
		header("Location: ../knjiznica/odjava.php");
	} else {
		echo("UPDATE komanda nije uspjela. Kontaktirajte Web administratora!");
	}
	
}else{
	header("Location: ../knjiznica/delete.php");
	exit();
}