
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
var rutaActual = $("#rutaActual").val();
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