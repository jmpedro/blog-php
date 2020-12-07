
<div class="container-fluid bg-white">

    <div class="container py-4">
    
        <div class="row">

            <div class="col-12 col-lg-6">
            
                <?php echo $dataBlog["sobre_mi_completo"]; ?>
            
            </div>

            <div class="col-12 col-lg-6">
            
                <h4 class="mt-4">Contáctenos</h4>
                
                <form method="post">
                
                    <input type="text" name="nombreContacto" class="form-control my-3" placeholder="Nombre y Apellidos" required>
                    <input type="email" name="emailContacto" class="form-control my-3" placeholder="Correo electrónico" required>
                    <textarea name="mensajeContacto" class="form-control my-3" cols="30" rows="10" required></textarea>
                    <input type="submit" value="Enviar" class="btn btn-primary">

                    <?php
						
                        $enviarCorreo = ControladorCorreo::ctrEnviarCorreo();

                        // Controlamos la respuesta que venga al enviar la opinion con notie.js
                        if( $enviarCorreo != "" ) {

                            echo '<script>
                                
                                if(window.history.replaceState) {

                                    window.history.replaceState( null, null, window.location.href );

                                }

                            </script>';

                            if( $enviarCorreo == "ok" ) {

                                echo '<div class="alert alert-success">Su mensaje ha sido enviado correctamente</div>';

                            }else if( $enviarCorreo == "error-formato" ) {

                                echo '<div class="alert alert-danger">No se permiten carácteres especiales</div>';

                            }else {

                                echo '<div class="alert alert-danger">Error, inténtelo de nuevo</div>';

                            }

                        }


                    ?>

                </form>
            
            </div>

        </div>

    </div>

</div>
