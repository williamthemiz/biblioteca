$().ready(function(){

formulario = $("#frmCheckDev");
div = $("#datosDevol");

formulario.submit(function(e) 
{
	id = $("#idPrestamo").val();
	e.preventDefault();

	$.ajax({
		url: 'procesos/checkDevol.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(respuesta) {
		div.html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
	
});

$("#frmRegDev").submit(function(e) 
{
	hid = $("#hidPrestamo").val();
	e.preventDefault();

	$.ajax({
		url: 'procesos/regDevol.php',
		type: 'POST',
		data: {hid: hid},
	})
	.done(function(respuesta) {
		alert(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
	
});


});