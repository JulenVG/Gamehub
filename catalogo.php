<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo.css">
    <title>Catalogo.php</title>
</head>

<body>
    <?php include "header.php";?>
    <div>
        <dialog id="modal4">
            <h2>Añadir juego al catálogo</h2>
            <form method="POST" class="formJuego" enctype="multipart/form-data">
                <p>
                    <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" required
                        placeholder="Introduce el nombre del juego" />
                </p>
                <p>
                    <label for="descripcion">Descripción: </label><input type="text" name="descripcion" id="descripcion"
                        required placeholder="Introduce una breve descripcion del juego" />
                </p>
                <p>
                    <label for="generoJueg">Selecciona un género:</label>
                    <select id="generoJueg" name="generoJueg">
                        <option value="Acción">Acción</option>
                        <option value="Disparos">Disparos</option>
                        <option value="Estrategia">Estrategia</option>
                        <option value="Simulación">Simulación</option>
                        <option value="Deporte">Deporte</option>
                        <option value="Carreras">Carreras</option>
                        <option value="Aventura">Aventura</option>
                        <option value="Rol">Rol</option>
                    </select>
                </p>
                <p>
                    <label for="img">Portada: </label>
                    <input type="file" name="img" id="img" required />
                </p>
                <p><input type="submit" name="guardarJuego" value="Guardar" /></p>
            </form>
            <button id="cerrarAnadir">&times;</button>
        </dialog>
    </div>
    <div class="container">
        <div class="containerFiltrosAnadirJuego">
            <div class="filtros">
                <h1>Filtros:</h1>
                <div class="filtoTexto">
                    <label for="generoJueg">Nombre</label>
                    <input type="text" id="inputCatalogo" onkeyup="filtroJuegos()" placeholder="Buscar por nombre...">
                </div>
                <div class="containerGeneroRango">
                    <div class="filtroGenero">
                        <label for="generoJueg">Género</label>
                        <select name='inputGenero' id='inputGenero' onchange="filtroJuegos()">
                            <option value=''>Seleccionar Género</option>
                            <option value="Acción">Acción</option>
                            <option value="Disparos">Disparos</option>
                            <option value="Estrategia">Estrategia</option>
                            <option value="Simulación">Simulación</option>
                            <option value="Deporte">Deporte</option>
                            <option value="Carreras">Carreras</option>
                            <option value="Aventura">Aventura</option>
                            <option value="Rol">Rol</option>
                        </select>
                    </div>
                    <div class="rangoNota">
                        <label for="rangoNota">Nota</label>
                        <div class="inputNota">
                            <div class="minimo">
                                <span>Min</span>
                                <input type="number" id="inputMinimo" value="0" onchange="filtroJuegos()">
                            </div>
                            <span class="separador">-</span class="separador">
                            <div class="maximo">
                                <span>Max</span>
                                <input type="number" id="inputMaximo" value="10" onchange="filtroJuegos()">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containerfiltroReset">
                    <button class="resetInputNota" onclick="resetInputNota(); filtroJuegos()">Resetear</button>
                </div>
            </div>
            <?php
                //Si el usuario está logueado puede editar
                if($logged == true){
                    echo "<div class='contenedorAnadirJuego'><button id='anadirJuego'>Añadir juego</button></div>";
                }
            ?>
        </div>
        <div>
            <?php
			$juegos = crearJuegos();
            //Creamos todas las fichas de los juegos en el catálogo
			foreach ($juegos as $juego) {
				echo "
				<div class='juego'>
                    <a href='ficha.php?idJuego=".$juego->getID()."'>
                    <img src='img/".$juego->getImg()."' alt='Portada del videojuego ".$juego->getNombre()."' class='imagenJuego' />
                    </a>
					<div class='infoJuego'>
						<h3><a href='ficha.php?idJuego=".$juego->getID()."'>".$juego->getNombre()."</a></h3>
						<p class='genero'><strong>Género:</strong> ".$juego->getGenero()."</p>
						<p>".$juego->getDescripcion()."</p>
						<p ><strong>Nota media:</strong> <span class='notaMedia'>".notaMedia($juego->getID())."</span></p>";
						if($logged == true){
                            if(anadido($juego->getID(), $usuarioLog->getID()) == true){
                                echo "
                                <form method='POST' class='quitarBiblioteca'>
                                <input type='hidden' name='idJuego' value='" .  $juego->getID() . "'>
                                <input type='submit' name='quitarBiblioteca' value='&times;'>
                                </form>
                                ";
                            }else{
                                echo "
                                <div class='contenedorAgregarJuego'>
                                    <div class='contenedorBtnAgregarJuego'>
                                        <button class='mostrarFormularioAñadir' idJuego='" . $juego->getID() . "' id='boton-" . $juego->getID() . "'>+</button>
                                    </div>
                                    <form method='POST' class='formAnadirJuego' id='form-" . $juego->getID() . "' style='display: none;'>
                                        <div class='contenedorSelect'>
                                            <input type='hidden' name='idJuego' value='" .  $juego->getID() . "'>
                                            <p>
                                            <label for='plataforma'>Plataforma:</label>
                                            <select name='plataforma' id='plataforma' required>
                                                <option value=' '>Seleccionar Plataforma</option>
                                                <option value='Steam'>Steam</option>
                                                <option value='Origin'>Origin</option>
                                                <option value='Epic Games'>Epic Games</option>
                                                <option value='GoG'>GoG</option>
                                                <option value='Ubisoft'>Ubisoft</option>
                                                <option value='Xbox Store PC'>Xbox Store PC</option>
                                                <option value='Switch'>Switch</option>
                                                <option value='Itch.io'>Itch.io</option>
                                                <option value='Battle.net'>Battle.net</option>
                                                <option value='Bethesda Launcher'>Bethesda Launcher</option>
                                                <option value='Físico'>Físico</option>
                                            </select>
                                            </p>
                                            <p>                      
                                            <label for='estado'>Estado:</label>
                                            <select name='estado' id='estado' required>
                                                <option value=''>Seleccionar Estado</option>
                                                <option value='Completado'>Completado</option>
                                                <option value='Abandonado'>Abandonado</option>
                                                <option value='Intención de jugar'>Intención de jugar</option>
                                                <option value='Actualmente jugando'>Actualmente jugando</option>
                                            </select> 
                                            </p>
                                            <p>                      
                                            <label for='nota'>Nota:</label>
                                            <select name='nota' id='nota'>
                                                <option value='N/A' selected>N/A</option>";
                                                for ($i = 0; $i <= 10; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                            echo " </select></p>
                                        </div>
                                        <div>
                                            <label for='comentario'>Comentario:</label>
                                            <input type='text' name='comentario'>
                                        </div>
                                        <div class='contenedorBotones'>
                                            <input type='submit' name='agregarBiblioteca' value='Guardar'>
                                            <button type='button' class='cancelarForemularioAñadir' idJuego='" . $juego->getID() . "'>Cancelar</button>
                                        </div>        
                                    </form>
                                </div>
                                ";

                            }
						}
					echo "</div>
				</div>";
			}
		?>

        </div>
    </div>
</body>
<?php 
  if (!empty($_POST["guardarJuego"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $generoJueg = $_POST["generoJueg"];
    $img = $_FILES["img"];

    crearJuego($nombre, $descripcion, $generoJueg, $img);
  }
  if (!empty($_POST["agregarBiblioteca"])){
    $idJuego = $_POST["idJuego"];
    $idUsuario = $usuarioLog->getID();
    $plataforma = $_POST["plataforma"];
    $estado = $_POST["estado"];
    $nota = $_POST["nota"];
    $comentario = $_POST["comentario"];

    agregarBiblioteca($idJuego, $idUsuario, $plataforma, $estado, $nota, $comentario);
  }

  if (!empty($_POST["quitarBiblioteca"])){
    $idJuego = $_POST["idJuego"];
    $idUsuario = $usuarioLog->getID();
    $pagina = "catalogo";

    quitarBiblioteca($idJuego, $idUsuario, $pagina);
  }
?>

</html>