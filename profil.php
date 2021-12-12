<?php
	include_once 'navbar.php';
	include_once 'dbh.php';
?>

<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="profil.css">
</head>

<?php
	$ID = $_SESSION["id"];
	$sql = "SELECT * FROM korisnici WHERE id = '$ID';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);
?>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-1"></div>
		<div class="col-sm-4 bg-dark text-white border border-light rounded border-2 card card-body justify-content-center" style="height:400px;">
			<div class="row">
				<div class="col-sm-5 align-self-center" align="center">
					<h3><small>Korisničko ime:</small></h3>
					<h3><small>Ime i prezime:</small></h3>
					<h3><small>Email:</small></h3>
					<h3><small>Broj pročitanih knjiga:</small></h3>
					<a href='brisanjeProfila.php'><button class='btn btn-success btn-block border border-light rounded border-2' style='width:170px' type='submit'>Brisanje profila</button></a>
				</div>
				<div class="col-sm-7 align-self-center" align="center">
					<h3><small><?php echo $row['uidKorisnika'] ?></small></h3>
					<h3><small><?php echo $row['imeKorisnika'] ?></small></h3>
					<h3><small><?php echo $row['emailKorisnika'] ?></small></h3>
					<?php 
						$sql = "SELECT * FROM korisnik_knjiga WHERE korisnikId ='" . $ID . "';";
						$result = mysqli_query($conn, $sql);
						if(!$result) {
							echo "<h3><small>0</small></h3>";
						} else {
							$resultCheck = mysqli_num_rows($result);
							$br = 0;
							$row = mysqli_fetch_assoc($result);
							if($result->num_rows > 0){
								$br++;
								while($row = $result->fetch_assoc()){
									$br = $br + 1;
								}
							}
							
							echo "<h3><small>" . $br . "</small></h3>";
						}
					?>
					<a href='promjenauid.php'><button class='btn btn-success btn-block border border-light rounded border-2' style='width:250px' type='submit'>Promjena korisničkog imena</button></a>
				</div>
			</div>
		</div>
		<div class="col-sm-6 bg-dark text-white border border-light rounded border-2 align-items-center" align="center" style="height:400px;">
			<h2><small>Lista pročitanih knjiga:</small></h2>
			<div class="row velicina bg-dark text-white border border-light rounded border-2 absolute mx-3 my-3 skrol" style="height:340;">
				<?php
				$query = "SELECT * FROM korisnik_knjiga WHERE korisnikId = '" . $ID . "';";
				$rezultat = $conn->query($query);
				
				if($rezultat->num_rows > 0){
					while($red = $rezultat->fetch_assoc()){
						$q = "SELECT * FROM knjige WHERE id = '" . $red['knjigaId'] . "';";
						$results = $conn->query($q);
						$rows = $results->fetch_assoc();
						echo "<div class='row'>";
						echo "<div class='bg-dark border-light border border-2'>";
						?>
						<a class="text-success" href="http://localhost/knjiznica/knjiga.php?knjigaId=<?php echo $rows['id']?>"><div class="row justify-content-center align-items-center"><h2><?php echo $rows['ime']?></h2></div>
						<?php
						echo "<div class='row justify-content-center align-items-center'><h4><small>" . $rows['autor'] . "</small></h4></div>";
						echo "<div class='row justify-content-center align-items-center'><h4><small>" . $rows['godina'] . "</small></h4></div>";
						echo "</div>";
						?>
						</a>
						<?php
						echo "</div><br/>";
					}
				} else {
					echo "<h4><small>Nemate pročitanih knjiga.</small></h4>";
				}
				?>
			</div>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</body>
</html>