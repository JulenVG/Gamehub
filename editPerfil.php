<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>editPerfil.php</title>
</head>

<body>
    <?php include "header.php"; ?>
    <div id="editarPerfil">
        <h1> <?php echo $usuarioLog->getUsuario(); ?> </h1>
        <form method="POST" class="editarDatos">
            <input type="hidden" name="perfil" value="<?php echo $usuarioLog->getUsuario(); ?>">
            <p>
                <label for="email">Email: </label><input type="email" name="email" id="email" required
                    value="<?php echo $usuarioLog->getEmail(); ?>" />
            </p>
            <p>
                <label for="usuarioLog">Usuario: </label><input type="text" name="usuarioLog" id="usuarioLog" required
                    value="<?php echo $usuarioLog->getUsuario(); ?>" />
            </p>
            <p>
                <label for="contra">Contraseña actual: </label><input type="password" name="contra" id="oldContra"
                    placeholder="Introduce la contraseña actual" value="<?php echo $usuarioLog->getContra(); ?>" />
            </p>
            <p>
                <label for="genero">Género: </label>
                <select id="genero" name="genero">
                    <?php 
                        switch ($usuarioLog->getGenero()) {
                        case "ninguno":
                            echo "
                                <option value='ninguno' selected>Ninguno</option>
                                <option value='hombre'>Hombre</option>
                                <option value='mujer'>Mujer</option>";
                            break;
                        case "hombre":
                            echo "
                                <option value='ninguno'>Ninguno</option>
                                <option value='hombre' selected>Hombre</option>
                                <option value='mujer'>Mujer</option>";
                            break;
                        case "mujer":
                            echo "
                                <option value='ninguno'>Ninguno</option>
                                <option value='hombre'>Hombre</option>
                                <option value='mujer' selected>Mujer</option>";
                            break;
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="nacimiento">Fecha de nacimiento: </label><input type="date" name="nacimiento"
                    id="nacimiento" required value="<?php echo $usuarioLog->getNacimiento(); ?>" />
            </p>
            <p><input type="submit" name="guardar" value="Guardar" /></p>
            <p><?php 
            if(isset($_GET["consulta"])){
                if($_GET["consulta"] == "exito"){
                    echo "<alert id=exito>Cambios realizados con éxito</alert>";
                }else if($_GET["consulta"] == "error"){
                echo "<alert id=error>Ha ocurrido un error</alert>";
                }
            } 
            ?>
            </p>
        </form>
        <p><button id="borrarCuenta">Borrar cuenta</button></p>
        <dialog id="modal3">
                <h1>¿Estás seguro de que quieres eliminar esta cuenta?</h1>
                <form method="POST">
                    <button id="rechazarBorrar">Cancelar</button>
                    <input type="submit" name="aceptarBorrar" value="Borrar" /> 

                </form>
        </dialog>
    </div>
</body>

</html>
<?php 
  if (!empty($_POST["guardar"])){
    $email = $_POST["email"];
    $usuarioF = $_POST["usuarioLog"];
    $contra= $_POST["contra"];
    $genero = $_POST["genero"];
    $nacimiento = $_POST["nacimiento"];
    $oldUser = $usuarioLog->getUsuario();
    $id = $usuarioLog->getID();
   editarDatos($email, $usuarioF, $contra, $genero, $nacimiento, $oldUser, $id);
  }
  if(!empty($_POST["aceptarBorrar"])){
    $usuario = $usuarioLog->getUsuario();
    borrarCuenta($usuario);
  }
?>