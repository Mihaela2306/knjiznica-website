<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
	$result;
	if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidUid($username){
	$result;
	if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function invalidEmail($email){
	$result;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //built in php function
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd, $pwdRepeat){
	$result;
	if($pwd !== $pwdRepeat){ 
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function uidExists($conn, $username, $email){
	$sql = "SELECT * FROM korisnici WHERE uidKorisnika = ? OR emailKorisnika = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../knjiznica/signup.php?error=stmtfailed");
		exit();
	}	
	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultData)){
		return $row;   //ako korisnik postoji, vraćamo njegove podatke
	}
	else{
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd, $admin){
	$sql = "INSERT INTO korisnici (imeKorisnika, emailKorisnika, uidKorisnika, lozinka, admin) values (?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: registriraj_se.php?error=stmtfailed");
		exit();
	}
	
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //koristimo default nacin hashiranja lozinke
	
	mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $username, $hashedPwd, $admin);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("Location: registriraj_se.php?error=none");
}

function loginUser($conn, $username, $pwd){
	$uidExists = uidExists($conn, $username, $username);
	
	if($uidExists === false){
		header("location: ../knjiznica/prijava.php?error=wronglogin");
		exit();
	}
	
	$pwdHashed = $uidExists["lozinka"];
	$checkPwd = password_verify($pwd, $pwdHashed);
	
	if($checkPwd === false){
		header("location: ../knjiznica/prijava.php?error=wronglogin");
		exit();
	}else if($checkPwd === true){
		session_start();
		$_SESSION["id"] = $uidExists["id"];
		$_SESSION["uidKorisnika"] = $uidExists["uidKorisnika"];
		header("location: ../knjiznica/pocetna.php");
		exit();
	}
}



function posudi($korisnik, $knjiga, $conn){
	$upit = "SELECT * FROM korisnici WHERE id = '" . $korisnik . "'";
	$rezultat = mysqli_query($conn, $upit);
	
	$upittri = "SELECT * FROM knjige WHERE id = '" . $knjiga . "'";
	$rezultattri = mysqli_query($conn, $upittri);
	
	if (mysqli_num_rows($rezultat) == 0 || mysqli_num_rows($rezultattri) == 0){
		header("Location: ../knjiznica/posudba.php?error=nepostoji");
		exit();
	}
	
	$sql = "SELECT * FROM knjige WHERE id = '$knjiga';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);
	$novo = $row['brPrimjeraka'] - 1;
	if($novo <= -1){
		header("Location: ../knjiznica/posudba.php?error=premalo");
	} else {
		$upitdva = "UPDATE knjige SET brPrimjeraka = " . $novo . " WHERE id = '" . $knjiga . "'";
		$rezultatdva = mysqli_query($conn, $upitdva);
		
		$query = "INSERT INTO posudjeno (idKorisnik, idKnjiga) values (?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $query)){
			header("Location: ../knjiznica/posudba.php?error=stmtfailed");
			exit();
		} 
		mysqli_stmt_bind_param($stmt, 'ii', $korisnik, $knjiga);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("Location: ../knjiznica/posudba.php?error=none");
	}
}

function vrati($korisnik, $knjiga, $conn){
	$upitdva = "SELECT * FROM posudjeno WHERE idKorisnik = '" . $korisnik . "' AND idKnjiga = '" . $knjiga . "'";
	$rezultatdva = mysqli_query($conn, $upitdva);
	
	if (mysqli_num_rows($rezultatdva) == 0){
		header("Location: ../knjiznica/vracanje.php?error=nepostoji");
		exit();
	}
	
	$sql = "SELECT * FROM knjige WHERE id = '$knjiga';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);
	$novo = $row['brPrimjeraka'];
	
	$query = "DELETE FROM posudjeno WHERE idKorisnik='" . $korisnik . "' AND idKnjiga = '" . $knjiga . "'";
	$result = mysqli_query($conn, $query);
	
	$upit = "UPDATE knjige SET brPrimjeraka = " . $novo . "+ 1 WHERE id = '" . $knjiga . "'";
	$rezultat = mysqli_query($conn, $upit);
	
	if($result & $rezultat){
		header("Location: ../knjiznica/vracanje.php?error=none");
	} else {
		header("Location: ../knjiznica/vracanje.php?error=yes");
	}
}
function createBook($conn, $name, $author, $year, $genre, $nakladnik, $language, $brPrimjeraka, $opis, $picture){
	$sql = "INSERT INTO knjige (ime, autor, godina, zanr, nakladnik, jezik, brPrimjeraka, opis, slika) values (?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../knjiznica/dodaj_knjigu.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, 'ssisssiss', $name, $author, $year, $genre, $nakladnik, $language, $brPrimjeraka, $opis, $picture);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("Location: ../knjiznica/dodaj_knjigu.php?error=none");
	exit();
}

function ratingKorisnika($ID, $idKorisnika){
	include("dbh.php");
	$sql = "SELECT * FROM korisnik_knjiga WHERE knjigaId = '" . $ID . "' AND korisnikId = '" . $idKorisnika . "';";
	$result = mysqli_query($conn, $sql);
	if(!($result)){
		return 0;
	}
	
	$resultCheck = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	
	if(!isset($row['korisnikId'])){
		return 0;
	}
	
	if($row['rating'] == ""){
		return 0;
	} else {
		return $row['rating'];
	}
}

function provjeraPogledano($ID, $idKorisnika){
	include("dbh.php");
	$sql = "SELECT * FROM korisnik_knjiga WHERE knjigaId = '". $ID ."' AND korisnikId = '". $idKorisnika . "';";
	$result = mysqli_query($conn, $sql);
	if(!($result)){
		return 0;
	}
	
	$row=mysqli_fetch_row($result);
	
	if (!isset($row[0])){
		return 0;
	}

	if($row[0] >= 1) {
		return 1;
	} else {
		return 0;
	}

}

function deleteLoginConfirm($conn, $username, $pwd, $idKorisnika){
	$result;
	$uidExists = uidExists($conn, $username, $username);
	
	if($uidExists === false){
		$result = false;
		return $result;
	}
	
	if($uidExists['id'] === $idKorisnika){
		$pwdHashed = $uidExists["lozinka"];
		$checkPwd = password_verify($pwd, $pwdHashed);
	
		if($checkPwd === false){
			$result = false;
			return $result;
		}else if($checkPwd === true){
			$result = true;
			return $result;
		}
	}
	else{
		$result = false;
		return $result;
	}
}

function newUidExists($conn, $username){
	$sql = "SELECT * FROM korisnici WHERE uidKorisnika = '$username';";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../knjiznica/promjenauid.php?error=stmtfailed");
		exit();
	}	
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultData)){
		return $row;   //ako korisnik postoji, vraćamo njegove podatke
	}
	else{
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}
