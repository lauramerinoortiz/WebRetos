<?php
$datos=$_GET;
require_once('controladores/controladorcategorias.php');
$controlador=new ControladorCategorias();
$resultado=$controlador->eliminar($datos);

?>