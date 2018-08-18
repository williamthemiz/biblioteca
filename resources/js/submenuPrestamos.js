$().ready(function(){

//divs con contenido

regPres = $("#regPres");
admPres = $("#admPres");
histPres = $("#histPres");

//agregando los submenu li a una variable

mregPres = $("#mregPres");
madmPres = $("#madmPres");
mhistPres = $("#mhistPres");

regPres.show();
admPres.hide();
histPres.hide();


mregPres.click(function() 
{
	regPres.show();
	admPres.hide();
	histPres.hide();
});

madmPres.click(function() 
{
	regPres.hide();
	admPres.show();
});

mhistPres.click(function() 
{
	regPres.hide();
	histPres.show();
});

$('#filtrarPrestamo').keyup(function(){
		texto=$('#filtrarPrestamo').val();
		$.ajax({
			data :{texto:texto},
			url: '../php/procesos/filtrarPrestamo.php',
			type: 'post',
			beforeSend: function(){

			},
			success: function(respuesta){
				$('#tabla').html("");
				$('#tabla').html(respuesta);
			}
		})
	});


});