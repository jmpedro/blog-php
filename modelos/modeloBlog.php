<?php

    require_once "connection.php";

    class ModeloBlog {

        /* MÉTODO PARA TRAER DATOS DEL BLOG */
        static public function mdlTraerDatosBlog($table) {

            $stmt = Connection::connect()->prepare("SELECT *  FROM $table");
            $stmt->execute();
            $response = $stmt->fetch();

            return $response;

            $stmt->close();
            $stmt = null;

        }

        /* MÉTODO PARA OBTENER LA LISTA DE TODAS LAS CATEGORIAS */
        static public function mdlTraerDatosCategorias($table, $item, $value) {

            if( $item != null && $value != null ) {

                $stmt = Connection::connect()->prepare("SELECT *  FROM $table WHERE $item = :$item");
                $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR );

                $stmt->execute();
                $response = $stmt->fetchAll();

                return $response;

            }else {

                $stmt = Connection::connect()->prepare("SELECT *  FROM $table");
                $stmt->execute();
                $response = $stmt->fetchAll();
    
                return $response;

            }

            $stmt->close();
            $stmt = null;

        }

        /* MÉTODO PARA OBTENER LA LISTA DE LOS 5 PRIMEROS ARTICULOS */
        static public function mdlTraerDatosArticulos($table1, $table2, $desde,  $cantidadArticulos, $item, $value) {

            /* OBTENEMOS LAS DOS TABLAS, CAMBIAMOS LA FECHA DE FORMATO Y ORDENAMOS LA LISTA OBTENIDA POR EL ID DE 
                ARTICULO Y LO ORDENAMOS POR EL MAS RECIENTE */ 
            if( $item == null && $value == null ) {

                $stmt = Connection::connect()->prepare("SELECT $table1.*, $table2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y')
                AS fecha_articulo FROM $table1 INNER JOIN $table2 ON $table1.id_categoria = $table2.id_cat ORDER BY 
                $table2.id_articulo DESC LIMIT $desde, $cantidadArticulos");
    
                $stmt->execute();
    
                $response = $stmt->fetchAll();
    
                return $response;

            }else {

                $stmt = Connection::connect()->prepare("SELECT $table1.*, $table2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y')
                AS fecha_articulo FROM $table1 INNER JOIN $table2 ON $table1.id_categoria = $table2.id_cat WHERE
                $item = :$item ORDER BY $table2.id_articulo DESC LIMIT $desde, $cantidadArticulos");

                $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

                $stmt->execute();

                $response = $stmt->fetchAll();

                return $response;

            }

            $stmt->close();
            $stmt = null;

        }
        
        /* MÉTODO PARA OBTENER TODOS LOS ARTÍCULOS */ 
        static public function mdlGetAllArticulos($table, $item, $value) {

            if( $item == null && $value == null ) {

                $stmt = Connection::connect()->prepare("SELECT *  FROM $table");
                $stmt->execute();
                $response = $stmt->fetchAll();
    
                return $response;

            }else {

                $stmt = Connection::connect()->prepare("SELECT *  FROM $table WHERE $item = :$item ");
                $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

                $stmt->execute();
                $response = $stmt->fetchAll();

                return $response;

            }
            

            $stmt->close();
            $stmt = null;

        }

        /* MÉTODO PARA OBTENER TODAS LAS OPINIONES DE UN ARTICULO */ 
        static public function mdlMostrarOpiniones($table1, $table2, $item, $value) {

            $stmt = Connection::connect()->prepare("SELECT $table1.*, $table2.* FROM $table1 INNER JOIN 
            $table2 ON $table1.id_adm = $table2.id_admin WHERE $item = :$item ORDER BY $table1.fecha_opinion DESC");

            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);

            $stmt->execute();
            $response = $stmt->fetchAll();

            return $response;
            
            $stmt->close();
            $stmt = null;

        }

        /* MÉTODO PARA ENVIAR UNA OPINION */ 
        static public function mdlEnviarOpinion($table, $data) {

            $stmt = Connection::connect()->prepare("INSERT INTO $table (id_art, nombre_opinion, correo_opinion,
            foto_opinion, contenido_opinion, fecha_opinion, aprobacion_opinion, id_adm) VALUES 
            (:id_art, :nombre_opinion, :correo_opinion, :foto_opinion, :contenido_opinion, :fecha_opinion, :aprobacion_opinion, :id_adm)");

            $stmt -> bindParam(":id_art", $data["id_art"], PDO::PARAM_STR);
            $stmt -> bindParam(":nombre_opinion", $data["nombre_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo_opinion", $data["correo_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":foto_opinion", $data["foto_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":contenido_opinion", $data["contenido_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_opinion", $data["fecha_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":aprobacion_opinion", $data["aprobacion_opinion"], PDO::PARAM_STR);
            $stmt -> bindParam(":id_adm", $data["id_adm"], PDO::PARAM_STR);

            if( $stmt->execute() ) {
                return "ok";
            }else {
                print_r (Connection::connect()->errorInfo());
            }

            $stmt->close();
            $stmt = null;
        }

        // ACTUALIZAMOS LAS VISTAS DE CADA ARTICULO
        static public function mdlActualizarVisitas($table, $newsVisitas, $idArticulo) {

            $stmt = Connection::connect()->prepare("UPDATE $table SET vistas_articulo = :vistas_articulo 
            WHERE id_articulo = :id_articulo ORDER BY fecha_articulo DESC");

            $stmt -> bindParam(":vistas_articulo", $newsVisitas, PDO::PARAM_STR);
            $stmt -> bindParam(":id_articulo", $idArticulo, PDO::PARAM_STR);

            if( $stmt->execute() ) {
                return "ok";
            }else {
                print_r (Connection::connect()->errorInfo());
            }

            $stmt->close();
            $stmt = null;

        }

        // MOSTRAMOS LOS ARTICULOS DESTACADOS
        static public function mdlMostrarArticulosDestacados($table, $item, $value) {

            if( $item != null && $value != null ) {

                $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY 
                vistas_articulo DESC LIMIT 3");

                $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

                if( $stmt->execute() ) {
                    return $stmt->fetchAll();
                }else {
                    print_r (Connection::connect()->errorInfo());
                }
    
                $stmt->close();
                $stmt = null;

            }else {

                $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY 
                vistas_articulo DESC LIMIT 3");

                if( $stmt->execute() ) {

                    return $stmt->fetchAll();

                }else {

                    print_r (Connection::connect()->errorInfo());

                }

                $stmt->close();
                $stmt = null;

            }

        }

        // FILTRAMOS ARTICULOS POR EL BUSCADOR
        static public function mdlBuscador($table1, $table2, $desde, $cantidad, $busqueda) {

            $stmt = Connection::connect()->prepare("SELECT $table1.*, $table2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y')
            AS fecha_articulo FROM $table1 INNER JOIN $table2 ON $table1.id_categoria = $table2.id_cat WHERE 
            titulo_articulo LIKE '%$busqueda%' OR descripcion_articulo LIKE '%$busqueda%' OR contenido_articulo LIKE 
            '%$busqueda%' ORDER BY $table2.fecha_articulo DESC LIMIT $desde, $cantidad ");
            
            if( $stmt->execute() ) {

                return $stmt->fetchAll();

            }else {

                print_r (Connection::connect()->errorInfo());
                
            }

            $stmt->close();
            $stmt = null;

        }

        // OBTENEMOS TODOS LOS ARTICULOS QUE SE ENCUENTREN POR EL BUSCADOR
        static public function mdlBuscadorArticulosTotales($table, $busqueda) {

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE 
            titulo_articulo LIKE '%$busqueda%' OR descripcion_articulo LIKE '%$busqueda%' OR contenido_articulo LIKE 
            '%$busqueda%' ");

            if( $stmt->execute() ) {

                return $stmt->fetchAll();

            }else {

                print_r (Connection::connect()->errorInfo());
                
            }

            $stmt->close();
            $stmt = null;

        }

        // OBTENEMOS TODOS LOS ANUNCIOS 
        static public function mdlMostrarAnuncios($table, $value) {

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE pagina_anuncio = :pagina_anuncio");

            $stmt -> bindParam(":pagina_anuncio", $value, PDO::PARAM_STR);

            if( $stmt->execute() ) {

                return $stmt->fetchAll();

            }else {

                print_r (Connection::connect()->errorInfo());
                
            }

            $stmt->close();
            $stmt = null;

        }
    }