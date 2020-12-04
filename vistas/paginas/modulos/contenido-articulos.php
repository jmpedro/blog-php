<?php

	if( isset($ruta[1]) ) {

		$articulo = ControladorBlog::ctrTraerDatosArticulos(0, 1, "p_claves_articulo", $ruta[1]);
		
		// LO SIGUIENTE DEVUELVE TODOS LOS ARTICULOS DE UNA MISMA CATEGORIA
		$totalArticulos = ControladorBlog::ctrGetAllArticulos("id_cat", $articulo[0]["id_cat"]);
		// INSTANCIAMOS EL OBJETO DE LAS OPINIONES
		$opiniones = ControladorBlog::ctrMostrarOpiniones("id_art", $articulo[0]["id_articulo"]);
		// ACTUALIZAMOS LAS VISITAS QUE TIENE CADA ARTICULO POR SU ID
		$cantidad_visitas = ControladorBlog::ctrActualizarVisitas($articulo[0]["id_articulo"]);

	}

	/* FUNCION PARA LIMITAR EL FOREACH */
	function limitarForEach($array, $limite) {

		foreach ($array as $key => $value) {
		
			if( !$limite-- )return;
			
			// yield pausa el bucle y devuelve el resultado, despues continua con las iteraciones
			yield $key => $value;
		}

	}

?>

<!--=====================================
CONTENIDO ARTÍCULO
======================================-->

<div class="container-fluid bg-white contenidoInicio py-2 py-md-4">
	
	<div class="container">

		<!-- BREADCRUMB -->

		<a href="categorias.html">
			
			<button class="d-block d-sm-none btn btn-info btn-sm mb-2">
			
				REGRESAR 

			</button>

		</a>

		<ul class="breadcrumb bg-white p-0 mb-2 mb-md-4 breadArticulo">

			<li class="breadcrumb-item inicio"><a href="<?php echo $dataBlog["dominio"]; ?>">Inicio</a></li>

			<li class="breadcrumb-item"><a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]; ?>"><?php echo $articulo[0]["titulo_categoria"]; ?></a></li>

			<li class="breadcrumb-item active"><?php echo $articulo[0]["titulo_articulo"]; ?></li>

		</ul>
		
		<div class="row">
			
			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
				
				<!-- ARTÍCULO 01 -->

				<div class="container">

					<div class="d-flex">
					
						<div class="fechaArticulo"><?php echo $articulo[0]["fecha_articulo"]; ?></div>

						<h3 class="tituloArticulo text-right text-muted pl-3 pt-lg-2"><?php echo $articulo[0]["titulo_articulo"]; ?></h3>

					</div>

					<?php

						/* Como las imagenes del contenido en la base de datos hay que añadirle el valor
						   de la ruta completa del blog, buscamos con str_replace y lo añadimos */
						$old_value = "vistas/img";
						$new_value = $dataBlog["dominio"].$old_value;
						echo str_replace($old_value, $new_value, $articulo[0]["contenido_articulo"]);


					?>
					
					<!-- COMPARTIR EN REDES -->

					<div class="float-right my-3 btnCompartir">
						
						<div class="btn-group text-secondary">

							Si te gusto compartelo:

						</div>
						
						<div class="btn-group">
							<!-- Con la clase social-share y el atributo data-share podemos conseguir que nuestros articulos
								 sean compartidos en redes como Facebook o Twitter -->
							<button type="button" class="btn border-0 text-white social-share" style="background: #1475E0"
								data-share="facebook">
								
								<span class="fab fa-facebook pr-1"></span>

								Facebook

							</button>

						</div>

						<div class="btn-group">
							
							<button type="button" class="btn border-0 text-white social-share" style="background: #00A6FF"
								data-share="twitter">
								
								<span class="fab fa-twitter pr-1"></span>

								Twitter

							</button>

						</div>

					</div>

					<!-- AVANZAR - RETROCEDER -->

					<div class="clearfix"></div>

					<!-- ETIQUETAS -->

					<div>

						<h4>Etiquetas</h4>
	
							<a href="#suramerica" class="btn btn-secondary btn-sm m-1">suramerica</a> 		
						
							<a href="#colombia" class="btn btn-secondary btn-sm m-1">colombia</a> 							
						
							<a href="#peru" class="btn btn-secondary btn-sm m-1">peru</a> 							
						
							<a href="#argentina" class="btn btn-secondary btn-sm m-1">argentina</a> 							
						
							<a href="#chile" class="btn btn-secondary btn-sm m-1">chile</a> 							
						
							<a href="#brasil" class="btn btn-secondary btn-sm m-1">brasil</a> 							
						
							<a href="#ecuador" class="btn btn-secondary btn-sm m-1">ecuador</a> 							
						
							<a href="#venezuela" class="btn btn-secondary btn-sm m-1">venezuela</a> 
							
							<a href="#paraguay" class="btn btn-secondary btn-sm m-1">paraguay</a> 
							
							<a href="#uruguay" class="btn btn-secondary btn-sm m-1">uruguay</a> 
						
							<a href="#bolivia" class="btn btn-secondary btn-sm m-1">bolivia</a> 
																		
					</div>


					<?php

						foreach ($totalArticulos as $key => $value) {
							if( $articulo[0]["id_articulo"] == $value["id_articulo"] ) {

								$posicion = $key;
							}

						}
						
					?>

				 	<div class="d-md-flex justify-content-between my-3 d-none">
					 
					    <?php if( ($posicion - 1) > 0 ): ?>
							
							<a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]."/".$totalArticulos[($posicion - 1)]["p_claves_articulo"]; ?>">
								Leer artículo anterior
							</a>

					    <?php endif ?>
					    
						<?php if( ($posicion + 1) < count($totalArticulos) ): ?>
							
							<a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]."/".$totalArticulos[($posicion + 1)]["p_claves_articulo"]; ?>">
								Leer artículo siguiente
							</a>

					    <?php endif ?>

				  	</div>

				  	<!-- DESLIZADOR DE ARTÍCULOS -->

				  	<section class="jd-slider deslizadorArticulos my-4">
				  		
						<div class="slide-inner">
							
							<ul class="slide-area">
								
								<?php foreach( $totalArticulos as $key => $value): ?>

									<li class="px-3">
										
										<a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]."/".$value["p_claves_articulo"]; ?>" 
											class="text-secondary">

											<img src="<?php echo $dataBlog["dominio"].$value["portada_articulo"]; ?>" alt="<?php echo $value["titulo_articulo"]; ?>" class="img-fluid">
										
											<h6 class="py-2"><?php echo $value["titulo_articulo"]; ?></h6>

										</a>

										<p class="small"><?php echo substr($value["descripcion_articulo"], 0, -110)."..."; ?></p>

									</li>
									
								<?php endforeach ?>

							</ul>

							<a class="prev" href="#">

				                <i class="fas fa-angle-left text-muted"></i>

				            </a>

				            <a class="next" href="#">

				                <i class="fas fa-angle-right text-muted"></i>

				            </a>

						</div>

						 <div class="controller">

				            <div class="indicate-area"></div>

				        </div>

				  	</section>

				  	<!-- BLOQUE DE OPINIONES -->

				  	<h3 style="color:#8e4876">Opiniones</h3>

				  	<hr style="border: 1px solid #79FF39">

					<?php if( count($opiniones) > 0 ): ?>
						
						
						<?php foreach($opiniones as $key => $value): ?>

							<?php if( $value["aprobacion_opinion"] == 1 ): ?>

								<div class="row opiniones">
								
									<div class="col-3 col-sm-4 col-lg-2 p-2">
									
										<img src="<?php echo $dataBlog["dominio"].$value["foto_opinion"]; ?>" class="img-thumbnail">	

									</div>

									<!-- PREGUNTA U OPINION DEL USUARIO -->
									<div class="col-9 col-sm-8 col-lg-10 p-2 text-muted">
										
										<p><?php echo $value["contenido_opinion"]; ?></p>

										<?php
											$formatoFecha = strtotime($value["fecha_opinion"]);
											$fecha_opinion = date('d.m.Y', $formatoFecha);
										?> 

										<span class="small float-right">
											<?php echo $value["nombre_opinion"]; ?> | <?php echo $fecha_opinion; ?>
										</span>

									</div>	

									<!-- RESPUESTA DE LOS ADMINISTRADORES -->
									<?php if( $value["respuesta_opinion"] != null ): ?>

										<div class="col-9 col-sm-8 col-lg-10 p-2 text-muted">
										
											<p><?php echo $value["respuesta_opinion"]; ?></p>

											<?php
												$formatoFecha = strtotime($value["fecha_respuesta"]);
												$fecha_opinion = date('d.m.Y', $formatoFecha);
											?> 

											<span class="small float-right"> <?php echo $value["nombre_admin"] ?> | <?php echo $fecha_opinion ?></span>

										</div>

										<div class="col-3 col-sm-4 col-lg-2 p-2">
									
											<img src="<?php echo $dataBlog["dominio"].$value["foto_admin"]; ?>" class="img-thumbnail">	

										</div>

									<?php endif ?>

								</div>
								
							<?php endif ?>

						<?php endforeach ?>
					
					<?php else: ?>

						<p class="pl-3 text-secondary">¡Este artículo no tiene opiniones!</p>

					<?php endif ?>
					
					<hr style="border: 1px solid #79FF39">

					<!-- FORMULARIO DE OPINIONES -->
					
					<form method="post" enctype="multipart/form-data">

						<input type="hidden" name="id_art" value="<?php echo $articulo[0]["id_articulo"]; ?>">
						<label class="text-muted lead">¿Qué tal te pareció el artículo?</label>

						<div class="row">
							
							<div class="col-12 col-md-8 col-lg-9">
								
								<div class="input-group-lg">
									
									<input type="text" class="form-control my-3" placeholder="Tu nombre" name="nombre_opinion">

									<input type="email" class="form-control my-3" placeholder="Tu email" name="correo_opinion">

								</div>

							</div>

							<input type="file" class="d-none" id="fotoOpinion" name="fotoOpinion" />
							<label for="fotoOpinion" class="d-none d-md-block col-md-4 col-lg-3">
								
								<img src="<?php echo $dataBlog["dominio"]; ?>vistas/img/subirFoto.png" class="img-fluid mt-md-3 mt-xl-2 prevFotoOpinion">

							</label>

						</div>	

						<textarea class="form-control my-3" rows="7" placeholder="Escribe aquí tu mensaje" name="contenido_opinion"></textarea>
						
						<input type="submit" class="btn btn-dark btn-lg btn-block" value="Enviar">

						<?php
						
							$enviarOpiniones = ControladorBlog::ctrEnviarOpinion();

							// Controlamos la respuesta que venga al enviar la opinion con notie.js
							if( $enviarOpiniones != "" ) {

								echo '<script>
									
									if(window.history.replaceState) {

										window.history.replaceState( null, null, window.location.href );

									}

								</script>';

								if( $enviarOpiniones == "ok" ) {

									echo '<div class="alert alert-success">La opinion ha sido enviada correctamente</div>';

								}else if( $enviarOpiniones == "error" ) {

									echo '<div class="alert alert-danger">No se permiten carácteres especiales</div>';

								}else {

									echo '<div class="alert alert-danger">El archivo debe tener un formato jpg o png </div>';

								}

							}


						?>

					</form>

					<!-- PUBLICIDAD -->

					<img src="<?php echo $dataBlog["dominio"]; ?>vistas/img/ad01.jpg" class="img-fluid my-3 d-block d-md-none" width="100%">


				</div>

			</div>

			<!-- COLUMNA DERECHA -->

			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">		

				<!-- ARTÍCULOS RECIENTES -->

				<div class="my-4">
					
					<h4>Artículos Recientes</h4>

					<?php foreach( limitarForEach($totalArticulos, 3) as $key => $value ): ?>

						<div class="d-flex my-3">
							
							<div class="w-100 w-xl-50 pr-3 pt-2">
								
								<a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]."/".$value["p_claves_articulo"]; ?>">

									<img src="<?php echo $dataBlog["dominio"].$value["portada_articulo"]; ?>" alt="<?php echo $value["titulo_articulo"]; ?>" class="img-fluid">

								</a>

							</div>

							<div>

								<a href="<?php echo $dataBlog["dominio"].$articulo[0]["ruta_categoria"]."/".$value["p_claves_articulo"]; ?>" class="text-secondary">

									<p class="small"><?php echo substr($value["descripcion_articulo"], 0, -150)."..."; ?></p>

								</a>

							</div>

						</div>

					<?php endforeach ?>
					
					
				<!-- PUBLICIDAD -->

				<div class="mb-4">
					
					<img src="<?php echo $dataBlog["dominio"]; ?>vistas/img/ad03.png" class="img-fluid">

				</div>

				<div class="my-4">
					
					<img src="<?php echo $dataBlog["dominio"]; ?>vistas/img/ad02.jpg" class="img-fluid">

				</div>	

				<div class="my-4">
					
					<img src="<?php echo $dataBlog["dominio"]; ?>vistas/img/ad06.png" class="img-fluid">

				</div>	
				
			</div>

		</div>

	</div>

</div>