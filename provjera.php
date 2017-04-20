<?php 
include('baza.php');
session_start();

if(isset($_POST['submit']))
{
	if(strlen($_POST['username']) == 0 || strlen($_POST['password']) == 0) 
	{
		echo 'Niste unijeli sva polja';
	}
	else
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT password FROM korisnici WHERE username = '$username'";
		$result = $mysqli->query($query);
		$userOk = false;
		
		if($result -> num_rows == 1) 
		{
			$row = $result->fetch_assoc();
			$passwordHash = $row['password'];
		
			$provjera = password_verify($password, $passwordHash);
			
			if($provjera)
			{
				$_SESSION['logiran'] = true;
				$_SESSION['username'] = $username;
				$userOk = true;
			}
		}
		
		if($userOk)
		{
			header('Location: popis_datoteka.php');
		}
		else{
			header('Location: prijava.html');	
		}

		
	}
}



?>