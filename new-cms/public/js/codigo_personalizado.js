/* 

    *****  CAPTURAMOS LA RUTA DE NUESTRO CMS  ***** 

*/

let ruta = $("#ruta").val();

/* 

    *****  AGREGAR REDES  ***** 

*/

$(".agregarRedes").click(function() {

    /* como los options del select tienen en su value dos valores, el icono y el color y estan separados por una coma,
       hacemos un split para obtener por un lado el icono y por otro su color */

    let icono = $("#icono_redes").val().split(",")[0];
    let color = $("#icono_redes").val().split(",")[1];
    let url = $("#url-redes").val();

    
        // Añadimos con append() el siguiente código para que se vea desde nuestra vista
        $(".listado").append(`

            <div class="col-lg-12">

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                        <div class="input-group-text text-white" style="background:${color};">

                        <i class="${icono}"></i>

                        </div>

                    </div>

                    <input type="text" class="form-control" value="${url}">

                    <div class="input-group-prepend">

                        <div class="input-group-text" style="cursor:pointer">

                        <span class="bg-danger px-2 rounded-circle eliminarRed" url="${url}" >&times;</span>

                        </div>

                    </div>

                </div>

            </div>

        `);

        // Actualizamos nuestro input oculto que contiene las listas de todas las redes
        var nuevoListadoRedes = JSON.parse($("#listaRedes").val());

        nuevoListadoRedes.push({
            "url": url,
            "icono": icono,
            "background": color
        });
        // pasamos de JSON  string y actualizamos el nuevo valor de esta lista
        $("#listaRedes").val(JSON.stringify(nuevoListadoRedes));

});

/* 

    *****  ELIMINAR REDES  ***** 

*/

$(document).on("click", ".eliminarRed", function() {

    let listaRedes = JSON.parse($("#listaRedes").val());

    let url = $(this).attr("url");

    for(let index = 0; index < listaRedes.length; index ++ ) {

        if(listaRedes[index]["url"] == url ) {

            // para remover una fila de un objeto, llamamos a la funcion .splice(indice_de_fila_a_borrar, nº_filas_para_borrar )
            listaRedes.splice(index, 1);

            //para remover esta bloque de la vista hay que hacer llamadas con parent() para hacer referencia a su etiqueta contenedor
            $(this).parent().parent().parent().parent().remove();

            // pasamos de JSON  string y actualizamos el nuevo valor de esta lista
            $("#listaRedes").val(JSON.stringify(listaRedes));

        }

    }

});

/* 

    *****  CAPTURAR IMAGENES DE FORMA TEMPORAL  ***** 

*/

$("input[type='file']").change(function() {

    // capturamos lo que hemos seleccionado
    let imagen = this.files[0];
    let tipo = $(this).attr("name");

    // comprobamos que sea de formato png o jpg
    if( imagen["type"] != "image/png" && imagen["type" != "image/jpeg"] ) {

        $(this).val("");

        notie.alert({
            type: 3,
            text: '¡El formato de la imagen debe ser png o jpg!',
            time: 4
        });

    }else if( imagen["size"] > 2000000 ) {

        $(this).val("");

        notie.alert({
            type: 3,
            text: '¡La imagen no debe pesar mas de 2 MB!',
            time: 4
        });

    }else {

        let dataReader = new FileReader;

        // como la imagen es una ruta, usamos la funcion readAdDataURL()
        dataReader.readAsDataURL(imagen);

        $(dataReader).on("load", function(event) {

            // con event.target.result obtenemos la ruta de la imagen del objeto dataReader
            let rutaImagen = event.target.result;

            $(".imgTemporal_"+tipo).attr("src", rutaImagen);

        });


    }

})

/* 

    *****  SUMMERNOTE  ***** 

*/

$(".summernote").summernote({

    height: 300,
    // la propiedad callbacks y su fucion onImageUpload son exclusivas del plugin summernote
    callbacks: {

        onImageUpload: function(files) {

            for(let i = 0; i < files.length; i++) {

                upload(files[i], false);

            }

        }

    }

});

$(".summernote-completo").summernote({

    height: 300,
    // la propiedad callbacks y su fucion onImageUpload son exclusivas del plugin summernote
    callbacks: {

        onImageUpload: function(files) {

            for(let i = 0; i < files.length; i++) {

                upload(files[i], true);

            }

        }

    }

});

// Creamos la funcion para pasar los archivos temporales a nuestra base de datos usando ajax
function upload(file, completo) {

    let data = new FormData();
    data.append("file", file, file.name);
    data.append("ruta", ruta);

    $.ajax({

        url: ruta + "/ajax/upload.php",
        method: 'POST',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            
            // indicamos a summernote que inserte una imagen con la ruta que recibimos
            if(completo) {

                $(".summernote-completo").summernote("insertImage", response);

            }else{

                $(".summernote").summernote("insertImage", response);

            }

        },
        error: function(jqXHR, textStatus, errorThrown) {

            console.log(textStatus + " " + errorThrown);

        }

    });

} 