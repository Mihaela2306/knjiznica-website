<?php
	include_once 'navbar.php';
	include_once 'dbh.php';
	include_once 'funkcije.php';
	
	if(isset($_GET["knjigaId"])){
		$ID = $_GET["knjigaId"];
		$sql = "SELECT * FROM knjige WHERE id='" . $ID . "'";
	} else {
		header("Location: ../index.php");
	}
	
	$idKorisnika = $_SESSION['id'];
	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);
	
	if(isset($_POST['sub'])){
		if(isset($_POST['ratingKnjige'])){
			$ratingKnjige = $_POST['ratingKnjige'];
			if($ratingKnjige == "" || $ratingKnjige == null){
				echo "<script>alert('Upišite ocjenu za film!')</script>";
			} else if ($ratingKnjige < 1 || $ratingKnjige > 10){
				echo "<script>alert('Nevažeća ocjena upisana!')</script>";
			} else {
				header("Location: ../dodajKnjigu.php?knjigaId=" . $ID . "&rating=" . $ratingKnjige . "&korisnikId=" . $idKorisnika);
			}
		}
	}
	
	if(isset($_POST['subdva'])){
		if(isset($_POST['broj'])){
			$broj = $_POST['broj'];
			if($broj < 0){
				echo "<script>alert('Nevažeća količina primjeraka upisana!')</script>";
			} else {
				header("Location: ../promijeniprimjerke.php?knjigaId=" . $ID . "&broj=" . $broj . "");
			}
		}
	}
?>

<html>
<head>
	<title><?php echo $row['ime']; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="knjiga.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<br/><br/><br/><br/>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10 bg-dark text-white border border-light rounded border-2 px-2 py-2" align="center">
			<h2><?php echo $row['ime']; ?></h2>
		</div>
		<div class="col-sm-1"></div>
	</div>
	<br/>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-3">
			<img src="<?php echo $row['slika']; ?>" class="img-thumbnail float-left">
		</div>
		<div class="col-sm-7 bg-dark text-white border border-light rounded border-2 px-2 py-2" style="height:700;">
			<div class="row">
				<div class="col-5">
					<h2><small>
					Autor:<br/>
					Godina izdanja:<br/>
					Žanr:<br/>
					Nakladnik:<br/>
					Jezik:<br/>
					Srednja ocjena svih korisnika:<br/>
					Broj dostupnih primjeraka:<br/>
					<?php
					if(isset($_SESSION["id"])){
						$korisnikId = $_SESSION["id"];
						$sql = "SELECT * FROM korisnici WHERE id = '$korisnikId';";
						$result = mysqli_query($conn, $sql);
						$resultCheck = mysqli_num_rows($result);
				
						$rowone = mysqli_fetch_assoc($result);
						
						if($rowone['admin'] == 2){
							echo "Tvoja ocjena:<br/>";
							$rating = ratingKorisnika($ID, $_SESSION['id']);
							if($rating == 0){
								echo "Ocjenite knjigu od 1 do 10:<br/>";
							}
						} else if($rowone['admin'] == 1){
							echo "Promijenite broj dostupnih primjeraka:<br/>";
						}
					}
					
					?>
					</h2></small>
				</div>
				<div class="col-7">
					<h2><small>
					<?php echo $row['autor']; ?><br/>
					<?php echo $row['godina']; ?><br/>
					<?php echo $row['zanr']; ?><br/>
					<?php echo $row['nakladnik']; ?><br/>
					<?php echo $row['jezik']; ?><br/>
					<?php 
					$query = "SELECT rating FROM korisnik_knjiga WHERE knjigaId = '" . $ID . "'";
					$rezultat = mysqli_query($conn, $query);
					$brojac = 0;
					$ratingZbroj = 0;
					
					while ($red = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)){
						$brojac = $brojac + 1;
						$ratingZbroj = $ratingZbroj + $red['rating'];
					}
					
					if (!$brojac){
						echo "0/10<br>";
					} else {
						$avg = $ratingZbroj / $brojac;
						$avgfmt = number_format($avg, 1);
						echo $avgfmt . "/10<br>";
					}
					
					echo $row['brPrimjeraka'] . "<br/>"; ?>
					
					
					
					<?php
					if(isset($_SESSION["id"])){
						$korisnikId = $_SESSION["id"];
						$sql = "SELECT * FROM korisnici WHERE id = '$korisnikId';";
						$result = mysqli_query($conn, $sql);
						$resultCheck = mysqli_num_rows($result);
				
						$rowone = mysqli_fetch_assoc($result);
						
						if($rowone['admin'] == 2){
							$rating = ratingKorisnika($ID, $_SESSION['id']);
							if($rating == 0){
								echo "<h2><small>Niste ocijenili ovu knjigu.</small></h2>";
								echo "
					<form class='form-inline' method='post'>
						<select name='ratingKnjige' class='custom-select custom-select-sm' style='width:170px'>
							<option selected><h4><small>Odaberite ocjenu</h4></small></option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
							<option value='7'>7</option>
							<option value='8'>8</option>
							<option value='9'>9</option>
							<option value='10'>10</option>
						</select>
						<button name='sub' class='btn btn-success btn-block btn-sm border border-light rounded border-2' style='width:170px' type='submit'>Ocijeni knjigu</button>
					</form>";
							} else {
								echo "<h2><small>" . $rating . "</small></h2>";
							}
							
						} else if ($rowone['admin'] == 1){
							echo "
							<form class='form-inline needs-validation' method='post' novalidate>
								<input type='number' class='form-control' name='broj' placeholder='Broj primjeraka...' required>
								<div class='valid-feedback'></div>
								<div class='invalid-feedback'>Molim ispunite polje.</div>
								<button name='subdva' class='btn btn-success btn-block border border-light rounded border-2' style='width:230px' type='submit'>Promijeni broj primjeraka</button>
							</form>";
						}
					}?>
				</div>
			</div>
			<?php
			if(isset($_GET["dodan"])){
				if($_GET["dodan"] == 'success'){
					echo "<h2><small>Knjiga je dodana na Vašu listu pročitanih knjiga!</small></h2>";
					echo "<a href='makniKnjigu.php?knjigaId=" . $ID . "'><button class='btn btn-success btn-block border border-light rounded border-2' style='width:170px' type='submit'>Makni knjigu</button></a>";
				} else if ($_GET["dodan"] == 'error'){
					echo "<h2><small>Došlo je do neke pogreške tijekom dodavanja ove knjige na Vašu listu pročitanih knjiga.</small></h2>";
				}
			} else if(isset($_GET["promjena"])){
				if($_GET["promjena"] == 'success'){
					echo "<h2><small>Knjiga je izbrisana sa Vaše liste pročitanih knjiga!</small></h2>";
				} else if($_GET['promjena'] == 'error'){
					echo "<h2><small>Došlo je do neke pogreške tijekom brisanja ove knjige iz Vaše liste pročitanih knjiga.</small></h2>";
				}
			} else if(isset($_GET["promjenabr"])){
				if($_GET["promjenabr"] == 'success'){
					echo "<h2><small>Uspješno ste promijenili broj primjeraka!</small></h2>";
				} else if($_GET['promjena'] == 'error'){
					echo "<h2><small>Došlo je do neke pogreške tijekom promjene primjeraka ove knjige.</small></h2>";
				}
			} else {
				if(!(isset($_SESSION['id']))){
					echo "<h2><small>Ulogirajte se u svoj korisnički račun da bi dodavali/micali knjige sa svoje liste.</small></h2>";
				} else {
					$pogledano = provjeraPogledano($ID, $_SESSION['id']);
					if($pogledano == 1){
						echo "<h2><small>Ovu ste knjigu pročitali.</small></h2>";
						echo "<a href='makniKnjigu.php?knjigaId=" . $ID . "'><button class='btn btn-success btn-block border border-light rounded border-2' style='width:170px' type='submit'>Makni knjigu</button></a>";
					}
				}
			}
			?>
			<div class="row velicina bg-dark text-white border border-light rounded border-2 absolute mx-5 my-5 skrol">
			<h2><small>Opis:<br/></small></h2>
			<h3><small>
				<?php echo $row['opis']; ?>
			</h3></small>
			</div>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</body>
</html>
