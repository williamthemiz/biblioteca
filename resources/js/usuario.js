$(document).ready(function(){
	$("#txtBuscarUsuario").keyup(function(){
		carnet=$("#txtBuscarUsuario").val();
		proceso="buscarUsuario";
		$.ajax({
			url: "procesos/administrarUsuarios.php",
			data: {proceso:proceso,carnet:carnet},
			type: "post",
			success: function(respuesta){
				$("#tablaAdministrarUsuario").html("");
				$("#tablaAdministrarUsuario").html(respuesta);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");
			}

		})
	});

	$("#txtBuscarEmpleado").keyup(function(){
		username=$("#txtBuscarEmpleado").val();
		proceso="buscarEmpleado";
		$.ajax({
			url: "procesos/administrarEmpleado.php",
			data: {proceso:proceso,username:username},
			type: "post",
			success: function(respuesta){
				$("#tablaAdministrarEmpleados").html("");
				$("#tablaAdministrarEmpleados").html(respuesta);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");
			}

		})
	});


})