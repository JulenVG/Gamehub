<header class="headerPrincipal">
    <a href="index.php" class="logoCabeza">
        <img src="img/logolargo.png" alt="Logotipo de GameHub" />
    </a>
    <div>
        <button id="iniciarSesion">Iniciar sesión</button>
        <button id="crearCuenta">Crear Cuenta</button>
    </div>
    <dialog id="modal">
        <h2>Inicio de sesión</h2>
        <form action="index.php" method="POST" class="formularioIniciar">
            <p>
                <label for="usuario">Usuario: </label><input type="text" name="usuario"
                    placeholder="Introduce el usuario" />
            </p>
            <p>
                <label for="contra">Contraseña: </label><input type="password" name="contra"
                    placeholder="Introduce la contraseña" />
            </p>
            <p><input type="submit" name="inicio" value="Iniciar Sesión" /></p>
        </form>
        <button id="cerrarInicio">&times;</button>
    </dialog>
    <dialog id="modal2">
        <h2>Crear Cuenta</h2>
        <form action="" method="POST" class="formularioCrear">
            <p>
                <label for="email">Email: </label><input type="email" name="email" id="email" required
                    placeholder="Introduce tu email" />
            </p>
            <p>
                <label for="usuario">Usuario: </label><input type="text" name="usuario" id="usuario" required
                    placeholder="Introduce el usuario" />
            </p>
            <p>
                <label for="contra">Contraseña: </label><input type="password" name="contra" id="contra" required
                    placeholder="Introduce la contraseña" />
            </p>
            <p>
                <label for="genero">Género: </label>
                <select id="genero" name="genero">
                    <option value="ninguno">Ninguno</option>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>
            </p>
            <p>
                <label for="nacimiento">Fecha de nacimiento: </label><input type="date" name="nacimiento"
                    id="nacimiento" required />
            </p>
            <p><input type="submit" name="registro" value="Crear Cuenta" /></p>
        </form>
        <button id="cerrarCrear">&times;</button>
    </dialog>
</header>
<?php 
  if (!empty($_POST["registro"])){
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];
    $genero = $_POST["genero"];
    $nacimiento = $_POST["nacimiento"];
    crearUsuario($email, $usuario, $contra, $genero, $nacimiento);
  }

  //Llamamos a la funcion de iniciar sesión
  if (!empty($_POST["inicio"])){
    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];
    iniciarSesion($usuario, $contra);
  }
?>