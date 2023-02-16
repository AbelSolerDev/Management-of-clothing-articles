<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body>
	<?php 
			include "funciones.php";
	?>

	<?php 
			if (!isset($_COOKIE['datosUsuario']) or ($_COOKIE['datosUsuario'] != "superadmin")) {
				echo "No tienes permisos para acceder.";
			} else {
				if (isset($_GET['Cambiar'])) {
					cambiarPermisos();
				}
	?>

			<p>Los permisos actuales están a 
				<span><?php echo getPermisos(); ?></span>
			</p>

			<form action="usuarios.php" action="GET">
				<p><input type="submit" name="Cambiar" value="Cambiar permisos"></p>
			</form>

	<?php

				pintaTablaUsuarios();
			}	
	?>

			<a href="index.php">Volver</a>


</body>
</html>