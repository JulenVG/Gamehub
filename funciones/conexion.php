<?php 
	//Se establece conexión con la base de datos
	function crearConexion() {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "gamehub";

		$conexion = mysqli_connect($host,$user,$pass,$baseDatos);
		return $conexion;
	}
	//Cierra la conexión con la base de datos
	function cerrarConexion($conexion) {
		mysqli_close($conexion);
	}


?>