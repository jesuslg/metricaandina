<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
	include_once "ChangeString.php";
	$change_string = new ChangeString();
?>
<h3>Problema 1</h3>
<?php $entrada = "123 abcd*3"  ?>
<?php echo $change_string->build($entrada) ?>
</body>
</html>
