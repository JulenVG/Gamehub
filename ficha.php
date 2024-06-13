<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>Ficha.php</title>
</head>

<body>
    <?php include "header.php";
    $idJuego = $_GET["idJuego"];
    $juegos = crearJuegos();
    foreach ($juegos as $juego) {
        if ($juego->id === $idJuego) {
            break;
        }
    }
    ?>
    <main>
        <div class="fichaJuego">
            <div class="containerImagenFicha"></div>
            <img src='img/<?php echo $juego->getImg()?>' alt='Portada del videojuego <?php echo $juego->getNombre()?>'
                class='imagenJuegoFicha' />
            <div class="containerFichaJuegoComentarios">

                <div class='infoJuegoFicha'>
                    <div class="containerTituloFicha">
                        <h1><?php echo $juego->getNombre();?></h1>
                    </div>
                    <div class="containerGeneroNotaPuesto">
                        <div class='generoFicha'>
                            <h4><strong>Género: </strong><span><?php echo $juego->getGenero();?></span></h4>
                        </div>
                        <div class="containerNotaPuesto">
                            <div class='notaMediaFicha'><strong>Nota</strong>
                                <span><?php echo notaMedia($juego->getID());?></span>
                            </div>
                            <div class='rankingFicha'><strong>Puesto</strong>
                                <?php
                        $puesto = ranking($juego->getNombre());
                        if($puesto == ""){
                            echo "<span>N/A</span>";
                        }else echo "<span>#".$puesto."</span>";
                        ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containerDescripcionFicha">
                    <p><?php echo $juego->getDescripcion();?></p>
                </div>
            </div>
        </div>
        <?php
                //Si el usuario esta logueado puede editar
                if($logged == true){
                    echo "<div class='editarFicha'><a class='boton' href='editFicha.php?idJuego=".$idJuego."'>Editar Ficha</a>
                    </div>";
                }
        ?>
        <div class="cajaDeComentarios">
            <h2 class="comentariosLabel">Comentarios: </h2>
            <div class="containerComentarios">
                <?php
                $valoraciones = $juego->getValoraciones();
                foreach ($valoraciones as $valoracion) {
                    if ($valoracion->getNota() != "" || $valoracion->getComentario() != ""){
                        echo "
                        <div class='comentario'>
                            <div class='usuarioComentario'><a href='perfil.php?perfil=" . $valoracion->getUsuario()->getUsuario() . "'><h3>".$valoracion->getUsuario()->getUsuario().":</h3></a></div>
                            <div class='notaComentario'><span>Nota: </span>".$valoracion->getNota()."</div>
                            <div class='comentarioComentario'>".$valoracion->getComentario()."</div>
                        </div>";
                    }
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>