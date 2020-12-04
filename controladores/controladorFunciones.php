<?php

    class ControladorFunciones{

        // Creamos una funcion para obtener las palabras clave para usarlas como metadatos
        static public function ctrTraerPalabrasClave($palabras_clave) {

            $new_palabras_clave = json_decode($palabras_clave, true);
            $p_clave = "";

            foreach ($new_palabras_clave as $key => $value) {

                $p_clave .= $value.", ";

            }

            $p_clave = substr($p_clave, 0, -2);

            return $p_clave;

        }

        // Creamos una función para declarar los metadatos en función de la página en la que nos encontremos
        public function ctrAsignarMetadatos( $titulo, $descripcion, $palabras_clave, $checkCategorias ) {

            if( $checkCategorias == true ) {
                echo'<title>'.$titulo.' | '.$descripcion.'</title>

                    <meta name="title" content="'.$titulo.'">
                
                    <meta name="description" content="'.$descripcion.'">';

                    $p_clave = $this::ctrTraerPalabrasClave($palabras_clave);

                echo '<meta name="keywords" content="'.$p_clave.'">';
                return;

            }else {
                echo'<title>'.$titulo.'</title>

                    <meta name="title" content="'.$titulo.'">
                
                    <meta name="description" content="'.$descripcion.'">';

                    $p_clave = $this::ctrTraerPalabrasClave($palabras_clave);

                echo '<meta name="keywords" content="'.$p_clave.'">';

            }
        }

        // Creamos una función para asignar los metadatos de Open Graph
        public function ctrAsignarMetadatosOG( $titulo, $descripcion, $url, $imagen ) {

            echo '<meta property="og:type" content="Type">
			<meta property="og:title" content="'.$titulo.'">
			<meta property="og:description" content="'.$descripcion.'">
			<meta property="og:url" content="'.$url.'">
			<meta property="og:site_name" content="'.$titulo.'">
			<meta property="og:image" content="'.$imagen.'">';

        }
    }