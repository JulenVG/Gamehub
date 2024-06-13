document.addEventListener("DOMContentLoaded", function () {
  
  //Controla el modal de inicio de sesión
  if (document.querySelector("#iniciarSesion") !== null) {
    const btnAbrirModal = document.querySelector("#iniciarSesion");
    const btnCerrarModal = document.querySelector("#cerrarInicio");
    const modal = document.querySelector("#modal");

    btnAbrirModal.addEventListener("click", function () {
      modal.showModal();
    });
    btnCerrarModal.addEventListener("click", function () {
      modal.close();
    });
  }

  //Controla el modal de crear cuenta
  if (document.querySelector("#crearCuenta") !== null) {
    const btnAbrirModal2 = document.querySelector("#crearCuenta");
    const btnCerrarModal2 = document.querySelector("#cerrarCrear");
    const modal2 = document.querySelector("#modal2");
    btnAbrirModal2.addEventListener("click", function () {
      modal2.showModal();
    });
    btnCerrarModal2.addEventListener("click", function () {
      modal2.close();
    });
  }

  //Controla el modal de borrar cuenta
  if (document.querySelector("#borrarCuenta") !== null) {
    const btnAbrirModal3 = document.querySelector("#borrarCuenta");
    const btnCerrarModal3 = document.querySelector("#rechazarBorrar");
    const modal3 = document.querySelector("#modal3");

    btnAbrirModal3.addEventListener("click", function () {
      modal3.showModal();
    });
    btnCerrarModal3.addEventListener("click", function () {
      modal3.close();
    });
  }

  //Controla el modal de añadir juego
  if (document.querySelector("#anadirJuego") !== null) {
    const btnAbrirModal4 = document.querySelector("#anadirJuego");
    const btnCerrarModal4 = document.querySelector("#cerrarAnadir");
    const modal4 = document.querySelector("#modal4");

    btnAbrirModal4.addEventListener("click", function () {
      modal4.showModal();
    });
    btnCerrarModal4.addEventListener("click", function () {
      modal4.close();
    });
  }

  //Se encarga de mostrar el formulario de añadir a la biblioteca en el catálogo cuando se hace clic en el icono de +
  if (document.querySelectorAll(".mostrarFormularioAñadir") != null) {
    var botonesMostrarFormulario = document.querySelectorAll(
      ".mostrarFormularioAñadir"
    );
    var botonesCancelar = document.querySelectorAll(
      ".cancelarForemularioAñadir"
    );

    // Mostrar el formulario cuando se hace clic en el botón "Agregar Juego"
    botonesMostrarFormulario.forEach(function (boton) {
      boton.addEventListener("click", function () {
        var juegoId = this.getAttribute("idJuego");
        var formulario = document.getElementById("form-" + juegoId);
        var botonAgregar = document.getElementById("boton-" + juegoId);
        formulario.style.display = "block";
        botonAgregar.style.display = "none";
      });
    });

    // Ocultar el formulario cuando se hace clic en el botón "Cancelar"
    botonesCancelar.forEach(function (boton) {
      boton.addEventListener("click", function () {
        var juegoId = this.getAttribute("idJuego");
        var formulario = document.getElementById("form-" + juegoId);
        var botonAgregar = document.getElementById("boton-" + juegoId);
        formulario.style.display = "none";
        botonAgregar.style.display = "";
      });
    });
  }

  // Elimina la cookie de sesión cuando el usuario hace click en cerrar sesión
  if (document.getElementsByClassName("cerrar-sesion")[0] != null) {
    const btnCerrarSesion = document.getElementsByClassName("cerrar-sesion")[0];
    btnCerrarSesion.addEventListener("click", function () {
      window.location.href = "index.php";
      document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    });
  }
});

// Función que se encarga de filtrar los nombres de los usuarios
function barraBusqueda() {
  var input = document.getElementById("inputUsuario");
  var filtro = input.value.toUpperCase();
  var table = document.getElementById("tablaUsuario");
  var tr = table.getElementsByTagName("tr");
  for (var i = 0; i < tr.length; i++) {
    var td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      var txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filtro) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//Función que controla los filtros del catálogo
function filtroJuegos(){
  var inputCatalogo = document.getElementById("inputCatalogo").value.toUpperCase();
  var inputGenero = document.getElementById("inputGenero").value.toUpperCase();
  var inputMin = parseFloat(document.getElementById("inputMinimo").value);
  var inputMax = parseFloat(document.getElementById("inputMaximo").value);
  var juegos = document.querySelectorAll(".juego");
  
  juegos.forEach(function (juego) {
    var nombreJuego = juego.querySelector("h3").textContent.toUpperCase();
    var generoJuego = juego.querySelector(".genero").textContent.toUpperCase();
    var notaJuego = parseFloat(juego.querySelector(".notaMedia").textContent);
    
    var filtroNombre = (nombreJuego.indexOf(inputCatalogo) > -1);
    var filtroGenero = (generoJuego.indexOf(inputGenero) > -1);
    var filtroNota = (notaJuego >= inputMin && notaJuego <= inputMax);
    if(isNaN(notaJuego) && inputMin === 0 && inputMax === 10){
      filtroNota = true;
    }
    
    if(filtroNombre && filtroGenero && filtroNota){
      juego.style.display = "";
    }else {
      juego.style.display = "none";
    }
  });
}

//Función que resetea los filtros de catálogo
function resetInputNota(){
  document.getElementById("inputMinimo").value = "0";
  document.getElementById("inputMaximo").value = "10";
  document.getElementById("inputGenero").value = "";
  document.getElementById("inputCatalogo").value = "";
}

//Función que controla los filtros de la biblioteca
function filtroJuegosBiblioteca() {
  var inputBiblioteca = document.getElementById("inputBiblioteca").value.toUpperCase();
  var inputNota = document.getElementById("inputNota").value;
  var table = document.getElementById("tablaBiblioteca");
  var tr = table.getElementsByTagName("tr");

  for (var i = 0; i < tr.length; i++) {
    var tdTitulo = tr[i].getElementsByTagName("td")[2];
    var tdNota = tr[i].getElementsByTagName("td")[3];
    if (tdTitulo && tdNota) {
      var txtValueTitulo = tdTitulo.textContent || tdTitulo.innerText;
      var txtValueNota= tdNota.textContent || tdNota.innerText;
      var mostrarFila = false;
      if (txtValueTitulo.toUpperCase().indexOf(inputBiblioteca) > -1 || inputBiblioteca == "") {
        if(txtValueNota == inputNota || inputNota == "N/A"){
          mostrarFila = true;
        }
      }
      if (mostrarFila == true){
        tr[i].style.display = "";
      }else{
        tr[i].style.display = "none";
      }
    }
  }
}

//Función que resetea los filtros de la biblioteca
function resetFiltroJuegosBiblioteca(){
  document.getElementById("inputNota").value = "N/A";
  document.getElementById("inputBiblioteca").value = "";
}