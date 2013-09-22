<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/productos.php");
$productos=new productos;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"descripcion"=>"'$descripcion'",
				);
				$productos->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>