<?php 
include('baza.php');
include('autorizacija.php');

if(!isset($_GET['file_id']) || strlen($_GET['file_id']) == 0)
{
	header('Location: popis_fileova.php');
	exit;
}

$id = $_GET['file_id'];

$query = "SELECT naziv FROM datoteke WHERE id = $id";
$result = $mysqli->query($query);

if($result) 
{
	$row = $result->fetch_assoc();
	$nazivDatoteke = $row['naziv'];
	
	$query = "DELETE FROM datoteke WHERE id = $id";
	$mysqli->query($query);
	
	if($mysqli->affected_rows == 1)
	{
		unlink("./podaci/$nazivDatoteke");
		
	}
	
}

header('Location: popis_datoteka.php');




	
?>