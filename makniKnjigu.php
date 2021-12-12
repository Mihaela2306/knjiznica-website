<?php
session_start();
include("dbh.php");

if(isset($_GET["knjigaId"])){
	$idKnjige = $_GET["knjigaId"];
	$sql = "SELECT * FROM knjige WHERE id='" . $idKnjige ."';";
}else{
	header("Location: ../knjiznica/knjiga.php?knjigaId=" . $idKnjige . "&promjena=error");
}
$idKorisnika = $_SESSION["id"];

$query = "DELETE FROM korisnik_knjiga WHERE korisnikId='" . $idKorisnika ."' AND knjigaId = '".$idKnjige . "'";
$result = mysqli_query($conn, $query);
	if($result){
		header("Location: ../knjiznica/knjiga.php?promjena=success&knjigaId=" . $idKnjige . "");
	} else {
		header("Location: ../knjiznica/knjiga.php?KnjigaId=" . $idKnjige . "&promjena=error");
	}

