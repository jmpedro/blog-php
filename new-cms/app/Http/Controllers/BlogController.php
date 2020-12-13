<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogModel;

class BlogController extends Controller
{
    
    public function index() {

        // Para indicar que queremos hacer un select de todo lo que hay en la tabla, llamamos a la clase del modelo y al método estático all()
        $blog = BlogModel::all();

        return view('pages.blog', array("blog" => $blog));

    }

    /* Actualizar un registro */ 
    public function update($id, Request $request) {

        // tomamos los datos del blog
        $data = array( 
            "dominio" => $request -> input("dominio"),
            "servidor" => $request -> input("servidor"),
            "titulo" => $request -> input("titulo"),
            "descripcion" => $request -> input("descripcion"),
            "palabras_clave" => $request -> input("palabras_clave"),
            "redes_sociales" => $request -> input("redes_sociales"),
            "logoActual" => $request -> input("logoActual"),
            "portadaActual" => $request -> input("portadaActual"),
            "iconoActual" => $request -> input("iconoActual"),
            "sobre_mi" => $request -> input("sobre_mi"),
            "sobre_mi_completo" => $request -> input("sobre_mi_completo")
        );
        
        // tomamos las imagenes del blog
        $logo = array("logo" => $request -> file("logo"));
        $portada = array("portada" => $request -> file("portada"));
        $icono = array("icono" => $request -> file("icono"));
        

        // validamos que las imagenes no vengan vacías
        if( $logo["logo"] != "" ) {

            $validarLogo = \Validator::make($logo, [
                "logo" => 'required|image|mimes:jpg,jpeg,png|max:2000000'
            ]);

            if($validarLogo->fails()) {
                
                return redirect("/")->with("no-validacion-imagen", "");

            }else {

                // borramos la imagen actual que tenemos para poder poner la nueva
                unlink($data["logoActual"]);

                // generamos un numero aleatorio como nombre de archivo
                $nom_aleatorio = mt_rand(100, 999);

                // generamos la nueva ruta donde guardaremos el archivo en la BBDD
                // usamos ->guessExtension() en laravel para obtener la extension de un archivo
                $rutaLogo = "img/blog/".$nom_aleatorio.".".$logo["logo"]->guessExtension();

                // finalmente, guardamos la imagen en la ruta asignada
                // move_uploaded_file($logo["logo"], $rutaLogo);

                // para ajsutar nosotros mismos los tamaños de la imagen cuando la guardemos:
                // obtenemos las dimensiones originales de la imagen
                list($ancho, $alto) =  getimagesize($logo["logo"]);

                // establecemos un nuevo ancho y alto de la imagen
                $nuevoAncho = 700;
                $nuevoAlto = 200;

                // comprobamos su extension 
                if( $logo["logo"]->guessExtension() == "jpg" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefromjpeg($logo["logo"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // reajustamos el tamaño de la imagen 
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagejpeg($destino, $rutaLogo);

                }
                if( $logo["logo"]->guessExtension() == "png" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefrompng($logo["logo"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // como es png, le quitamos el fondo a la imagen
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);

                    // reajustamos el tamaño de la imagen 
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagepng($destino, $rutaLogo);

                }

            }

        }else {

            // si no se elige ninguna imagen, la ruta de la imagen será la misma 
            $rutaLogo = $data["logoActual"];

        }

        if( $portada["portada"] != "" ) {

            $validarPortada = \Validator::make($portada, [
                "portada" => 'required|image|mimes:jpg,jpeg,png|max:2000000'
            ]);

            if($validarPortada->fails()) {
                
                return redirect("/")->with("no-validacion-imagen", "");

            }else {

                // borramos la imagen actual que tenemos para poder poner la nueva
                unlink($data["portadaActual"]);

                // generamos un numero aleatorio como nombre de archivo
                $nom_aleatorio = mt_rand(100, 999);

                // generamos la nueva ruta donde guardaremos el archivo en la BBDD
                // usamos ->guessExtension() en laravel para obtener la extension de un archivo
                $rutaPortada = "img/blog/".$nom_aleatorio.".".$portada["portada"]->guessExtension();

                // finalmente, guardamos la imagen en la ruta asignada
                //move_uploaded_file($portada["portada"], $rutaPortada);

                // para ajsutar nosotros mismos los tamaños de la imagen cuando la guardemos:
                // obtenemos las dimensiones originales de la imagen
                list($ancho, $alto) =  getimagesize($portada["portada"]);

                // establecemos un nuevo ancho y alto de la imagen
                $nuevoAncho = 700;
                $nuevoAlto = 420;

                // comprobamos su extension 
                if( $portada["portada"]->guessExtension() == "jpg" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefromjpeg($portada["portada"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // reajustamos el tamaño de la imagen 
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagejpeg($destino, $rutaPortada);

                }
                if( $portada["portada"]->guessExtension() == "png" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefrompng($portada["portada"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // como es png, le quitamos el fondo a la imagen
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);

                    // reajustamos el tamaño de la imagen 
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagepng($destino, $rutaPortada);

                }

            }

        }else {

            // si no se elige ninguna imagen, la ruta de la imagen será la misma 
            $rutaPortada = $data["portadaActual"];

        }

        if( $icono["icono"] != "" ) {

            $validarIcono = \Validator::make($icono, [
                "icono" => 'required|image|mimes:jpg,jpeg,png|max:2000000'
            ]);

            if($validarIcono->fails()) {
                
                return redirect("/")->with("no-validacion-imagen", "");

            }else {

                // borramos la imagen actual que tenemos para poder poner la nueva
                unlink($data["iconoActual"]);

                // generamos un numero aleatorio como nombre de archivo
                $nom_aleatorio = mt_rand(100, 999);

                // generamos la nueva ruta donde guardaremos el archivo en la BBDD
                // usamos ->guessExtension() en laravel para obtener la extension de un archivo
                $rutaIcono = "img/blog/".$nom_aleatorio.".".$icono["icono"]->guessExtension();

                // finalmente, guardamos la imagen en la ruta asignada
                //move_uploaded_file($icono["icono"], $rutaIcono);

                // para ajsutar nosotros mismos los tamaños de la imagen cuando la guardemos:
                // obtenemos las dimensiones originales de la imagen
                list($ancho, $alto) =  getimagesize($logo["logo"]);

                // establecemos un nuevo ancho y alto de la imagen
                $nuevoAncho = 150;
                $nuevoAlto = 150;

                // comprobamos su extension 
                if( $icono["icono"]->guessExtension() == "jpg" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefromjpeg($icono["icono"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // reajustamos el tamaño de la imagen 
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagejpeg($destino, $rutaIcono);

                }
                if( $icono["icono"]->guessExtension() == "png" ) {

                    // creamos la nueva imagen con las nuevas dimensiones
                    $origen = imagecreatefrompng($icono["icono"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    
                    // como es png, le quitamos el fondo a la imagen
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);

                    // reajustamos el tamaño de la imagen 
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    // finalmente creamos la imagen indicando donde se va a guardar
                    imagepng($destino, $rutaIcono);

                }

            }

        }else {

            // si no se elige ninguna imagen, la ruta de la imagen será la misma 
            $rutaIcono = $data["iconoActual"];

        }

        // comprobamos que el data no este vacio
        if(!empty($data)) {

            // hacemos la validación de los datos con laravel
            $validar = \Validator::make($data, [
                "dominio" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                "servidor" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                "titulo" => 'required|regex:/^[0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i',
                "descripcion" => 'required|regex:/^[=\\&\\$\\€\\+\\*\\-\\/\\_\\¿\\?\\¡\\!\\:\\;\\,\\.\\0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i',
                "palabras_clave" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "redes_sociales" => 'required',
                "logoActual" => 'required',
                "portadaActual" => 'required',
                "iconoActual" => 'required',
                "sobre_mi" => 'required|regex:/^[<\\>\\(\\)\\=\\&\\$\\€\\+\\*\\-\\_\\¿\\?\\¡\\!\\:\\;\\,\\.\\0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i',
                "sobre_mi_completo" => 'required|regex:/^[<\\>\\(\\)\\=\\&\\$\\€\\+\\*\\-\\_\\¿\\?\\¡\\!\\:\\;\\,\\.\\0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i'
            ]);

            // comprobamos que la validación sea correcta
            if($validar->fails()) {

                return redirect("/")->with("no-validacion", "");

            }else {

                // mover todos los ficheros temporales a la carpeta de la bbdd
                // con glob, podemos seleccionar todos los archivos de una ruta
                $ficheros = glob("img/temp/*");

                foreach ($ficheros as $fichero) {
                    
                    // copiamos la ruta del fichero al de la bbdd
                    copy($fichero, "img/blog/".substr($fichero, 9));
                    unlink($fichero);

                }
                
                $actualizar = array(
                    "dominio" => $data["dominio"],
                    "servidor" => $data["servidor"],
                    "titulo" => $data["titulo"],
                    "descripcion" => $data["descripcion"],
                    "palabras_clave" => json_encode( explode(",", $data["palabras_clave"]) ),
                    "redes_sociales" => $data["redes_sociales"],
                    "portada" => $rutaPortada,
                    "logo" => $rutaLogo,
                    "icono" => $rutaIcono,
                    "sobre_mi" => str_replace('img/temp', 'img/blog', $data["sobre_mi"]),
                    "sobre_mi_completo" => str_replace('img/temp', 'img/blog', $data["sobre_mi_completo"])
                );

                // actualizamos la fila correspondiente usando su id
                $blog = BlogModel::where("id", $id)->update($actualizar);

                return redirect("/")->with("ok-editar", "");

            }

        }else {

            return redirect("/")->with("error", "");

        }

        return;

    }

}
