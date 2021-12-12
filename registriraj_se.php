<?php
	include_once 'navbar.php';
?>

<html>
<head>
	<title>Registracija</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="registriraj_se.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 bg-dark text-white border border-light rounded border-2 px-2 py-2" align="center">
			<h1><small>Registrirajte se</small></h1><br/>
			<form class="needs-validation" action="registriraj_se_inc.php" method="post" novalidate>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="name" placeholder="Ime i prezime..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="email" class="form-control" name="email" placeholder="Email..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="username" placeholder="Korisničko ime..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="pwd" placeholder="Lozinka..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="pwdRepeat" placeholder="Ponovite lozinku..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="admin" value="1" required>Administrator
						</label>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="admin" value="2" required>Obični korisnik
						</label>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<button class="btn btn-success btn-block btn-sm border border-light rounded border-2" type="submit" name="submit"><h4><small>Registracija</small></h4></button>
				</div>
				<div class="col-sm-2"></div>
			</div>
			</form>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php
	if(isset($_GET["error"])){
		if($_GET["error"] == "invaliduid"){
			echo '<script>alert("Korisničko ime ima nevaljane znakove.")</script>';
		}
		if($_GET["error"] == "passwordsdontmatch"){
			echo '<script>alert("Lozinke se ne podudaraju!")</script>';
		}
		if($_GET["error"] == "usernametaken"){
			echo '<script>alert("Korisničko ime je zauzeto!")</script>';
		}
		if($_GET["error"] == "stmtfailed"){
			echo '<script>alert("Nešto je pošlo po zlu, probajte ponovno.")</script>';
		}
		if($_GET["error"] == "none"){
			echo '<script>alert("Uspješno ste upisani!")</script>';
		}
	}
?>

</body>
</html>