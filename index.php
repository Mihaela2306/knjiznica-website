<?php
	include_once 'navbar.php';
?>

<html>
<head>
	<title>Dobrodošli</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="pocetna.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 bg-dark text-white border border-light rounded border-2 px-2 py-2" align="center">
			<h2><small>Dobrodošli u Books Deluxe knjižnicu. Ovdje ćete moći pretraživati, posuđivati te vraćati knjige. Moći ćete ocijenjivati knjigu po želji, dodavati knjige na popis knjiga koje želite pročitati i slično. Uživajte!</small></h2>
			<div class="row pb-2">
				<div class="col-6" align="center">
					<a href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php" type="button" style="height:47px" class="btn btn-success btn-block border border-light btn-sm border-2"><h4><small>Popis knjiga</small></h4></a>
				</div>
				<div class="col-6 user-dropdown text-center" align="center">
					<div class="dropdown">
						<button type="button" class="btn btn-success dropdown-toggle btn-block border border-light rounded border-2" data-toggle="dropdown">
							<h4><small>Žanrovi</small></h4>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=drama"><h5><small>Drama</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=enciklopedistika"><h5><small>Enciklopedistika</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=fantastika"><h5><small>Fantastika</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=humoristika"><h5><small>Humoristični romani</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=krimi"><h5><small>Kriminalistični romani</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=putopis"><h5><small>Putopis</small></h5></a>
							<a class="dropdown-item" href="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php?zanr=scifi"><h5><small>Znanstvena fantastika</small></h5></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			<form  class="needs-validation" action="https://knjiznica-mihaela.herokuapp.com/popis_knjiga.php" method="post" novalidate>
				<div class="input-group mb-3 col-12">
					<input type="text" style="width:478px" class="form-control form-control-lg" name="search" placeholder="Pretraži..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
					<div class="input-group-append">
						<select class="btn-lg btn-success btn-block border border-light rounded border-2 centrirano" name="mog" style="width:235px" align="center" required>
							<option value=""><h4>Odaberite</h4></option>
							<option value="autor"><h4>Autor</h4></option>
							<option value="naslov"><h4>Naslov</h4></option>
						</select>
					</div>
					<div class="input-group-append">
						<button class="btn btn-success btn-block btn-sm border border-light rounded border-2" style="width:235px" type="submit" name="submit"><h4><small>Pretraži</small></h4></button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
