<?php
	include_once 'navbar.php';
?>

<html>
<head>
	<title>Vračanje knjiga</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="vracanje.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 bg-dark text-white border border-light rounded border-2 px-2 py-2" align="center">
			<h1><small>Vratite knjigu</small></h1><br/>
			<form class="needs-validation" action="vracanjeinc.php" method="post" novalidate>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="number" class="form-control" name="idkorisnika" placeholder="ID korisnika..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<input type="number" class="form-control" name="idknjige" placeholder="ID knjige..." required>
					<div class="valid-feedback"></div>
					<div class="invalid-feedback">Molim ispunite polje.</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row pb-2" align="center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<button class="btn btn-success btn-block btn-sm border border-light rounded border-2" type="submit" name="submit"><h4><small>Vrati knjigu</small></h4></button>
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
		if($_GET["error"] == "nepostoji"){
			echo "<script>alert('Ovaj upit ne postoji u bazi podataka!')</script>";
		}
	}
	if(isset($_GET["error"])){
		if($_GET["error"] == "none"){
			echo "<script>alert('Uspješno ste vratili knjigu!')</script>";
		}
	}
	if(isset($_GET["error"])){
		if($_GET["error"] == "yes"){
			echo "<script>alert('Došlo je do greške, pokušajte ponovno!')</script>";
		}
	}
?>

</body>
</html>