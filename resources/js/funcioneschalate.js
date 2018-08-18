function modificar(id,nombre){
			$('.modal').modal();
			$('#modIdCategoria').val(id);
			$('#modNombreCategoria').val(nombre);
		}
function eliminar(e){
	e.preventDefault();
	alert(this.id);
}
function modificarLibro(id,titulo,categoria,autor,existencia,imagen,paginas,fecha,editorial,descripcion){
	$('#modIdLibro').val(id);
	$('#modTituloLibro').val(titulo);
	$('#modCategoriaLibro').val(categoria);
	$('#modAutorLibro').val(autor);
	$('#modExistenciaLibro').val(existencia);
	$('#nombreImagen').val(imagen);
	$('#modPaginasLibro').val(paginas);
	$('#modFechaLibro').val(fecha);
	$('#modEditorialLibro').val(editorial);
	$('#modDescripcionLibro').val(descripcion);
}
function modificarUsuario(nombre,direccion,telefono,correo,username){
	$('#username').val(username);
	$('#nombre').val(nombre);
	$('#direccion').val(direccion);
	$('#telefono').val(telefono);
	$('#correo').val(correo);
	$('#usernameClave').val(username);
}
function modificarEmpleado(username,nombre,cargo,dui,telefono,correo,direccion){
	$('#usernameEmpleado').val(username);
	$('#nombreEmpleado').val(nombre);
	$('#direccionEmpleado').val(direccion);
	$('#duiEmpleado').val(dui);
	$('#cargoEmpleado').val(cargo);
	$('#telefonoEmpleado').val(telefono);
	$('#correoEmpleado').val(correo);
	$('#usernameClaveEmpleado').val(username);
}
function modificarProv(id,nombre,direccion,telefono){
	$('.modal').modal();
	$('#modId').val(id);
	$('#modNombre').val(nombre);
	$('#modDir').val(direccion);
	$('#modTel').val(telefono);
}
