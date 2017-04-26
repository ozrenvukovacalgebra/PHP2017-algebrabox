<?php 
include('baza.php');
include('autorizacija.php');

$username = $_SESSION['username'];

$query = "SELECT id FROM korisnici 
	WHERE korisnici.username = '$username'";
	
$result = $mysqli->query($query);
$_SESSION['upload'] = false;

if($result) 
{
	$row = $result->fetch_assoc();
	$idKorisnika = $row['id'];
	
	$datoteka = $_FILES['datoteka'];
	$uploadsDir = './podaci/';
	
	$ext = pathinfo($datoteka['name'], PATHINFO_EXTENSION);
	
	$nedozvoljeneDatoteke = ['exe','iso','bat'];

	if(!in_array($ext, $nedozvoljeneDatoteke))
	{
		$fileServer = $uploadsDir.$datoteka['name'];
		move_uploaded_file($datoteka['tmp_name'], $fileServer);
		
		$nazivDatoteke = $datoteka['name'];
	
		$query = "INSERT INTO datoteke(id_korisnika, naziv) 
			VALUES($idKorisnika, '$nazivDatoteke')";
		$mysqli->query($query);
		
		if($mysqli->affected_rows == 1)
		{
			$_SESSION['upload'] = true;
		}
		
		header('Location: popis_datoteka.php');
	}
	else
	{
		header('Location: dodaj_file.php');
	}

	
}




	
?>