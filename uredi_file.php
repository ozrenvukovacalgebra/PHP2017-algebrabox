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
}

?>
<html>
<body>
<h2>AlgebraBox</h2>
<h3>Uredi datoteku</h3>

<form action="spremi_file.php" method="POST">
  Novi naziv datoteke: <input type="text" name="naziv_datoteke" 
  value="<?php echo $nazivDatoteke; ?>"><br>
  <input type="hidden" name="file_id" value="<?php echo $id ?>"></br>
  <input type="submit" name="submit" value="Promijeni">
</form>

</body>
</html>