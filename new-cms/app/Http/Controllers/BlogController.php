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

        $data = array( 
                "dominio" => $request -> input("dominio"),
                "servidor" => $request -> input("servidor"),
                "titulo" => $request -> input("titulo"),
                "descripcion" => $request -> input("descripcion"),
                "palabras_clave" => $request -> input("palabras_clave"),
                "redes_sociales" => $request -> input("redes_sociales")
            );
        
        // comprobamos que el data no este vacio
        if(!empty($data)) {

            // hacemos la validación de los campos con laravel
            $validar = \Validator::make($data, [
                "dominio" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                "servidor" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                "titulo" => 'required|regex:/^[0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i',
                "descripcion" => 'required|regex:/^[=\\&\\$\\€\\+\\*\\-\\/\\_\\¿\\?\\¡\\!\\:\\;\\,\\.\\0-9a-zA-ZñÑáéóíúÁÉÍÓÚ ]+$/i',
                "palabras_clave" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "redes_sociales" => 'required'
            ]);

            // comprobamos que la validación sea correcta
            if($validar->fails()) {

                return redirect("/")->with("no-validacion", "");

            }else {

                $actualizar = array(
                    "dominio" => $data["dominio"],
                    "servidor" => $data["servidor"],
                    "titulo" => $data["titulo"],
                    "descripcion" => $data["descripcion"],
                    "palabras_clave" => json_encode( explode(",", $data["palabras_clave"]) ),
                    "redes_sociales" => $data["redes_sociales"]
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
