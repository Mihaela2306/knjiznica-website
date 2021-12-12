<?php
session_start();
include("dbh.php");

if(isset($_GET["knjigaId"]) && isset($_GET["rating"]) && isset($_GET["korisnikId"])){
	$idKnjige = $_GET["knjigaId"];
	$rating = $_GET["rating"];
	$idKorisnika = $_GET["korisnikId"];
} else {
	header("Location: ../knjiznica/knjiga.php?knjigaId=" . $idKnjige . "&dodan=error");
}

$query = "INSERT INTO korisnik_knjiga (korisnikId, knjigaId, rating) VALUES ('$idKorisnika', '$idKnjige', '$rating')";
$result = mysqli_query($conn, $query);

header("Location: ../knjiznica/knjiga.php?dodan=success&knjigaId=" . $idKnjige . "");
