<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>Biblioteca.php</title>
</head>

<body>
    <?php include "header.php";
    include_once "funciones/filtrosBiblioteca.php";
    $usuarioID = $_GET["usuarioID"]; //Cogemos de la url el ID del usuario
    $biblioteca = crearBiblioteca($usuarioID); //Creamos el objeto biblioteca del usuario con el ID
    $juegos = $biblioteca->getJuegos(); //Obtenemos los juegos del usuario
    $usuario = $biblioteca->getUsuario(); //Obtenemos el dueño de la biblioteca
    if (isset($_GET["tipoOrden"])){ //Cogemos de la url el tipo de orden (ascendente o descendente)
        $tipoOrden = $_GET["tipoOrden"];
    }else $tipoOrden = "ASC"; //Por defecto ascendente
    if (isset($_GET["orden"])){ //Cogemos de la url el orden
        $orden = $_GET["orden"];
    }else $orden = "actualmenteJugando"; //Por defecto ordena por actualmente jugando
    $orden = ordenTabla($orden,$tipoOrden); //Ordena la tabla
    usort($juegos, $orden);
    if($tipoOrden == "ASC"){ //Toggle de tipo de orden
        $tipoOrden = "DES";
    }else $tipoOrden = "ASC"

    ?>
    <main>
        <h1 class="tituloBiblioteca">Biblioteca de <?php echo $usuario->getUsuario(); ?></h1>
        <div class="filtroEstado">
            <div><a class="<?php if($orden == "actualmenteJugando") echo "select";?>"
                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=actualmenteJugando&tipoOrden=<?php echo $tipoOrden; ?>">Actualmente
                    Jugando</a></div>
            <div><a class="<?php if($orden == "completado") echo "select";?>"
                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=completado&tipoOrden=<?php echo $tipoOrden; ?>">Completado</a>
            </div>
            <div><a class="<?php if($orden == "abandonado") echo "select";?>"
                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=abandonado&tipoOrden=<?php echo $tipoOrden; ?>">Abandonado</a>
            </div>
            <div><a class="<?php if($orden == "intencionDeJugar") echo "select";?>"
                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=intencionDeJugar&tipoOrden=<?php echo $tipoOrden; ?>">Intencion
                    de jugar</a></div>
        </div>
        <div class="containerFiltrosBiblioteca">
            <div class="filtros">
                <h1>Filtros:</h1>
                <div class="containerTextoNotaBiblioteca">
                    <div class="filtoTexto">
                        <label for="generoJueg">Nombre</label>
                        <input type="text" id="inputBiblioteca" onkeyup="filtroJuegosBiblioteca()"
                            placeholder="Buscar por nombre...">
                    </div>

                    <div class="filtroNota">
                        <label for="generoJueg">Nota</label>
                        <select name='inputNota' id='inputNota' onchange="filtroJuegosBiblioteca()">
                            <option value='N/A' selected>N/A</option>";
                            <option value=0>0</option>";
                            <option value=1>1</option>";
                            <option value=2>2</option>";
                            <option value=3>3</option>";
                            <option value=4>4</option>";
                            <option value=5>5</option>";
                            <option value=6>6</option>";
                            <option value=7>7</option>";
                            <option value=8>8</option>";
                            <option value=9>9</option>";
                            <option value=10>10</option>";
                        </select>
                    </div>
                </div>
                <div class="containerfiltroReset">
                    <button class="resetInputNota"
                        onclick="resetFiltroJuegosBiblioteca(); filtroJuegosBiblioteca()">Resetear</button>
                </div>
            </div>
            <div>
                <table class="tablaBiblioteca" id="tablaBiblioteca">
                    <thead>
                        <tr>
                            <th class="estadoColor"></th>
                            <th></th>
                            <th><a
                                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=titulo&tipoOrden=<?php echo $tipoOrden; ?>">Título</a>
                            </th>
                            <th><a
                                    href="?usuarioID=<?php echo $usuarioID; ?>&orden=nota&tipoOrden=<?php echo $tipoOrden; ?>">Nota</a>
                            </th>
                            <th>Plataforma</th>
                            <?php 
                            if($logged == true){
                                if($usuario->getID() == $usuarioLog->getID()){
                                    echo "<th></th>";
                                    echo "<th></th>";
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    //Crear todas las fichas de los juegos
                    foreach($juegos as $juego){
                        echo                 
                        "<tr>
                            <td ".estadoColor($juego->getEstado())."class = 'estadoColor'></td>
                            <td>
                            <a href='ficha.php?idJuego=".$juego->getID()."'>
                            <img src='img/".$juego->getImg()."' alt='Portada del videojuego ".$juego->getNombre()."' class='imagenJuegoBiblioteca' />
                            </a>
                            </td>
                            <td class='tablaBibliotecaTitulo'><h3><a href='ficha.php?idJuego=".$juego->getID()."'>".$juego->getNombre()."</a></h3><br>".$juego->getValoraciones()->getComentario()."</td>
                            <td class='notaPlataforma'>".$juego->getValoraciones()->getNota()."</td>
                            <td class='notaPlataforma'>".$juego->getPlataforma()."</td>";

                            //En caso de que la cookie de sesión coincida con el usuario de la biblioteca se crean también los botones de edición
                            if($logged == true){
                                if($usuario->getID() == $usuarioLog->getID()){
                                    echo "<td><div class='mostrarModalBiblioteca'><a href='editBiblioteca.php?idJuego=".$juego->getID()."&idUsuario=".$usuarioLog->getID()."'>&#128221;</a></div></td>
                                <td>                                
                                    <form method='POST' class='quitarBiblioteca'>
                                        <input type='hidden' name='idJuego' value='" .  $juego->getID() . "'>
                                        <input type='submit' name='quitarBiblioteca' value='&times;'>
                                    </form> 
                                </td>    
                                </tr>                       
                                ";
                                }
                            }
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<?php 
   if (!empty($_POST["quitarBiblioteca"])){
    $idJuego = $_POST["idJuego"];
    $idUsuario = $usuarioLog->getID();
    $pagina = "biblioteca";

    quitarBiblioteca($idJuego, $idUsuario, $pagina);
  }
  
?>

</html>