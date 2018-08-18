$(document).ready(function(){

	$('.modal').modal();
	$('select').material_select();

		$("#agregarEmpleado").submit(function(e){
			e.preventDefault();
			username=$("#usernameAgregarEmpleado").val();
			clave=$("#claveAgregarEmpleado").val();
			nombre=$("#nombreAgregarEmpleado").val();
			cargo=$("#cargoAgregarEmpleado").val();
			direccion=$("#direccionAgregarEmpleado").val();
			dui=$("#duiAgregarEmpleado").val();
			correo=$("#correoAgregarEmpleado").val();
			telefono=$("#telefonoAgregarEmpleado").val();
			agregarEmpleado=$("#btnagregarEmpleado").val();
			$.ajax({
				url: "procesos/agregarEmpleado.php",
				data: {username:username,clave:clave,nombre:nombre,cargo:cargo,direccion:direccion,dui:dui,correo:correo,telefono:telefono,agregarEmpleado:agregarEmpleado},
				type: "post",
				success: function(respuesta){
					$("#alertas").html(respuesta);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
	 			sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");

	 		}
			})
		});

		$("#confirmarClave").keypress(function(input){
			kCode=input.keyCode?input.keyCode:input.which;
			sKey=input.shiftKey?input.shiftKey:((kCode==16)?true:false);
			if(((kCode>=65&&kCode<=90)&&!sKey)||((kCode>=97&&kCode<=122)&&sKey )){
			    $(".advertencia2").html("Bloq Mayus Activado!");
			}
			else{
				$(".advertencia2").html("");
				$(".advertencia1").html("");
			}
		})

		$("#claveNueva").keypress(function(input){
			kCode=input.keyCode?input.keyCode:input.which;
			sKey=input.shiftKey?input.shiftKey:((kCode==16)?true:false);
			if(((kCode>=65&&kCode<=90)&&!sKey)||((kCode>=97&&kCode<=122)&&sKey )){
			    $(".advertencia1").html("Bloq Mayus Activado!");
			}
			else{
				$(".advertencia1").html("");
				$(".advertencia2").html("");
			}
		})
		$("#buscarNombreLibro").keyup(function(){
			titulo=$("#buscarNombreLibro").val();
			proceso="buscar";
			$.ajax({
				data: {titulo:titulo,proceso:proceso},
				type: 'post',
				url: 'procesos/administrarLibro.php',
				success: function(respuesta){
					$("#tablaLibro").html("");
					$("#tablaLibro").html(respuesta);
				},
				error: function(){
					sweetAlert("No","","error")
				}
			})
		})	
	 	$("#modificarLibro").submit(function(e){

	 	})
	 	

	$("#modificarCategoria").submit(function(e){
	 	e.preventDefault();
	 	txtId=$('#modIdCategoria').val();
	 	txtNombre=$('#modNombreCategoria').val();
	 	btnModificar=$('#btnModificar').val();
	 	$.ajax({
	 		data: {txtId:txtId,txtNombre:txtNombre,btnModificar:btnModificar},
	 		url: 'procesos/administrarCategoria.php',
	 		type: 'post',
	 		success: function(respuesta){
	 			sweetAlert("Modificación con éxito","Se modificó correctamente","success");
	 			$('#tabla').html("");
	 			$('#tabla').html(respuesta);

	 		},
	 		error: function(XMLHttpRequest, textStatus, errorThrown){
	 			sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");

	 		}
	 	})
	 })



	$("#agregarCategoria").submit(function(e){
	e.preventDefault();
	nombreCategoria=$('#nombreCategoria').val();
	btnAgregarCategoria=$('#btnAgregarCategoria').val();
	$.ajax({
            data:  {nombreCategoria:nombreCategoria,btnAgregarCategoria:btnAgregarCategoria},
            url:   'procesos/agregarCategoria.php',
            type:  'post',
            success:  function (respuesta) {
            	if (respuesta=="Ingrese un nombre en la categoría") {
            			sweetAlert("Campo vacío", "Inserte un nombre de categoría", "error");
            			$('#nombreCategoria').val("");
            		}
            		else{
            			sweetAlert("Categoria Agregada", "La categoría se agregó con éxito", "success");
            			$('#nombreCategoria').val("");
            			$('#tabla').html("");
            			$('#tabla').html(respuesta);
            		}
            		
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            	sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");
    		}
        })
	})



	$('#buscarNombreCategoria').keyup(function(){
		nombre=$('#buscarNombreCategoria').val();
		if ($('#filled-in-box').is(':checked')){
			activo=1;
		}
		else
		{
			activo=0;
		}
		
		$.ajax({
			data :{nombre:nombre},
			url: '../php/procesos/buscarCategoria.php',
			type: 'post',
			beforeSend: function(){

			},
			success: function(respuesta){
				$('#tabla').html("");
				$('#tabla').html(respuesta);
			}
		})
	})
	//Funciones Luis

	$("#modificarProveedor").submit(function(e){
	 	e.preventDefault();
	 	txtId=$('#modId').val();
	 	txtNombre=$('#modNombre').val();
	 	txtDireccion=$('#modDir').val();
	 	txtTelefono=$('#modTel').val();
	 	btnModificar=$('#btnModificar').val(); 
	 	 $.ajax({
	 		data: {txtId:txtId,txtNombre:txtNombre,txtDireccion:txtDireccion,txtTelefono:txtTelefono,btnModificar:btnModificar},
	 		url: ' procesos/administrarProveedores.php',
	 		type: 'post',
	 		success: function(respuesta){
	 			$('#tablaProveedor').html("");
	 			$('#tablaProveedor').html(respuesta);

	 		},
	 		error: function(XMLHttpRequest, textStatus, errorThrown){
	 			sweetAlert("Oops :(","Status: "+textStatus+"  Error: "+errorThrown,"error");

	 		}
	 	})
	 });
//evento ajax para busqueda por nombre de proveedores
		$("#buscarNombreProv").keyup(function(){
			nombre=$("#buscarNombreProv").val();
			proceso="buscar";
			$.ajax({
				data: {nombre:nombre,proceso:proceso},
				type: 'post',
				url: 'procesos/administrarProveedores.php',
				success: function(respuesta){
					$("#tablaProveedor").html("");
					$("#tablaProveedor").html(respuesta);
				},
				error: function(){
					sweetAlert("No","","error")
				}
			})
		});	


	
})
