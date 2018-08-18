$().ready(function(){

//agregando los div a una variable
regLibro = $("#regLibro");
admLibro = $("#admLibro");
regCat = $("#regCat");
admCat = $("#admCat");

//agregando los submenu li a una variable

mregLibro = $("#mregLibro");
madmLibro = $("#madmLibro");
mregCat = $("#mregCat");
madmCat = $("#madmCat");

	regLibro.css('display', 'flex');
	admLibro.css('display', 'none');
	regCat.css('display', 'none');
	admCat.css('display', 'none');

mregLibro.click(function() 
{
	regLibro.css('display', 'flex');
	admLibro.css('display', 'none');
	regCat.css('display', 'none');
	admCat.css('display', 'none');
});

madmLibro.click(function() 
{
	regLibro.css('display', 'none');
	admLibro.css('display', 'flex');
	regCat.css('display', 'none');
	admCat.css('display', 'none');
});

mregCat.click(function() 
{
	regLibro.css('display', 'none');
	admLibro.css('display', 'none');
	regCat.css('display', 'flex');
	admCat.css('display', 'none');
});

madmCat.click(function() 
{
	regLibro.css('display', 'none');
	admLibro.css('display', 'none');
	regCat.css('display', 'none');
	admCat.css('display', 'flex');
});



});