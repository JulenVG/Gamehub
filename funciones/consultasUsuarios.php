<?php 
//Funcion que crea los objetos de la clase Usuario
function crearUsuarios(){
	$DB = crearConexion();
	$sql = "SELECT * FROM usuarios ORDER BY Usuario ASC"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	$usuarios = array();

	if (mysqli_num_rows($result) > 0){
		while($fila = mysqli_fetch_assoc($result)){
	    $usuario = new Usuario($fila['ID'], $fila['Email'], $fila['Usuario'], $fila['Contra'], $fila['Sexo'], $fila['Nacimiento'], );
		$usuarios[] = $usuario;
		}
	}
	cerrarConexion($DB);
	return $usuarios;
}

//Funcion que se encarga de meter en la BD las credenciales de un nuevo usuario
function crearUsuario($email, $usuario, $contra, $genero, $nacimiento){
	$DB = crearConexion();

	//Comprobamos que el usuario no esté registrado
	if ((mysqli_num_rows(mysqli_query($DB,"SELECT Usuario FROM usuarios WHERE Usuario = '$usuario'"))) > 0){
		cerrarConexion($DB);
		echo "<script>alert('Usuario ya registrado');</script>";
	//Comprobamos que el mail no esté registrado
	}elseif ((mysqli_num_rows(mysqli_query($DB,"SELECT Email FROM usuarios WHERE Email = '$email'"))) > 0){
		cerrarConexion($DB);
		echo "<script>alert('Correo ya registrado');</script>";
	}else{
		$sql = "INSERT INTO usuarios (Email, Usuario, Contra, Sexo, Nacimiento) VALUES ('$email', '$usuario', '$contra', '$genero', '$nacimiento')"; //Consulta SQL
		$result = mysqli_query($DB, $sql);
		if ($result !== false) {
			// La consulta se ejecutó con éxito
			cerrarConexion($DB);
			echo "<script>alert('Usuario registrado exitosamente');</script>";
		} else {
			// La consulta falló
			cerrarConexion($DB);
			echo "Error en la consulta: " . mysqli_error($DB);
		}
	}
}

//Funcion que se encarga de comprobar si las credenciales de un usuario son correctas al inciar sesión
function iniciarSesion($usuario, $contra){
	$DB = crearConexion();
	$sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario' AND Contra = '$contra'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);

	//En caso de que lo sean crea una cookie con la información del usuario
	if (mysqli_num_rows($result) > 0){
		// Log in existoso
		while($fila = mysqli_fetch_assoc($result)){
			$idLo = $fila["ID"];
			$emailLo = $fila["Email"];
			$usuarioLo = $fila["Usuario"];
			$contraLo = $fila["Contra"];
			$generoLo = $fila["Sexo"];
			$nacimientoLo = $fila["Nacimiento"];
		}
		$usuarioLog = new Usuario($idLo, $emailLo, $usuarioLo, $contraLo, $generoLo, $nacimientoLo); //Creamos un objeto usuario con todos los datos del usuario logueado
		$stringUsusario = serialize($usuarioLog); //Lo serializamos
		setcookie("user", $stringUsusario, time() + 5000, "/"); //Almacenamos el objeto serializado en una cookie para su posterior uso en la página
		cerrarConexion($DB);
		header("Location: {$_SERVER['PHP_SELF']}"); 
		exit();
	} else{
		cerrarConexion($DB);
		echo "<script>alert('Tu usuario o contraseña son erróneos');</script>";
	}
}

//Funcion que borra toda la información de un usuario de la BD
function borrarCuenta($usuario){
	$DB = crearConexion();
	$sql = "DELETE FROM usuarios WHERE Usuario = '$usuario'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	setcookie("user", $stringUsusario, time() - 5000, "/"); //Establecemos tiempo negativo a la cookie para borrarla
	cerrarConexion($DB);
	header("Location: index.php");
	exit();
}

//Funcion que edita en la BD la información de un usuario
function editarDatos($email, $usuario, $contra, $genero, $nacimiento,$oldUser, $id){
	$DB = crearConexion();
	$sql = "UPDATE usuarios SET Email = '$email', Usuario = '$usuario', Contra = '$contra', Sexo = '$genero', Nacimiento = '$nacimiento' WHERE Usuario = '$oldUser'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	if ($result !== false) {
		echo "<script>alert('Editado con éxito');</script>";
		$usuarioLog = new Usuario($id, $email, $usuario, $contra, $genero, $nacimiento);
		$stringUsusario = serialize($usuarioLog);
		setcookie("user", $stringUsusario, time() + 5000, "/"); //Actualizamos la cookie
		cerrarConexion($DB);
		header("Location: editPerfil.php?consulta=exito");
		exit();

	} else {
		cerrarConexion($DB);
		header("Location: editPerfil.php?consulta=error");
		exit();
	}
}


?>