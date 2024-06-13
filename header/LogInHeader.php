<header class="headerPrincipal">
    <a href="index.php" class="logoCabeza">
        <img src="img/logolargo.png" alt="Logotipo de GameHub" />
    </a>
    <div>
        <nav class="navUsuario">
            <ul class="menu-usuario">
                <li><a> <?php echo $usuarioLog->getUsuario(); ?> <span class="dropMenu">&dtrif;</span></a>
                    <ul class="menu-vertical">
                        <li><a href="editPerfil.php">Editar Perfil</a></li>
                        <li><a href="biblioteca.php?usuarioID=<?php echo $usuarioLog->getID(); ?>">Biblioteca</a></li>
                        <li class="cerrar-sesion"><a id="cerrarSesion">Cerrar Sesión</a></li>
                    </ul>
            </ul>
        </nav>
    </div>
</header>