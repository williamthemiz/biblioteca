$().ready(function(){

//divs con contenido

admUser = $("#admUser");
regEmp = $("#regEmp");
admEmp = $("#admEmp");


//agregando los submenu li a una variable

madmUser = $("#madmUser");
mregEmp = $("#mregEmp");
madmEmp = $("#madmEmp");

admUser.show();

madmUser.click(function() 
{
	admUser.show();
	regEmp.hide();
	admEmp.hide();
});

mregEmp.click(function() 
{
	admUser.hide();
	regEmp.show();
	admEmp.hide();
});

madmEmp.click(function() 
{
	admUser.hide();
	regEmp.hide();
	admEmp.show();
});




});