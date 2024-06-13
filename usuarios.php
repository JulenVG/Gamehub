<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="estilo.css">
	<title>Usuarios.php</title>
</head>
<body>
	<?php include_once "header.php";?>

    <div>
     <form action="" method="POST" class="formUser">
        <input type="text" name="usuario" id="inputUsuario" onkeyup="barraBusqueda()" placeholder="Busca usuarios.." />
    </form>
    </div>
    <div class="tabla">
        <table class='tablaUsuario' id='tablaUsuario'>
			<thead>
				<tr>
					<th>Usuarios</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    $usuarios = crearUsuarios();
                    foreach ($usuarios as $usuario) {
                        echo "
                        <tr>
                            <td><a href='perfil.php?perfil=" . $usuario->getUsuario() . "'>" . $usuario->getUsuario() . "</a></td>
                        </tr>";
                   }
                ?>
	        </tbody>
        </table>
    </div>
</body>
</html>