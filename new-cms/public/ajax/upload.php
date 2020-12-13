<?php

    if( isset($_FILES["file"]["name"]) ) {

        // comprobamos que se pueda crear mirando si devuelve algun error
        if( !$_FILES["file"]["error"] ) {

            $titulo = md5(rand(100, 300));
            $extension = explode(".", $_FILES["file"]["name"]);
            $archivo = $titulo.".".$extension[1];

            $origen = $_FILES["file"]["tmp_name"];
            $destino = "../img/temp/".$archivo;
            
            move_uploaded_file($origen, $destino);
            echo $_POST["ruta"]."/img/temp/".$archivo;

        }else {

            echo '¡Ooops!, el archivo temporal no se pudo crear '.$_FILES["file"]["error"];

        }

    }