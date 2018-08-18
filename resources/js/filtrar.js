
$().ready(function(){


btnBuscar = $("#btnBuscar");
formulario = $("#frmBuscar");
divLibros = $("#libros");
limpiarBusqueda = $("#limpiarBusqueda");

limpiarBusqueda.click(function() {
	$("#busqueda").val("");
});
 
formulario.submit(function(e)
{
	campo = $("#campo").val();
	categoria = $("#categoria").val();
	texto = $("#busqueda").val();

	e.preventDefault();

	if (campo == "todos" && categoria == "todas" && texto =="") 
	{
		sweetAlert("Ningún campo seleccionado","Seleccione al menos una opción o digite el texto para realizar la busqueda",
			"warning");
	}
	else if (campo!="todos" && texto =="")
	{
		sweetAlert("Texto vacío","Digite texto para realizar una busqueda por campo","warning");
	}
	else
	{

	 $.ajax({
                  data:  {texto : texto,categoria : categoria, campo : campo},
                  url:   'php/procesos/buscar.php',
                  type:  'post',
                  success:  function (respuesta) {
                          actualizarLibros(respuesta);
                  }
          });
	}
});

function actualizarLibros(respuesta)
{
	divLibros.html("");
	divLibros.html(respuesta);
}	



});


