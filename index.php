<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/controladorBlog.php";
require_once "controladores/controladorFunciones.php";
require_once "modelos/modeloBlog.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrTraerPlantilla();