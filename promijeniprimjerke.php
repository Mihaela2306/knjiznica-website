<?php
session_start();
include("dbh.php");

if(isset($_GET["knjigaId"]) && isset($_GET["broj"])){
	$idKnjige = $_GET["knjigaId"];
	$broj = $_GET["broj"];
} else {
	header("Location: ../knjiznica/knjiga.php?knjigaId=" . $idKnjige . "&promjenabr=error");
}

$query = "UPDATE knjige SET brPrimjeraka = " . $broj . " WHERE id = '" . $idKnjige . "'";
$result = mysqli_query($conn, $query);

header("Location: ../knjiznica/knjiga.php?promjenabr=success&knjigaId=" . $idKnjige);