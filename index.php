<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/controladorBlog.php";
require_once "controladores/controladorFunciones.php";
require_once "modelos/modeloBlog.php";
require_once "extensiones/vendor/autoload.php";
require_once "controladores/controladorCorreo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrTraerPlantilla();