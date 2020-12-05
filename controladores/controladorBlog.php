<?php

    class ControladorBlog {

        static public function ctrTraerDatosBlog() {

            $table = "blog";

            $response = ModeloBlog::mdlTraerDatosBlog($table);

            return $response;

        }

        static public function ctrTraerDatosCategorias($item, $value) {

            $table = "categorias";

            $response = ModeloBlog::mdlTraerDatosCategorias($table, $item, $value);

            return $response;

        }

        // ARTICULOS
        static public function ctrTraerDatosArticulos($desde, $cantidadArticulos, $item, $value) {

            $table1 = "categorias";
            $table2 = "articulos";

            $response = ModeloBlog::mdlTraerDatosArticulos($table1, $table2, $desde, $cantidadArticulos, $item, $value);

            return $response;

        }

        // TODOS LOS ARTICULOS
        static public function ctrGetAllArticulos($item, $value) {

            $table = "articulos";

            $response = ModeloBlog::mdlGetAllArticulos($table, $item, $value);

            return $response;

        }

        // TODOS LAS OPINONES
        static public function ctrMostrarOpiniones($item, $value) {

            $table1 = "opiniones";
            $table2 = "administradores";

            $response = ModeloBlog::mdlMostrarOpiniones($table1, $table2, $item, $value);

            return $response;

        }

        // ENVIAR OPINION
        static public function ctrEnviarOpinion() {

            if( isset($_POST["nombre_opinion"]) ) {

                if( preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nombre_opinion"]) && 
                    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-z-A-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-z-A-Z0-9_]+)+$/', $_POST["correo_opinion"]) && 
                    preg_match('/^[=\\$\\:\\;\\*\\.\\¿\\?\\¡\\!\\,\\a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["contenido_opinion"]) ) {

                    /* VALIDACION FOTO DEL LADO DEL SERVIDOR */
                    // Comprobamos si vienen datos del archivo de la foto y son diferentes de empty
                    if( isset($_FILES["fotoOpinion"]["tmp_name"]) && !empty($_FILES["fotoOpinion"]["tmp_name"]) ) {

                        // Lo siguiente devuelve dos valores: 0 y 1 que son el ancho y el alto de la imagen
                        list($ancho, $alto) = getimagesize($_FILES["fotoOpinion"]["tmp_name"]);

                        // Asignamos un nuevo ancho y alto de la imagen
                        $nuevoAncho = 128;
                        $nuevoAlto = 128;

                        // Asignamos el directorio donde se guardarán las imagenes en la base de datos
                        $directorio = "vistas/img/usuarios/";

                        // Comprobamos el formato de archivo
                        if( $_FILES["fotoOpinion"]["type"] == "image/jpeg" ) {

                            $aleatorio = mt_rand(100, 9999);

                            // Elegimos la ruta donde se va a guardar
                            $ruta = $directorio.$aleatorio.".jpg";
                            // Indicamos el origen y el destino
                            $origen = imagecreatefromjpeg($_FILES["fotoOpinion"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            // Creamos la nueva imagen con sus nuevas medidas
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            //Por ultimo, creamos la imagen y le indicamos donde vamos a guardar la imagen.
                            imagejpeg($destino, $ruta);

                        }else if( $_FILES["fotoOpinion"]["type"] == "image/png" ) {

                            $aleatorio = mt_rand(100, 9999);

                            // Elegimos la ruta donde se va a guardar
                            $ruta = $directorio.$aleatorio.".png";
                            // Indicamos el origen y el destino
                            $origen = imagecreatefrompng($_FILES["fotoOpinion"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            // Como es .png, tenemos que poner su fondo transparente
                            imagealphablending($destino, FALSE);
                            imagesavealpha($destino, TRUE);

                            // Creamos la nueva imagen con sus nuevas medidas
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            //Por ultimo, le indicamos donde vamos a guardar la imagen.
                            imagepng($destino, $ruta);

                        }else {

                            return "error-formato";

                        }
                    }else {
                        
                        $ruta = "vistas/img/default.png";

                    }
                    
                    $table = "opiniones";
                    $data = array("id_art" => $_POST["id_art"],
                                  "nombre_opinion" => $_POST["nombre_opinion"],
                                  "correo_opinion" => $_POST["correo_opinion"],
                                  "contenido_opinion" => $_POST["contenido_opinion"],
                                  "foto_opinion" => $ruta,
                                  "fecha_opinion" => date('Y-m-d'),
                                  "id_adm" => 1,
                                  "aprobacion_opinion" => 1);
                                  
                    $response = ModeloBlog::mdlEnviarOpinion($table, $data);
                    return $response;


                }else {

                    return "error";

                }

            }

        }

        // ACTUALIZAMOS LAS VISITAS DE LOS ARTICULOS
        static public function ctrActualizarVisitas($idArticulo) {

            $articulo = ControladorBlog::ctrTraerDatosArticulos( 0, 1, "id_articulo", $idArticulo );
            $newsVisitas = $articulo[0]["vistas_articulo"] + 1;

            $table = "articulos";
            $response = ModeloBlog::mdlActualizarVisitas($table, $newsVisitas, $idArticulo);

            return $response;
        }

        // OBTENEMOS LOS ARTICULOS DESTACADOS
        static public function ctrMostrarArticulosDestacados($item, $value) {

            $table = "articulos";

            $response = ModeloBlog::mdlMostrarArticulosDestacados($table, $item, $value);

            return $response;

        }

        // HACEMOS EL FILTRO PARA OBTENER ARTICULOS POR EL BUSCADOR
        static public function ctrBuscador($desde, $cantidad, $busqueda) {

            $table1 = "categorias";
            $table2 = "articulos";

            $response = ModeloBlog::mdlBuscador($table1, $table2, $desde, $cantidad, $busqueda);

            return $response;

        }
        
        // OBTENEMOS TODOS LOS ARTICULOS QUE SE ENCUENTREN EN EL BUSCADOR
        static public function ctrBuscadorArticulosTotales($busqueda) {

            $table = "articulos";
            $response = ModeloBlog::mdlBuscadorArticulosTotales($table, $busqueda);
            return $response;

        }

        // OBTENEMOS TODOS LOS ANUNCIOS 
        static public function ctrMostrarAnuncios($value) {

            $table = "anuncios";
            $response = ModeloBlog::mdlMostrarAnuncios($table, $value);
            return $response;

        }
    }