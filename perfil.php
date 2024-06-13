<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>Perfil.php</title>
</head>

<body>
    <?php include "header.php";
    $perfil = $_GET["perfil"]; //Cogemos de la url el perfil
    $usuarios = crearUsuarios(); //Creamosobjetos usuario
    foreach ($usuarios as $usuario) {
        if ($usuario->usuario === $perfil) { //Buscamos el usuario que coincida con el perfil
            break;
        }
    }
    ?>
    <div id="tablaPerfil">
        <table class="tablaUsuario" >
            <thead>
                <tr>
                    <th colspan="2"><?php echo $usuario->getUsuario(); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td><?php echo $usuario->getUsuario(); ?></td>
                </tr>
                <tr>
                    <td><strong>Género:</strong></td>
                    <td><?php echo $usuario->getGenero(); ?></td>
                </tr>
                <tr>
                    <td><strong>Nacimiento:</strong></td>
                    <td><?php echo $usuario->getNacimiento(); ?></td>
                </tr>
            </tbody>
        </table>
        <div class="contenedorBoton">
        <a class="boton" href="biblioteca.php?usuarioID=<?php echo $usuario->getID(); ?>">Visitar biblioteca</a>
        </div>
    </div>
</body>

</html>