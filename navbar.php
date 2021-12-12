<?php
	session_start();
	require_once 'dbh.php';
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="pocetna.css">
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-success navbar-dark justify-content-center fixed-top border-bottom border-light border-2">
		<ul class="navbar-nav">
			<a href="pocetna.php" class="navbar-brand"><h4>Books Deluxe</h4></a>
			<li class="nav-item">
				<a href="pocetna.php" class="nav-link text-white"><h4><small>Početna</small></h4></a>
			</li>
			<?php
				if(isset($_SESSION["id"])){
					$ID = $_SESSION["id"];
					$sql = "SELECT * FROM korisnici WHERE ID = '$ID';";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);
				
					$row = mysqli_fetch_assoc($result);
					
					if($row['admin'] == 1){
						echo "<li class='nav-item'><a href='posudba.php' class='nav-link text-white'><h4><small>Posudite knjigu</small></h4></a></li>";
						echo "<li class='nav-item'><a href='vracanje.php' class='nav-link text-white'><h4><small>Vratite knjigu</small></h4></a></li>";
						echo "<li class='nav-item'><a href='dodaj_knjigu.php' class='nav-link text-white'><h4><small>Dodajte knjigu</small></h4></a></li>";
						echo "<li class='nav-item'><a href='odjava.php' class='nav-link text-white'><h4><small>Odjava</small></h4></a></li>";
					} else if($row['admin'] == 2){
						echo "<li class='nav-item'><a href='profil.php' class='nav-link text-white'><h4><small>Profil</small></h4></a></li>";
						echo "<li class='nav-item'><a href='odjava.php' class='nav-link text-white'><h4><small>Odjava</small></h4></a></li>";
					}
				} else if(!isset($_SESSION["id"])){
					echo "<li class='nav-item'><a href='registriraj_se.php' class='nav-link text-white'><h4><small>Registriraj se</small></h4></a></li>";
					echo "<li class='nav-item'><a href='prijava.php' class='nav-link text-white'><h4><small>Prijava</small></h4></a></li>";
				}	
			?>
			<li class="nav-item">
				<a href="kontakt.php" class="nav-link text-white"><h4><small>Kontakt</small></h4></a>
			</li>
		</ul>
	</nav>
</body>
</html>