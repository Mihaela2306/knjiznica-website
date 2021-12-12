<?php

if(isset($_POST["submit"])){ //provjeravamo ako je korisnik došao sa signup stranice, a ne preko URL-a
	$name = $_POST["name"];
	$author = $_POST["author"];
	$year = $_POST["year"];
	$genre = $_POST["genre"];
	$nakladnik = $_POST["nakladnik"];
	$language = $_POST["language"];
	$brPrimjeraka = $_POST["brPrimjeraka"];
	$opis = $_POST["opis"];
	$picture = $_POST["picture"];
	
	require_once 'dbh.php';
	require_once 'funkcije.php';
	
	createBook($conn, $name, $author, $year, $genre, $nakladnik, $language, $brPrimjeraka, $opis, $picture);
	
} else {
	header("Location: ../dodaj_knjigu.php");
	exit();
}
