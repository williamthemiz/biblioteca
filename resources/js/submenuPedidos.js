$().ready(function(){

//divs con contenido

regPed = $("#regPed");
admPed = $("#admPed");
regProv = $("#regProv");
admProv = $("#admProv");


//agregando los submenu li a una variable

mregPed = $("#mregPed");
madmPed = $("#madmPed");
mregProv = $("#mregProv");
madmProv = $("#madmProv");

regPed.show();


mregPed.click(function() 
{
	regPed.show();
	admPed.hide();
	regProv.hide();
	admProv.hide();
});

madmPed.click(function() 
{
	regPed.hide();
	admPed.show();
	regProv.hide();
	admProv.hide();
});

mregProv.click(function() 
{
	regPed.hide();
	admPed.hide();
	regProv.show();
	admProv.hide();
});

madmProv.click(function() 
{
	regPed.hide();
	admPed.hide();
	regProv.hide();
	admProv.show();
});


$('#filtrarLibros').keyup(function(){
		texto=$('#filtrarLibros').val();
		$.ajax({
			data :{texto:texto},
			url: '../php/procesos/filtrarLibros.php',
			type: 'post',
			beforeSend: function(){

			},
			success: function(respuesta){
				$('#tabla').html("");
				$('#tabla').html(respuesta);
			}
		})
	});

$('#filtrarPedidos').keyup(function(){
		texto=$('#filtrarPedidos').val();
		$.ajax({
			data :{texto:texto},
			url: '../php/procesos/filtrarPedidos.php',
			type: 'post',
			beforeSend: function(){

			},
			success: function(respuesta){
				$('#tablaP').html("");
				$('#tablaP').html(respuesta);
			}
		})
	});

$('#filtrarProv').keyup(function(){
		texto=$('#filtrarProv').val();
		$.ajax({
			data :{texto:texto},
			url: '../php/procesos/filtrarProv.php',
			type: 'post',
			beforeSend: function(){

			},
			success: function(respuesta){
				$('#tablaProv').html("");
				$('#tablaProv').html(respuesta);
			}
		})
	});

});