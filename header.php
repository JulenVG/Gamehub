<?php 
include_once "funciones/conexion.php";
include_once "funciones/consultasUsuarios.php";
include_once "funciones/consultasJuegos.php";
include_once "funciones/consultasBibliotecas.php";
require_once 'models/Usuario.php';
require_once 'models/Juego.php';
require_once 'models/Valoracion.php';
require_once 'models/Biblioteca.php';



  //Se comprueba si el usuario está logueado o no, dependiendo de que como esté muestra un header o otro
  if (isset($_COOKIE['user'])){
    $usuarioLog = unserialize($_COOKIE['user']);
    $logged = true;
    include "header/LogInHeader.php";
  }else{
    $logged = false;
    include "header/noLogInHeader.php";
  }

?>
<nav class="navPrincipal">
    <h3>
        <a href="index.php">Inicio</a>
        <a href="catalogo.php">Catálogo</a>
        <a href="usuarios.php">Usuarios</a>
    </h3>
</nav>
<script src="funciones/script.js"></script>