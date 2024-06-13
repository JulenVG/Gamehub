<?php
//Funcion que crea los objetos de la clase Juego
function crearJuegos(){
	$DB = crearConexion();
	$sql = "SELECT * FROM juegos ORDER BY Nombre ASC"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	$juegos = array();

	if (mysqli_num_rows($result) > 0){
		while($fila = mysqli_fetch_assoc($result)){
			$valoraciones = crearValoraciones($fila['ID']); //Se crean también todas las valoraciones de ese juego en concreto
			$juego = new Juego($fila['ID'], $fila['Nombre'], $fila['img'], $fila['Descripcion'], $fila['Genero'], '','', $valoraciones);
			$juegos[] = $juego;
		}
	}
    cerrarConexion($DB);
	return $juegos;
}

//Esta función se encarga de crear todos los objetos valoración del juego con el ID que se pasa
function crearValoraciones($id){
	$DB = crearConexion();
	$sql = "SELECT * FROM valoraciones WHERE JuegosID = '$id'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	$valoraciones = array();
	$usuarios = crearUsuarios(); //Además se crean los objeto usuarios
	if (mysqli_num_rows($result) > 0){
		while($fila = mysqli_fetch_assoc($result)){
			$usuario = obtenerUsuario($fila['UsuariosID'],$usuarios); //Filtra el array de objetos para que sólo quede el usuario que hizo la valoración

	    	$valoracion = new Valoracion($usuario, $fila['Nota'], $fila['Comentario'] );
			$valoraciones[] = $valoracion;
		}
	}
    cerrarConexion($DB);
	return $valoraciones;
}

//Función que se encarga de filtar un array de usuarios y devuelve el que coincida con el ID pasado
function obtenerUsuario($id, $usuarios){
	foreach($usuarios as $usuario){
		if($usuario->getID() == $id) return $usuario;
	}
}

//Función que se encarga de filtar un array de juegos y devuelve el que coincida con el ID pasado
function obtenerJuego($id, $juegos){
	foreach($juegos as $juego){
		if($juego->getID() == $id) return $juego;
	}
}

//Funcion que se encarga de meter en la BD un nuevo juego
function crearJuego($nombre, $descripcion, $generoJueg, $img){
	$DB = crearConexion();
	$extension = pathinfo($img['name'], PATHINFO_EXTENSION); //Obtenemos la extensión de la imagen (jpg, png, etc..)
	$nombreFiltrado  = str_replace(' ', '', $nombre); // Le quitamos los espacios al nombre del juego
	$nombreFiltrado = preg_replace('/[^a-zA-Z0-9]/', '', $nombreFiltrado); // Quitamos todos los carácteres especiales al nombre del juego
	$imagen = $nombreFiltrado . "-portada." . $extension; //Establecemos el nombre del archivo

	move_uploaded_file($img["tmp_name"], "img/$imagen"); //Movemos la imagen de la carpeta temporal a la del proyecto
	$nombre = mysqli_real_escape_string($DB, $nombre);
	$descripcion = mysqli_real_escape_string($DB, $descripcion);
	
	//Verificamos que no exista ya el juego en la BD
	if ((mysqli_num_rows(mysqli_query($DB,"SELECT Nombre FROM juegos WHERE Nombre = '$nombre'"))) > 0){
		echo "<script>alert('Juego ya registrado');</script>";
	}else{
		$sql = "INSERT INTO juegos (Nombre, Descripcion, Genero, img) 
		VALUES ('$nombre', '$descripcion', '$generoJueg', '$imagen')"; //Consulta SQL
		$result = mysqli_query($DB, $sql);
		if ($result !== false) {
			// La consulta se ejecutó con éxito
            cerrarConexion($DB);
			echo "<script>window.location.href = 'catalogo.php';</script>";
		} else {
			// La consulta falló
            cerrarConexion($DB);
			echo "Error en la consulta: " . mysqli_error($DB);
		}
	}
}

//Funcion que calcula la nota media que tiene un juego
function notaMedia($id){
	$DB = crearConexion();
	$sql = "SELECT AVG(Nota) AS NotaMedia FROM valoraciones WHERE JuegosID = '$id'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
    if ($result !== false) {
        // La consulta se ejecutó con éxito
        $fila = mysqli_fetch_assoc($result);
        $notaMedia = $fila["NotaMedia"];
        cerrarConexion($DB);

		//En caso de que el juego tenga decimales los redondeamos, en caso de que no los tenga los quitamos para que no salgan ceros
		if ($notaMedia !== null) {
            if(intval($notaMedia) == floatval($notaMedia)){
                return intval($notaMedia);
            }else{
            	return number_format($notaMedia, 2);
            }
		} else {
			return "N/A"; //En caso de que el juego no tenga ninguna nota retornamos "N/A"
		}    
	} else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
        
    }        
}

//Funcion que se encarga de ordenar la lista de juegos segun su nota media y su cantidad de votos para asi conseguir el Ranking Global de juegos
function ranking($nombre){
	$DB = crearConexion();
	$sql = "SELECT juegos.Nombre AS nombre_juego, AVG(valoraciones.Nota) AS nota_media, COUNT(valoraciones.JuegosID) AS total_votos
	FROM juegos
	INNER JOIN valoraciones ON juegos.ID = valoraciones.JuegosID
	GROUP BY juegos.ID
	ORDER BY AVG(valoraciones.Nota) DESC, COUNT(valoraciones.JuegosID) DESC;"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
	if ($result !== false) {
        // La consulta se ejecutó con éxito
		if (mysqli_num_rows($result) > 0){
			$puesto = 1;
			while($fila = mysqli_fetch_assoc($result)){
				if ($fila['nombre_juego'] == $nombre){
					cerrarConexion($DB);
					return $puesto;
				}
				$puesto++;
			}
		}
	} else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
    } 
}

//Funcion que se encarga de decirnos si el usuario logueado ya tiene el juego añadido en su biblioteca
function anadido($idJuego, $idUsuario){
    $DB = crearConexion();
	$sql = "SELECT * FROM usuarios_juegos WHERE UsuariosID = '$idUsuario' and JuegosID = '$idJuego'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
    if ($result !== false) {
        // La consulta se ejecutó con éxito
        cerrarConexion($DB);
		if (mysqli_num_rows($result) > 0){
			return true;
		} else {
			return false;
		}    
	} else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
        
    } 
}

//Función que se encarga de actualizar los datos de la tabla juegos
function editarFicha($nombre, $descripcion, $generoJueg, $img, $idJuego){
	$DB = crearConexion();
	$nombre = mysqli_real_escape_string($DB, $nombre);
	$descripcion = mysqli_real_escape_string($DB, $descripcion);

	//En caso de que la protada no haya sido modificada se actualizan el resto de campos
	if($img == "noFoto"){
		$sql = "UPDATE juegos SET Nombre = '$nombre', Descripcion = '$descripcion', Genero = '$generoJueg' WHERE ID = '$idJuego'"; //Consulta SQL
		$result = mysqli_query($DB, $sql);
		cerrarConexion($DB);
		echo "<script>window.location.href = 'ficha.php?idJuego=".$idJuego."';</script>";
	
	//En caso de que la portada sea modificada realizamos el mismo procedimiento que en crearJuego()
	}else{
		$extension = pathinfo($img['name'], PATHINFO_EXTENSION);
		$nombreFiltrado  = str_replace(' ', '', $nombre);
		$nombreFiltrado = preg_replace('/[^a-zA-Z]/', '', $nombreFiltrado);
		$imagen = $nombreFiltrado . "-portada." . $extension;
		move_uploaded_file($img["tmp_name"], "img/$imagen");

		$sql = "UPDATE juegos SET Nombre = '$nombre', Descripcion = '$descripcion', Genero = '$generoJueg', img = '$imagen' WHERE ID = '$idJuego'"; //Consulta SQL
		$result = mysqli_query($DB, $sql);
		cerrarConexion($DB);
		echo "<script>window.location.href = 'ficha.php?idJuego=".$idJuego."';</script>";

	}
}

//Esta función elimina un juego de la base de datos
function borrarJuego($idJuego, $img){
	$DB = crearConexion();
	$sql = "DELETE FROM juegos WHERE ID = '$idJuego'"; //Consulta SQL
	$ruta = "img/$img";

	//Verificamos que el juego tenga portada
	if(file_exists($ruta)){
		unlink($ruta); //Eliminamos la portada de la carpeta img
	}else echo "algo pasa";
	$result = mysqli_query($DB, $sql);
	cerrarConexion($DB);
	echo "<script>window.location.href = 'catalogo.php';</script>";

}
?>