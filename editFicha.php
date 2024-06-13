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
    $juegos = crearJuegos();
    foreach ($juegos as $juego) {
        if ($juego->id === $idJuego) { //Obtenemos el objeto juego que coincide con el ID
            $juegos = $juego;
            break;
        }
    }

    //Redirección en caso de que un usuario no logueado intente escribir la url a mano
    if($logged == false){
        echo  "<script>window.location.href = 'index.php';</script>";
    }
    ?>
    <div class="containerEditFicha">
        <div id="modal4" class="editFicha">
            <h2>Editar ficha</h2>
            <form method="POST" class="formJuego" enctype="multipart/form-data">
                <p>
                    <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" required
                        value="<?php echo $juego->getNombre();?>" />
                </p>
                <p>
                    <label for="descripcion">Descripción: </label><input type="text" name="descripcion" id="descripcion"
                        required value="<?php echo $juego->getDescripcion();?>" />
                </p>
                <p>
                    <label for="generoJueg">Selecciona un género:</label>
                    <select id="generoJueg" name="generoJueg">
                        <?php
                        $opciones = array("Acción", "Disparos", "Estrategia", "Simulación", "Deporte", "Carreras", "Aventura", "Rol");
                        foreach ($opciones as $opcion){
                            if($juego->getGenero() == $opcion){
                                echo "<option value='$opcion' selected>$opcion</option>";
                            }else{
                                echo "<option value='$opcion'>$opcion</option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="img">Portada: </label>
                    <input type="file" name="img" id="img" />
                </p>
                <p><input type="submit" name="guardarJuego" value="Guardar" /></p>
            </form>
            <p><button id="borrarCuenta" class="btnBorrarFicha">Borrar</button></p>
            <dialog id="modal3">
                <h2>¿Estás seguro de que quieres eliminar este juego?</h2>
                <form method="POST">
                    <button id="rechazarBorrar">Cancelar</button>
                    <input type="submit" name="aceptarBorrar" value="Borrar" />
                </form>
            </dialog>
        </div>
    </div>
</body>

</html>
<?php 
    if (!empty($_POST["guardarJuego"])){
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $generoJueg = $_POST["generoJueg"];
        if($_FILES["img"]["error"] === 0){
            $img = $_FILES["img"];
        }else $img = "noFoto";
        

        editarFicha($nombre, $descripcion, $generoJueg, $img, $idJuego);
      }

  if(!empty($_POST["aceptarBorrar"])){
    $img = $juego->getImg();
    borrarJuego($idJuego,$img);
  }
?>