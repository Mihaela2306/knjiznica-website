<?php
	include_once 'navbar.php';
?>

<html>
<head>
	<title>Dodajte knjigu</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dodaj_knjigu.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 bg-dark text-white border border-light rounded border-2 px-2 py-2 mt-5" align="center">
			<h1><small>Dodajte knjigu</small></h1><br/>
			<form class="needs-validation" action="dodaj_knjigu_inc.php" method="post" novalidate>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="name" placeholder="Ime knjige..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="author" placeholder="Autor..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="year" placeholder="Godina izdanja..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="genre" placeholder="Žanr..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="nakladnik" placeholder="Nakladnik..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="language" placeholder="Jezik..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="brPrimjeraka" placeholder="Broj dostupnih primjeraka..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<textarea class="form-control" name="opis" placeholder="Opis..." rows="3" required></textarea>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8 custom-file">
						<input type="text" class="form-control" name="picture" placeholder="Slika..." required>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Molim ispunite polje.</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="row pb-2" align="center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<button class="btn btn-success btn-block btn-sm border border-light rounded border-2" type="submit" name="submit"><h4><small>Dodaj knjigu</small></h4></button>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</form>
		</div>
		<div class="col-sm-2"></div>
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

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<?php
	if(isset($_GET["error"])){
		if($_GET["error"] == "none"){
			echo "<script>alert('Uspješno ste dodali knjigu!')</script>";
		}
	}
?>

</body>
</html>