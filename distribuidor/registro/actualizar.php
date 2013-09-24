<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"direccion"=>"'$direccion'",
				"telefono"=>"'$telefono'",
				"departamento"=>"'$departamento'",
				"observacion"=>"'$observacion'",
				);
				$distribuidor->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>