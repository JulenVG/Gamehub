<?php
//Esta función se encarga crear un objeto biblioteca
function crearBiblioteca($usuarioID){
    $DB = crearConexion();
	$sql = "SELECT * FROM usuarios_juegos WHERE UsuariosID = '$usuarioID'";
	$result = mysqli_query($DB, $sql); //Consulta SQL
    $juegosBiblioteca = array();
	$usuario = crearUsuarios(); //Creamos todos los objetos usuario
    $usuario = obtenerUsuario($usuarioID, $usuario); //Con esta función filtramos los usuarios y nos quedamos sólo con el que coincide con el ID
    $juegos = crearJuegos(); //Creamos todos los objetos juego
        
    if (mysqli_num_rows($result) > 0){
		while($fila = mysqli_fetch_assoc($result)){
            $juego = obtenerJuego($fila['JuegosID'], $juegos); //Con esta función filtramos todos los juegos que coincidan con el ID pasado por la consulta
            $valoraciones = $juego->getValoraciones();

            //Aquí le quitamos a los objetos juego todas las valoraciones que tienen menos las del usuario que estamos generando la biblioteca.
            // además le añadimos el estado y la plataforma que tiene el usuario en concreto con cada juego
            foreach($valoraciones as $valoracion){
                if($valoracion->getUsuario()->getID() == $usuarioID) break;
            }
            $juego->setValoraciones($valoracion);
            $juego->setEstado($fila['Estado']);
            $juego->setPlataforma($fila['Plataforma']);
			$juegosBiblioteca[] = $juego;
		}
        $biblioteca = new Biblioteca($usuario, $juegosBiblioteca);
	}
    cerrarConexion($DB);
	return $biblioteca;
}
//Función para agregar un juego a la biblioteca personal
function agregarBiblioteca($idJuego, $idUsuario, $plataforma, $estado, $nota, $comentario){
    $DB = crearConexion();
	$sql = "INSERT INTO usuarios_juegos (UsuariosID, JuegosID, Estado, Plataforma)
    VALUES ('$idUsuario', '$idJuego', '$estado', '$plataforma')"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
    if ($result !== false) {
        // La consulta se ejecutó con éxito
        if($nota == "N/A"){ //En caso de que la nota sea N/A se introduce en la BD un NULL en su lugar
            $sql = "INSERT INTO valoraciones (UsuariosID, JuegosID, Nota, Comentario) 
            VALUES ('$idUsuario', '$idJuego', NULL, '$comentario')"; //Consulta SQL
        }else{
            $sql = "INSERT INTO valoraciones (UsuariosID, JuegosID, Nota, Comentario) 
            VALUES ('$idUsuario', '$idJuego', '$nota', '$comentario')"; //Consulta SQL
        } 

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
    } else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
    }
}

//Esta función se encarga de actualizar los campos en la tabla "usuarios_juegos"
function editarBiblioteca($idJuego, $idUsuario, $plataforma, $estado, $nota, $comentario){
    $DB = crearConexion();
    $sql = "UPDATE usuarios_juegos SET Estado = '$estado', Plataforma = '$plataforma' WHERE UsuariosID = '$idUsuario' AND JuegosID = '$idJuego'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
    if ($result !== false) {
        // La consulta se ejecutó con éxito
        if($nota == "N/A"){ //En caso de que la nota sea N/A se introduce en la BD un NULL en su lugar
            $sql = "UPDATE valoraciones SET Nota = NULL, Comentario = '$comentario' WHERE UsuariosID = '$idUsuario' AND JuegosID = '$idJuego'"; //Consulta SQL
        }else{
            $sql = "UPDATE valoraciones SET Nota = '$nota', Comentario = '$comentario' WHERE UsuariosID = '$idUsuario' AND JuegosID = '$idJuego'"; //Consulta SQL
        } 

        $result = mysqli_query($DB, $sql);
        if ($result !== false) {
            // La consulta se ejecutó con éxito
            cerrarConexion($DB);
            echo "<script>window.location.href = 'biblioteca.php?usuarioID=".$idUsuario."';</script>";           
        } else {
            // La consulta falló
            cerrarConexion($DB);
            echo "Error en la consulta: " . mysqli_error($DB);
        }
    } else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
    }
}

//Esta función elimina un juego de la biblioteca de un usuario
function quitarBiblioteca($idJuego, $idUsuario, $pagina){
    $DB = crearConexion();
	$sql = "DELETE FROM valoraciones WHERE UsuariosID = '$idUsuario' and JuegosID = '$idJuego'"; //Consulta SQL
	$result = mysqli_query($DB, $sql);
    if ($result !== false) {
        // La consulta se ejecutó con éxito
        $sql = "DELETE FROM usuarios_juegos WHERE UsuariosID = '$idUsuario' and JuegosID = '$idJuego'"; //Consulta SQL
        $result = mysqli_query($DB, $sql);
        if ($result !== false) {
            // La consulta se ejecutó con éxito
            cerrarConexion($DB);
            if($pagina == "catalogo"){ //En caso de que eliminase el juego desde el catálogo le redirecciona allí, en caso contrario lo redirecciona a la biblioteca personal
                echo "<script>window.location.href = 'catalogo.php';</script>";
            }else echo "<script>window.location.href = 'biblioteca.php?usuarioID=".$idUsuario."';</script>";
        }else {
            // La consulta falló
            cerrarConexion($DB);
            echo "Error en la consulta: " . mysqli_error($DB);
        }
    }else {
        // La consulta falló
        cerrarConexion($DB);
        echo "Error en la consulta: " . mysqli_error($DB);
    }
}

//Esta función se encarga de pintar en la tabla de las bibliotecas el color correspondiente al estado de un juego
function estadoColor($estado){
    switch($estado){
        case("Completado"):
            return "style='background-color:#26448f'";
        case("Abandonado"):
            return "style='background-color:#a12f31'";
        case("Intención de jugar"):
            return "style='background-color:#c3c3c3'";
        case("Actualmente jugando"):
            return "style='background-color:#23B230'";
        default:
            return "style=''";           
    }
}
?>