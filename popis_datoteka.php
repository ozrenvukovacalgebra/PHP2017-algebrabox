<?php 
include('baza.php');
include('autorizacija.php');
?>
<html>
<head>
<title>AlgebraBox popis fileova</title>
<?php include('bootstrap.php') ?>
</head>
<body>
<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<h2>AlgebraBox</h2>
		<h3>Moje datoteke</h3>
	</div>
	<div class="col-md-3 col-md-offset-3" style="padding-top: 10px;">
		Prijavljeni ste kao: <?php echo $_SESSION['username']; ?>
	</div>
</div>
<div class="container-fluid">
<?php
$username = $_SESSION['username'];

$query = "SELECT datoteke.id as id, datoteke.naziv FROM datoteke 
	INNER JOIN korisnici 
	ON datoteke.id_korisnika = korisnici.id 
	WHERE korisnici.username = '$username'";
	
$result = $mysqli->query($query);

if($result) 
{
	echo '<div class="row">';
	echo '<div class="col-md-10 col-md-offset-1">';
	echo '<table  id="popis_datoteka" class="table table-striped table-hover">';
	echo '<tr><td></td><td>Naziv datoteke</td><td colspan="2">Operacija</td></tr>';
	while($row = $result->fetch_assoc())
	{
		$ext = pathinfo($row['naziv'], PATHINFO_EXTENSION);
		$fileimg = '';
		switch($ext)
		{
			case 'docx':
				$fileimg = '-word-o';
				break;
			case 'txt':
				$fileimg = '-text-o';
				break;
			case 'pdf':
				$fileimg = '-pdf-o';
				break;
			case 'ppt':
				$fileimg = '-powerpoint-o';
				break;
			case 'jpg':
			case 'jpeg':
			case 'png':
				$fileimg = '-picture-o';
				break;
			
		}
		echo "<tr>
		<td><i class='fa fa-file$fileimg' aria-hidden='true'></i></td>
		<td>{$row['naziv']}</td>
		<td><a id='brisi' href='brisi_file.php?file_id={$row['id']}'>Briši</a></td>
		<td><a id='uredi' href='uredi_file.php?file_id={$row['id']}'>Uredi</a></td>
		</tr>";
	}
	echo '</table>';
	echo '</div>';
	echo '</div>';
}
else
{
	echo $mysqli->error;
}
		
?>
<div class="row">
	<div class="col-md-10 col-md-offset-1 text-right">
		<a href="dodaj_file.php">Nova datoteka</a>
	</div>
</div>
</div>
<script>
$(document).ready(function() {
	$('#popis_datoteka').on('click', '#brisi', function(e){
		e.preventDefault();
		bootbox.confirm({
			message: "Da li ste sigurni da želite izbrisati datoteku?",
			buttons: {
				confirm: {
					label: 'Da',
					className: 'btn-success'
				},
				cancel: {
					label: 'Ne',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result) {
					//idi na link
					window.location = $('#brisi').attr("href")
				}
				else {
					//vrati se na popis datoteka
					window.location = 'popis_datoteka.php';
				}
				
			}
		});
	});
});
</script>
</body>
</html>