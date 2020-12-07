<!--=====================================
FOOTER
======================================-->

<footer class="container-fluid py-5 d-none d-md-block">
	
	<div class="container">
		
		<div class="row">

		<!-- GRID CATEGORÍAS FOOTER -->
			
			<div class="col-md-7 col-lg-6">
				
				<div class="p-1 bg-white gridFooter">

					<div class="container p-0">

						<div class="d-flex">

							<div class="d-flex flex-column columna1">
							
								<figure class="p-2 photo1" m-0 vinculo="<?php echo $dataCategorias[0]["ruta_categoria"]; ?>"
								style="background:url(<?php echo $dataBlog["dominio"].$dataCategorias[0]["img_categoria"]; ?>)">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">
										<?php echo $dataCategorias[0]["descripcion_categoria"]; ?>
									</p>

								</figure>

								<figure class="p-2 photo2" m-0 vinculo="<?php echo $dataCategorias[4]["ruta_categoria"]; ?>"
								style="background:url(<?php echo $dataBlog["dominio"].$dataCategorias[4]["img_categoria"]; ?>)">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">
										<?php echo $dataCategorias[4]["descripcion_categoria"]; ?>
									</p>

								</figure>
							</div>

							<div class="d-flex flex-column flex-fill columna2">

							<div class="d-block d-md-flex">

								<figure class="p-2 flex-fill photo3" m-0 vinculo="<?php echo $dataCategorias[1]["ruta_categoria"]; ?>"
								style="background:url(<?php echo $dataBlog["dominio"].$dataCategorias[1]["img_categoria"]; ?>)">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">
										<?php echo $dataCategorias[1]["descripcion_categoria"]; ?>
									</p>

								</figure>

								<figure class="p-2 flex-fill photo4" m-0 vinculo="<?php echo $dataCategorias[3]["ruta_categoria"]; ?>"
								style="background:url(<?php echo $dataBlog["dominio"].$dataCategorias[3]["img_categoria"]; ?>)">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">
										<?php echo $dataCategorias[3]["descripcion_categoria"]; ?>
									</p>

								</figure>

								</div>

								<figure class="p-2 photo5" m-0 vinculo="<?php echo $dataCategorias[2]["ruta_categoria"]; ?>"
								style="background:url(<?php echo $dataBlog["dominio"].$dataCategorias[2]["img_categoria"]; ?>)">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">
										<?php echo $dataCategorias[2]["descripcion_categoria"]; ?>
									</p>

								</figure>

							</div>

						</div>

					</div>

				</div>
					
			</div>

			<div class="d-none d-lg-block col-lg-1 col-xl-2"></div>

			<!-- NEWLETTER -->

			<div class="col-md-5 col-lg-5 col-xl-4 pt-5">
				
				<h6 class="text-white">Inscríbete en nuestro newletter:</h6>
				
				<!-- Begin Mailchimp Signup Form -->
				<div id="mc_embed_signup">

					<form action="https://gmail.us7.list-manage.com/subscribe/post?u=55c9b6dd2066351c065f754ab&amp;id=5d6222ee24" 
					method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

						<div class="mc-field-group">
						
							<div class="input-group my-4">
								
								<input type="text" class="form-control required email" id="mce-EMAIL" placeholder="Ingresa tu Email">

								<div class="input-group-append">
									
									<span class="input-group-text bg-dark text-white">
									
										<input type="submit" value="Subscribirse" name="subscribe" id="mc-embedded-subscribe" class="btn btn-dark btn-sm text-white p-0">

									</span>

								</div>

							</div>
							
							<div id="mce-responses" class="clear">

								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>

							</div>  
							<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_55c9b6dd2066351c065f754ab_5d6222ee24" tabindex="-1" value=""></div>

						</div>

					</form>

				</div>

				<div class="p-0 w-100 pt-2">
				
					<ul class="d-flex justify-content-left p-0">
						
						<li>
							<a href="https://www.facebook.com" target="_blank">
								<i class="fab fa-facebook-f lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-instagram lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-twitter lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-youtube lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-snapchat-ghost lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

					</ul>

				</div>

			</div>

		</div>

	</div>

</footer>