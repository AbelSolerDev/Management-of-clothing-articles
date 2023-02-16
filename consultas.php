<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$conexion = crearConexion();

		if(esSuperadmin($nombre, $correo)){
			return "superadmin";
		} else {
			$sql = "SELECT FullName, Email, Enabled FROM user WHERE FullName = '" . $nombre . "' and Email = '" . $correo . "'";

			$result = mysqli_query($conexion, $sql);
			cerrarConexion($conexion);

			if ($data = mysqli_fetch_array($result)) {
					if ($data["Enabled"] == 0){
						return "registrado";
					} else if ($data["Enabled"] == 1){
						return "autorizado";
					}
			} else {
				return "no registrado";
			}
		}
	}


	function esSuperadmin($nombre, $correo){
		$conexion = crearConexion();

		$sql = "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin
		WHERE user.FullName = '" . $nombre . "' and user.Email = '" . $correo . "'";

		// Hacemos la consulta y guardamos el resultado en $result
		$result = mysqli_query($conexion, $sql);

			if ($data = mysqli_fetch_array($result)) {
					return true;
			} else {
					return false;
			}
	}


	function getPermisos() {
		$conexion = crearConexion();

		$sql = "SELECT Autenticación FROM setup";
		$result = mysqli_fetch_assoc(mysqli_query($conexion, $sql));

		cerrarConexion($conexion);

		return $result["Autenticación"];
	}



	function cambiarPermisos() {
		$permisos = getPermisos();

		$conexion = crearConexion();

			if ($permisos == 1) {
				$sql = "UPDATE setup SET Autenticación = 0";
			} else if(($permisos == 0)) {
				$sql = "UPDATE setup SET Autenticación = 1";
			}

		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);
	}


	function getCategorias() {
		$conexion = crearConexion();

		$sql = "SELECT * FROM category";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}


	function getListaUsuarios() {
		$conexion = crearConexion();

		$sql = "SELECT FullName, Email, Enabled FROM user";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}


	function getProducto($ID) {
		$conexion = crearConexion();

		$sql = "SELECT * FROM product WHERE ProductID = $ID";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}


	function getProductos($orden) {
		$conexion = crearConexion();

		$sql = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name as Categoria FROM product INNER JOIN category WHERE product.CategoryID = category.CategoryID ORDER BY $orden";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();

		$sql = "INSERT INTO product (Name, Cost, Price, CategoryID) VALUES ('$nombre', $coste, $precio, $categoria)";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}





	
	function borrarProducto($id) {
		$conexion = crearConexion();
		
		$sql = "DELETE FROM product WHERE ProductID = $id";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();

		$sql = "UPDATE product SET Name = '$nombre', Cost = $coste, Price = $precio, CategoryID = $categoria WHERE ProductID = $id";
		$result = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		return $result;
	}

?>