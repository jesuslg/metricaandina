<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
	include_once "ClearPar.php";
	$clear_par = new ClearPar();
?>
<h3>Problema 3</h3>
<?php
	$entrada = "((()" ;
	echo $clear_par->build($entrada);
  ?>
</body>
</html>