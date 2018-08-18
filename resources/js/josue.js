$(document).ready(function()
{

	$("#buscarNombreDevolucion").keyup(function(){
			nombre=$("#buscarNombreDevolucion").val();
			proceso="buscar";
			$.ajax({
				data: {nombre:nombre,proceso:proceso},
				type: 'post',
				url: 'procesos/administrarDevolJosue.php',
				success: function(respuesta){
					$("#tablaDevol").html("");
					$("#tablaDevol").html(respuesta);
				},
				error: function(){
					sweetAlert("No","","error")
				}
			})
		})	


	
})