@extends('plantilla')

@section('content')

  <div class="content-wrapper" style="min-height: 155px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administradores</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>

              <li class="breadcrumb-item active">Administradores</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            @foreach ($blog as $key => $value)

            @endforeach
            
            <form action="{{ url('/') }}/blog/{{$value->id}}" method="post">

              @method('PUT')
              @csrf

              <div class="card">

                <div class="card-header">

                  <h4>Datos del blog</h4>

                </div>

                <div class="card-body">
                    
                    <div class="row">

                      <div class="col-lg-7">

                        <div class="card">

                          <div class="card-body">

                            {{-- Dominio  --}}
                            <div class="input-group mb-3">

                              <div class="input-group-append">

                                <span class="input-group-text">Dominio</span>

                              </div>

                              <input type="text" name="dominio" class="form-control " value="{{ $value->dominio }}" required>

                            </div>

                            {{-- Servidor  --}}
                            <div class="input-group mb-3">

                              <div class="input-group-append">

                                <span class="input-group-text">Servidor</span>

                              </div>

                              <input type="text" name="servidor" class="form-control" value="{{ $value->servidor }}" required>

                            </div>

                            {{-- Titulo --}}
                            <div class="input-group mb-3">

                              <div class="input-group-append">

                                <span class="input-group-text">Titulo</span>

                              </div>

                              <input type="text" name="titulo" class="form-control" value="{{ $value->titulo }}" required>

                            </div>

                            {{-- Descripcion --}}
                            <div class="input-group mb-3">

                              <div class="input-group-append">

                                <span class="input-group-text">Descripcion</span>

                              </div>

                              <textarea name="descripcion" rows="5" class="form-control" required>
                                {{$value->descripcion}}
                              </textarea>

                            </div>

                            <hr >
                            {{-- Palabras clave --}}
                            <div class="form-group mb-3">

                              <label> Palabras clave </label>
                              @php
                              
                                $tags = json_decode($value->palabras_clave, true);
                                $palabras_clave = "";

                                foreach ($tags as $key => $valueTags) {
                                  
                                    $palabras_clave .= $valueTags.", ";

                                }

                              @endphp

                              <input type="text" name="palabras_clave" class="form-control" value="{{ $palabras_clave }}" 
                              data-role="tagsinput" required>

                            </div>

                            <hr >
                            
                            {{-- Redes Sociales --}}
                            <label > Redes Sociales </label>

                            <div class="row">

                              {{-- Inicio primer col-5  --}}
                              <div class="col-5">

                                <div class="input-group mb-3">

                                  <div class="input group-append">

                                    <span class="input-group-text">Icono</span>

                                  </div>

                                  <select  id="icono_redes" class="form-control">

                                    <option value="fab fa-facebook-f, #1475e0">facebook</option>
                                    <option value="fab fa-instagram, #818768">instagram</option>
                                    <option value="fab fa-twitter, #00A6FF">twitter</option>
                                    <option value="fab fa-youtube, #F95F62">youtube</option>
                                    <option value="fab fa-snapchat-ghost, #FF9052">snapchat</option>
                                    <option value="fab fa-linkedin-in, #0E76A8">linkedin</option>

                                  </select>

                                </div>

                              </div>
                              {{-- Fin primer col-5  --}}

                              {{-- Inicio segundo col-5  --}}
                              <div class="col-5">

                                <div class="input-group mb-3">

                                  <div class="input group-append">

                                    <span class="input-group-text">Url</span>

                                  </div>

                                  <input type="text" id="url-redes" class="form-control">

                                </div>

                              </div>
                              {{-- Fin segundo col-5  --}}
                              <div class="col-2">

                                <button type="button" class="btn btn-primary w-100 agregarRedes">Agregar</button>

                              </div>

                            </div>
                            {{-- Fin del row --}}

                            <div class="row">
                              
                              @php
                                  
                                $redes = json_decode($value->redes_sociales, true);
                                
                                foreach ($redes as $key => $valueRedes) {
                                  
                                  echo '
                                  <div class="col-lg-12">

                                    <div class="input-group mb-3">

                                      <div class="input-group-prepend">

                                        <div class="input-group-text text-white" style="background:'.$valueRedes["background"].';">

                                          <i class="'.$valueRedes["icono"].'"></i>

                                        </div>

                                      </div>

                                      <input type="text" class="form-control" value="'.$valueRedes["url"].'">

                                      <div class="input-group-prepend">

                                        <div class="input-group-text" style="cursor:pointer">

                                          <span class="bg-danger px-2 rounded-circle">&times;</span>

                                        </div>

                                      </div>

                                    </div>

                                  </div>';

                                }

                              @endphp

                            </div>

                          </div>

                        </div>

                      </div>

                      <div class="col-lg-5">

                        <div class="card">

                          <div class="card-body">

                            <div class="row">

                              <div class="col-lg-12">

                                {{-- Cambiar logo --}}
                                <div class="form-group my-2 text-center">

                                  <div class="btn btn-primary btn-file mb-3 text-white">

                                    <i class="fas fa-paperclip mr-1"></i>Adjuntar Imagen de Logo
                                    <input type="file" name="logo">

                                  </div>

                                  <img src="{{ url('/') }}/{{ $value->logo }}" class="img-fluid py-2 bg-secondary">
                                  <p class="help-block small mt-3">Dimensiones: 700px * 200px | Peso Máx: 2MB | Formato: JPG/PNG</p>

                                </div>

                                <hr>

                                {{-- Cambiar portada --}}
                                <div class="form-group my-2 text-center">

                                  <div class="btn btn-primary btn-file mb-3 text-white">

                                    <i class="fas fa-paperclip mr-1"></i>Adjuntar Imagen de Portada
                                    <input type="file" name="portada">

                                  </div>

                                  <img src="{{ url('/') }}/{{ $value->portada }}" class="img-fluid py-2">
                                  <p class="help-block small mt-3">Dimensiones: 700px * 420px | Peso Máx: 3MB | Formato: JPG/PNG</p>

                                </div>

                                <hr>

                                {{-- Cambiar icono --}}
                                <div class="form-group my-2 text-center">

                                  <div class="btn btn-primary btn-file mb-3 text-white">

                                    <i class="fas fa-paperclip mr-1"></i>Adjuntar Imagen de icono
                                    <input type="file" name="icono">

                                  </div>

                                  <br>

                                  <img src="{{ url('/') }}/{{ $value->icono }}" class="img-fluid py-2 rounded-circle">
                                  <p class="help-block small mt-3">Dimensiones: 150px * 150px | Peso Máx: 2MB | Formato: JPG/PNG</p>

                                </div>


                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                      {{-- Sobre mi --}}
                      <div class="col-lg-6">

                        <div class="card">

                          <div class="card-body">

                            <label>Sobre mi <span class="small">(Intro)</span></label>
                            <textarea name="sobre_mi" rows="10" class="form-control summernote ">{{ $value->sobre_mi }}</textarea>

                          </div>

                        </div>

                      </div>

                      {{-- Sobre mi completo --}}
                      <div class="col-lg-6">

                        <div class="card">

                          <div class="card-body">

                            <label>Sobre mi <span class="small">(Completo)</span></label>
                            <textarea name="sobre_mi_completo" rows="10" class="form-control summernote">{{ $value->sobre_mi_completo }}</textarea>

                          </div>

                        </div>

                      </div>

                    </div>

                  

                </div>

                <!-- /.card-body -->
                <div class="card-footer">

                  <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

                <!-- /.card-footer-->
              </div>
              <!-- /.card -->

            </form>
          </div>

        </div>

      </div>
      
    </section>
    <!-- /.content -->
  </div>

  {{-- Validacion de las rutas --}}

  {{-- Comprobamos que en la variable de sesion venga el valor 'no-validacion' que es lo que devuelve el controlador --}}
  @if (Session::has("no-validacion"))  

    <script>

      notie.alert({
        type: 3,
        text: 'No se permiten carácteres especiales',
        time: 6
      });

    </script>

  @endif

  {{-- Comprobamos que en la variable de sesion venga el valor que devuelve el controlador --}}
  @if (Session::has("error"))  

    <script>

      notie.alert({
        type: 3,
        text: '¡Error en el gestor del blog!',
        time: 6
      });

    </script>

  @endif

  {{-- Comprobamos que en la variable de sesion venga el valor que devuelve el controlador --}}
  @if (Session::has("ok-editar"))  

    <script>

      notie.alert({
        type: 1,
        text: '¡El blog ha sido actualizado correctamente!',
        time: 6
      });

    </script>

  @endif

@endsection