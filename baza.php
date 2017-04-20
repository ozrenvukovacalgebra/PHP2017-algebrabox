<?php 
$mysqli = new mysqli('localhost', 'root', '', 'algebrabox'); 
$mysqli->set_charset("utf8");

if(mysqli_connect_errno())
{
	echo 'Došlo je do pogreške';
	//echo mysqli_connect_error();
	exit;
}
?>