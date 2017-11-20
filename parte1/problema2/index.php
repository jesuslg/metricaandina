<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
	include_once "CompleteRange.php";
	$complete_range = new CompleteRange();
?>
<?php
	$entrada = array(2, 4, 9);
	print_r($complete_range->build($entrada));
  ?>
</body>
</html>