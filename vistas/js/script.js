
/*=============================================
BANNER
=============================================*/

$(".fade-slider").jdSlider({

	isSliding: false,
	isAuto: true,
	isLoop: true,
	isDrag: false,
	interval:5000,
	isCursor: false,
	speed:3000

});

var alturaBanner = $(".fade-slider").height();

$(".bannerEstatico").css({"height":alturaBanner+"px"})


/*=============================================
ANIMACIONES SCROLL
=============================================*/

$(window).scroll(function(){

	var posY = window.pageYOffset;
	
	if(posY > alturaBanner){

		$("header").css({"background":"white"})

		$("header .logotipo").css({"filter":"invert(100%)"})

		$(".fa-search, .fa-bars").css({"color":"black"})

	}else{

		$("header").css({"background":"rgba(0,0,0,.5)"})

		$("header .logotipo").css({"filter":"invert(0%)"})

		$(".fa-search, .fa-bars").css({"color":"white"})

	}

})

/*=============================================
MENÚ
=============================================*/

$(".fa-bars").click(function(){

	$(".menu").fadeIn("fast");

})

$(".btnClose").click(function(e){

	e.preventDefault();

	$(".menu").fadeOut("fast");

})

/*=============================================
GRID CATEGORÍAS
=============================================*/

$(".grid figure, .gridFooter figure").mouseover(function(){

	$(this).css({"background-position":"right bottom"})

})

$(".grid figure, .gridFooter figure").mouseout(function(){

	$(this).css({"background-position":"left top"})

})

$(".grid figure, .gridFooter figure").click(function(){

	var vinculo = $(this).attr("vinculo");

	window.location = vinculo;

})

/*=============================================
PAGINACIÓN
=============================================*/

var paginasTotales = Number($(".pagination").attr("totalPaginas"));
var rutaActual = $("#rutaActual").val();// rutaActual es la ruta del dominio
var paginaActual = Number($(".pagination").attr("paginaActual"));
var rutaPagina = $(".pagination").attr("rutaPagina");

if($(".pagination").length != 0) {

	$(".pagination").twbsPagination({
		totalPages: paginasTotales,
		startPage: paginaActual,
		visiblePages: 4,
		first: "Primero",
		last: "Último",
		prev: '<i class="fas fa-angle-left"></i>',
		next: '<i class="fas fa-angle-right"></i>'
	
	}).on("page", function(evt, page) {
	
		if( rutaPagina != "" ) {
	
			window.location = rutaActual + rutaPagina + "/" + page;
			console.log(rutaPagina);
	
		}else {
	
			window.location = rutaActual + page;
	
		}
		
	});
}


/*=============================================
SCROLL UP
=============================================*/

$.scrollUp({
	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"
})

/*=============================================
DESLIZADOR DE ARTÍCULOS
=============================================*/

$(".deslizadorArticulos").jdSlider({
	wrap: ".slide-inner",
	slideShow: 3,
	slideToScroll:3,
	isLoop: true,
	responsive: [{
		viewSize: 320,
		settings:{
			slideShow: 1,
			slideToScroll: 1
		}

	}]

})

/*=============================================
DESLIZADOR DE ARTÍCULOS
=============================================*/

//$('.social-share').shapeShare();


/*=============================================
ENVIAR OPINIONES
=============================================*/

/* Hacemos la validacion de datos de la imagen que se va a capturar */ 

$("#fotoOpinion").change(function(){

	$(".alert").remove();

	let imagen = this.files[0];

	/* VALIDAMOS EL FORMATO DE LA IMAGEN Y SU PESO */
	if( imagen["type"] != "image/jpeg" && imagen["type"] != "image/png" && imagen["type"] != "image/jpg" ) {

		$("#fotoOpinion").val("");
		$("#fotoOpinion").after(`<div class="alert alert-danger"> ¡La imagen
			debe estar en formato JPEG, PNG, o JPG! </div>`);

		return;

	}else if( imagen["size"] > 2000000 ) {
		$("#fotoOpinion").val("");
		$("#fotoOpinion").after(`<div class="alert alert-danger"> ¡La imagen
			debe pesar menos de 2 mb! </div>`);

		return;

	}else {

		let datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event) {

			let rutaImagen = event.target.result;// Con esto obtenemos los datos de la imagen
			$(".prevFotoOpinion").attr("src", rutaImagen);

		});

	}

})

/*=============================================
BUSCADOR 
=============================================*/

$(".buscador").change(function() {

	let busqueda = $(this).val().toLowerCase();
	let expresion = /^[a-z0-9áéíóúñ ]*$/;

	if(!expresion.test(busqueda)) {
		// Si el .test devuelve false significa que no se cumplen los requisitos de la expresion, por lo tanto ponemos
		// el valor a vacio
		$(".buscador").val("");
		
	}else {
		// si la busqueda contiene vocales con acento o espacios, en la url se sustituirán con "_"
		let rutaBuscador = busqueda.replace(/[0-9áéíóúñ ]/g, "_");

		// cuando hagamos click en la lupa para buscar, nos llevará a la url deseada
		$(".buscar").click(function() {

			if( $(".buscador").val() != "" ) {
				
				window.location = rutaActual + rutaBuscador;

			}

		});

	}
	
});

/*=============================================
BUSCADOR CON ENTER
=============================================*/

// Indicamos que cuando se pulse una tecla en el objeto que contiene la clase .buscador, se realice la siguiente funcion
$(document).on("keyup", ".buscador", function(event) {

	/* Para poder asignarle a las teclas una nueva función, debemos restablecer sus valores por defecto y eso se hace
	con la siguiente linea */
	event.preventDefault();

	// Si la tecla pulsada es el 13(es el codigo del enter) y hemos escrito algo en el buscador, se realiza lo siguiente
	if( event.keyCode == 13 && $(".buscador").val() != "" ) {

		let busqueda = $(this).val().toLowerCase();
		let expresion = /^[a-z0-9áéíóúñ ]*$/;

		if(!expresion.test(busqueda)) {
			// Si el .test devuelve false significa que no se cumplen los requisitos de la expresion, por lo tanto ponemos
			// el valor a vacio
			$(".buscador").val("");
			
		}else {
			// si la busqueda contiene vocales con acento o espacios, en la url se sustituirán con "_"
			let rutaBuscador = busqueda.replace(/[0-9áéíóúñ ]/g, "_");
			window.location = rutaActual + rutaBuscador;

		}

	}


});