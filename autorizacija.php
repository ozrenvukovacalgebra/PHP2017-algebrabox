<?php 
session_start();
if(!isset($_SESSION['logiran']) || !$_SESSION['logiran'])
{
	header('Location: prijava_korisnika.html');
	exit();
}
?>