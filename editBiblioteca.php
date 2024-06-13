<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>editFicha.php</title>
</head>

<body>
    <?php include "header.php"; 
    $idJuego = $_GET["idJuego"]; //Cogemos de la url el ID del juego
    $idUsuario = $_GET["idUsuario"]; //Cogemos de la url el ID del usuario
    $biblioteca = crearBiblioteca($idUsuario); //Creamos el objeto biblioteca del usuario con el ID
    $juegos = $biblioteca->getJuegos();//Obtenemos los juegos del usuario
    $usuario = $biblioteca->getUsuario(); //Obtenemos el dueño de la biblioteca
    foreach ($juegos as $juego) {
        if ($juego->id === $idJuego) {
            $juegos = $juego;
            break;
        }
    }

    //Redirección en caso de que un usuario no logueado intente escribir la url a mano
    if($logged == false){
        echo  "<script>window.location.href = 'index.php';</script>";
    }
    //Formulario de edición
    echo "
    <div class='containerEditFicha'>
    <div id='modal4' class='editFicha'>
        <h2>".$juego->getNombre()."</h2>
        <form method='post' class='formJuego'>
                <input type='hidden' name='idJuego' value='" .  $juego->getID() . "'>
                <div class='containerPlataformaNota'>
                <p>
                    <label for='plataforma'>Plataforma:</label>
                    <select id='plataforma' name='plataforma'>";
                        $opciones = array('Steam', 'Origin', 'Epic Games', 'GoG', 'Ubisoft', 'Xbox Store PC', 'Switch',
                        'Itch.io', 'Battle.net', 'Bethesda Launcher', 'Físico');
                        echo "<option value=' '>Seleccionar Plataforma</option>";
                        foreach ($opciones as $opcion){
                        if($juego->getPlataforma() == $opcion){
                        echo "<option value='$opcion' selected>$opcion</option>";
                        }else{
                        echo "<option value='$opcion'>$opcion</option>";
                        }
                        }
                        echo "</select>
                </p>
                <p>
                    <label for='estado'>Estado:</label>
                    <select id='estado' name='estado'>";
                        $opciones = array('Completado', 'Abandonado', 'Intención de jugar', 'Actualmente jugando');
                        echo "<option value=''>Seleccionar Estado</option>";
                        foreach ($opciones as $opcion){
                        if($juego->getEstado() == $opcion){
                        echo "<option value='$opcion' selected>$opcion</option>";
                        }else{
                        echo "<option value='$opcion'>$opcion</option>";
                        }
                        }
                        echo "</select>
                </p>
                <p>
                    <label for='nota'>Nota:</label>
                    <select id='nota' name='nota'>";
                        $opciones = array('N/A', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
                        foreach ($opciones as $opcion){
                        if($juego->getValoraciones()->getNota() == $opcion){
                        echo "<option value='$opcion' selected>$opcion</option>";
                        }else{
                        echo "<option value='$opcion'>$opcion</option>";
                        }
                        }
                        echo "</select>
                </p>
                </div>
                <p>
                <label for='comentario'>Comentario:</label>
                <input type='text' name='comentario' value='".$juego->getValoraciones()->getComentario()."'>
                </p>
                <p>
                <input type='submit' name='editarBiblioteca' value='Guardar'>
                </p>
        </form>
        </div>
    </div>";
    ?>
</body>

</html>
<?php 
if (!empty($_POST["editarBiblioteca"])){
    $idJuego = $_POST["idJuego"];
    $idUsuario = $usuarioLog->getID();
    $plataforma = $_POST["plataforma"];
    $estado = $_POST["estado"];
    $nota = $_POST["nota"];
    $comentario = $_POST["comentario"];

    editarBiblioteca($idJuego, $idUsuario, $plataforma, $estado, $nota, $comentario);
  }
?>