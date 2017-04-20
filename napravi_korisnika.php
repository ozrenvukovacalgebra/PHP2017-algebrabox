<?php 
include('baza.php');

if(isset($_POST['submit']))
{
	if(strlen($_POST['username']) <= 3 || strlen($_POST['password']) <= 3
		|| strlen($_POST['ime']) <= 3 || strlen($_POST['prezime']) <= 3) 
	{
		echo 'Niste unijeli sva polja';
	}
	else
	{
		$emailValidation = preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $_POST['username']);
		if($emailValidation)
		{
			$username = $_POST['username'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];
			
			//provjera korisnika
			$query = "SELECT * FROM korisnici WHERE username = '$username'";
			$result = $mysqli->query($query);
			if($result->num_rows > 0) 
			{
				exit('Korisnik postoji');
			}
			
			//unos korisnika
			$query = "INSERT INTO korisnici(username, password, ime, prezime)
			VALUES('$username', '$password', '$ime', '$prezime')";
			$mysqli->query($query);
			if($mysqli->affected_rows == 1)
			{
				echo 'Korisnik unesen.';
			}
			else
			{
				echo 'Došlo je do pogreške';
			}
		}
		else
		{
			echo 'Neispravan email';
		}
		
		
		
	}
}



?>