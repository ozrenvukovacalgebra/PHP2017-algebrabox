<?php 
include('baza.php');
include('autorizacija.php');

if(!isset($_POST['file_id']) || strlen($_POST['file_id']) == 0)
{
	header('Location: popis_fileova.php');
	exit;
}

$id = $_POST['file_id'];
$noviNaziv = $_POST['naziv_datoteke'];

$query = "SELECT naziv FROM datoteke WHERE id = $id";
$result = $mysqli->query($query);

if($result) 
{
	$row = $result->fetch_assoc();
	$nazivDatoteke = $row['naziv'];
	
	$query = "UPDATE datoteke SET naziv = '$noviNaziv' WHERE id = $id";
	$mysqli->query($query);
	
	if($mysqli->affected_rows == 1)
	{
		rename("./podaci/$nazivDatoteke", "./podaci/$noviNaziv");
	}
	
}

header('Location: popis_datoteka.php');




	
?>