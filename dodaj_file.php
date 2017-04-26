<?php
include('autorizacija.php');
?>
<html>
<head>
<title>AlgebraBox dodaj file</title>
<?php include('bootstrap.php') ?>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<h2>AlgebraBox</h2>
			<h3>Dodaj novu datoteku</h3>
		</div>
	</div>
	<div class="row" style="padding-top: 50px">
		<div class="col-md-6 col-md-offset-2">
			<form action="upload_file.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="datoteka"> </br></br>
				<button class="btn btn-default" type="submit">Dodaj file</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>