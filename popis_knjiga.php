<?php
	include_once 'navbar.php';
	include_once 'dbh.php';
?>

<html>
<head>
	<title>Popis knjiga</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="popis_knjiga.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<br/><br/>
	<div id="idContainer1">
	<div class="center-div bg-dark border-light border border-2 h-100 justify-content-center align-items-center" id="idContainer2">
	<br/><br/>
	<?php
		if(isset($_POST["submit"])){
			$tekst = $_POST["search"];
			$mog = $_POST["mog"];
			if($mog == "autor"){
				$sql = "SELECT * FROM knjige WHERE autor LIKE '% ".$tekst."%' OR autor LIKE '".$tekst."%' OR autor LIKE '%".$tekst."' ORDER BY ime ASC;";
			} else if($mog == "naslov") {
				$sql = "SELECT * FROM knjige WHERE ime LIKE '% ".$tekst."%' OR ime LIKE '".$tekst."%' OR ime LIKE '%".$tekst."' ORDER BY ime ASC;";
			}
		} else if(isset($_GET["zanr"])){
			if($_GET["zanr"] == "drama"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Drama' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "enciklopedistika"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Enciklopedistika' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "fantastika"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Fantastika' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "humoristika"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Humoristični romani' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "krimi"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Kriminalistični romani' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "putopis"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Putopis' ORDER BY ime ASC;";
			}
			if($_GET["zanr"] == "scifi"){
				$sql = "SELECT * FROM knjige WHERE zanr = 'Znanstvena fantastika' ORDER BY ime ASC;";
			}
		} else {
			$sql = "SELECT * FROM knjige ORDER BY ime ASC;";
		}
		
		$result = $conn->query($sql);
		if(!($result->num_rows > 0)){
			echo "<div class='row'><div class='col-3'></div><div class='bg-dark border-light border border-2 col-6'><a href='https://knjiznica-mihaela.herokuapp.com/index.php' class='text-success'><h2>Ne postoji knjiga pod ovim upitom! Odi natrag.</h2></a></div><div class='col-3'></div></div></div>";
		}
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<div class='row'>";
				echo "<div class='col-3'></div>";
				echo "<div class='bg-dark border-light border border-2 col-6 mb-2'>";
				?>
				<a class="text-success" href="https://knjiznica-mihaela.herokuapp.com/knjiga.php?knjigaId=<?php echo $row['id']?>"><div class="row justify-content-center align-items-center"><h2><?php echo $row['ime']?></h2></div>
				<?php
				echo "<div class='row justify-content-center align-items-center'><h4><small>" . $row['autor'] . "</small></h4></div>";
				echo "<div class='row justify-content-center align-items-center'><h4><small>" . $row['godina'] . "</small></h4></div>";
				echo "</div>";
				?>
				</a>
				<?php
				echo "<div class='col-3'></div>";
				echo "</div>";
			}
		}
		?>
	</div>
	</div>
</div>
</body>
</html>
