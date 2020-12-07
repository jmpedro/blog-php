<?php

	// INSTANCIAMOS EL OBJETO PARA BLOG
	$dataBlog = ControladorBlog::ctrTraerDatosBlog();
	// INSTANCIAMOS EL OBJETO PARA CATEGORIAS
	$dataCategorias = ControladorBlog::ctrTraerDatosCategorias(null, null);
	// INSTANCIAMOS EL OBJETO PARA OBTENER LOS ARTICULOS 
	$dataArticuloCat = ControladorBlog::ctrTraerDatosArticulos(0, 5, null, null);
	// INSTANCIAMOS EL OBJETO PARA OBTENER TODOS LOS ARTICULOS
	$totalArticulos = ControladorBlog::ctrGetAllArticulos(null, null);
	// ceil() => Redondea siempre hacia el mayor
	// floor() => Redondea siempre hacia el menor
	// round() => Redondea de forma normal
	$totalPaginas = ceil(count($totalArticulos)/5);
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<!-- ASIGAMOS LOS METADATOS DE LAS PÁGINAS INICIO, CATEGORIAS Y ARTICULOS -->
	<?php 

		if( isset($_GET["pagina"]) ) {

			$ruta = explode("/", $_GET["pagina"]);

			foreach ($dataCategorias as $key => $value) {

				if( isset($ruta[1]) ) {
					foreach ($totalArticulos as $key => $valueArticulos) {
				
						if( !is_numeric($ruta[1]) && $valueArticulos["p_claves_articulo"] == $ruta[1] ) {
							$datos = new ControladorFunciones();
							$datos->ctrAsignarMetadatos($dataBlog["titulo"], 
														$valueArticulos["titulo_articulo"],
														$valueArticulos["ruta_articulo"],
														true);
		
							/* METADATOS DE OPEN GRAPH */
							$datos -> ctrAsignarMetadatosOG($dataBlog["titulo"], 
							$valueArticulos["titulo_articulo"], 
							/* Lo que hace $_SERVER["HTTP_HOST"] es indicar http://localhost y con $_SERVER["REQUEST_URI"]
							   indicamos el contenido que queda, es decir, las subcarpetas /blog-php/europa/...   */
							$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"], 
							$dataBlog["dominio"].$valueArticulos["portada_articulo"]);

							break;											
						}
					}
					break;
				}
				else if( !is_numeric($ruta[0]) && $value["ruta_categoria"] == $ruta[0] ) {

					$datos = new ControladorFunciones();
					$datos->ctrAsignarMetadatos($dataBlog["titulo"], 
												$value["descripcion_categoria"],
												$value["p_claves_categoria"],
												true);

					/* METADATOS DE OPEN GRAPH */
					$datos -> ctrAsignarMetadatosOG($dataBlog["titulo"], 
					$value["titulo_categoria"], 
					$dataBlog["dominio"].$value["ruta_categoria"], 
					$dataBlog["dominio"].$value["img_categoria"]);

					break;											

				}
			}

			

		}else {

			$datos = new ControladorFunciones();
			$datos->ctrAsignarMetadatos($dataBlog["titulo"], 
										$dataBlog["descripcion"],
										$dataBlog["palabras_clave"],
										false);

			/* METADATOS DE OPEN GRAPH */
			$datos -> ctrAsignarMetadatosOG($dataBlog["titulo"], $dataBlog["titulo"], 
											$dataBlog["dominio"], $dataBlog["dominio"].$dataBlog["portada"]);

		}

	?>

	<link rel="icon" href="<?php echo $dataBlog["dominio"]; ?>vistas/img/icono.jpg">

	<!--=====================================
	PLUGINS DE CSS
	======================================-->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Chewy|Open+Sans:300,400" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	
	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<link rel="stylesheet" href="<?php echo $dataBlog["dominio"]; ?>vistas/css/plugins/jquery.jdSlider.css">

	<link rel="stylesheet" href="<?php echo $dataBlog["dominio"]; ?>vistas/css/style.css">

	<!--=====================================
	PLUGINS DE JS
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="<?php echo $dataBlog["dominio"];?>vistas/js/plugins/jquery.jdSlider-latest.js"></script>
	
	<!-- pagination -->
	<!-- http://josecebe.github.io/twbs-pagination/ -->
	<script src="<?php echo $dataBlog["dominio"]; ?>vistas/js/plugins/pagination.min.js"></script>

	<!-- scrollup -->
	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<!-- https://easings.net/es# -->
	<script src="<?php echo $dataBlog["dominio"];?>vistas/js/plugins/scrollUP.js"></script>
	<script src="<?php echo $dataBlog["dominio"];?>vistas/js/plugins/jquery.easing.js"></script>
	<script src="<?php echo $dataBlog["dominio"];?>vistas/js/plugins/shape.share.js"></script>

</head>

<body>

<?php 

	/*=============================================
	Módulos fijos superiores
	=============================================*/	

	include "paginas/modulos/cabecera.php";
	include "paginas/modulos/redes-sociales-movil.php";	
	include "paginas/modulos/buscador-movil.php";	
	include "paginas/modulos/menu.php";	

	/*=============================================
	Navegar entre páginas
	=============================================*/	
	$validarRuta = "";

	if( isset($_GET["pagina"]) ) {

		$ruta = explode("/", $_GET["pagina"]);

		if( is_numeric($ruta[0]) ) {

			$cantidad = 5;
			$desde = ($ruta[0] - 1) * $cantidad;
			$dataArticuloCat = ControladorBlog::ctrTraerDatosArticulos($desde, $cantidad, null, null);

		}else {

			foreach ($dataCategorias as $key => $value) {

				if( $ruta[0] == $value["ruta_categoria"] ) {
	
					$validarRuta = "categorias";
					break;
	
				}else if( $ruta[0] == "sobre-mi" ) {
				
					$validarRuta = "sobre-mi";
					break;
					
				}else {

					$validarRuta = "buscador";

				}
				
			}

		}

		/*=============================================
		Rutas de articulos o paginacion de categorias
		=============================================*/	

		if( isset($ruta[1]) ) {

			if( is_numeric($ruta[1]) ) {

				$cantidad = 5;
				$desde = ($ruta[1] - 1) * $cantidad;
				$dataArticuloCat = ControladorBlog::ctrTraerDatosArticulos($desde, $cantidad, null, null);

			}else {

				foreach ($totalArticulos as $key => $value) {

					if( $ruta[1] == $value["p_claves_articulo"] ) {

						$validarRuta = "articulos";
						break;

					}

				}

			}

		}
		
		if( $validarRuta == "categorias") {

			include "paginas/categorias.php";

		}else if( $validarRuta == "buscador" ){

			include "paginas/buscador.php";


		}else if( $validarRuta == "sobre-mi" ){

			include "paginas/sobre-mi.php";


		}else if( $validarRuta == "articulos" ){

			include "paginas/articulos.php";

		}else if( is_numeric($ruta[0]) && $ruta[0]<= $totalPaginas || ( isset($ruta[1]) && is_numeric($ruta[1])) ){

			include "paginas/inicio.php";

		}else {

			include "paginas/error404.php";

		}

	}
	else {

		include "paginas/inicio.php";

	}
	

	/*=============================================
	Módulos fijos inferiores
	=============================================*/	

	include "paginas/modulos/footer.php";


?>

	<input type="hidden" id="rutaActual" value="<?php echo $dataBlog["dominio"]; ?>">

	<script src="<?php echo $dataBlog["dominio"]; ?>vistas/js/script.js"></script>
	<script src="https://unpkg.com/notie"></script>

</body>
</html>