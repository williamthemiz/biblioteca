$().ready(function(){

//divs con contenido

regDev = $("#regDev");
admDev = $("#admDev");

//agregando los submenu li a una variable

mregDev = $("#mregDev");
madmDev = $("#madmDev");

regDev.show();
admDev.hide();


mregDev.click(function() 
{
	regDev.show();
	admDev.hide();
});

madmDev.click(function() 
{
	regDev.hide();
	admDev.show();
});




});