<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>
	<!--index.php: contiene el sistema de acceso a la aplicación mediante el nombre de usuario y su dirección de correo electrónico. 
	En este fichero se deberá comprobar qué tipo de usuario es y permitir el acceso a la aplicación.-->
	<?php
		include "consultas.php";
	?>

	<form action="index.php" method="POST">
		<p><label for="usuario">Usuario: </label><input type ="text" name="usuario"></p>
		<p><label for="correo">Correo: </label><input type ="email" name="correo"></p>
		<p><input type="submit" value ="Entrar" name="Entrar"></p>
	</form>
	<?php
		if (isset($_POST['Entrar'])) {

			$nombre = $_POST['usuario'];
			$correo = $_POST['correo'];
			
			$userTipo = tipoUsuario($nombre, $correo);
			setcookie("datosUsuario", $userTipo, time()+200);

			switch ($userTipo) {
				case 'superadmin':
					echo "Bienvenido " . $nombre . ". Pulsa <a href='usuarios.php'>AQUÍ</a> para entrar al panel de usuarios. ";
					break;
				case 'autorizado':
					echo "Bienvenido " . $nombre . ". Pulsa <a href='articulos.php'>AQUÍ</a> para entrar al panel de articulos. ";
					break;
				case 'registrado':
					echo "Bienvenido " . $nombre . ". No tiene los permisos para acceder. ";
					break;
				default:
					echo "El usuario no está registrado en el sistema. ";
					break;
			}
		}
	?>
	
</body>
</html>