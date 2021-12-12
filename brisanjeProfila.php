<?php
	include_once 'navbar.php';
?>

<html>
<head>
	<title>Brisanje profila</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="brisanjeProfila.css">
</head>

<body>
<div style="background: url(https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg)" class="page-holder bg-cover">
	<div class="h-100 row align-items-center">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 bg-dark text-white border border-light rounded border-2 px-2 py-2" align="center">
			<h3>Jeste li sigurni da želite trajno obrisati Vaš profil? Kasnije ga ne možete vratiti.</h3>
			<div class="input-group justify-content-center">
			<a href='delete.php'><button class='btn btn-success btn-block border border-light rounded border-2 inline mr-2' style='width:150px'>U redu</button></a>
			<a href='profil.php'><button class='btn btn-success btn-block border border-light rounded border-2 inline ml-2' style='width:150px'>Odustani</button></a>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>
</body>