<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/vendedor.php");
$vendedor=new vendedor;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"ci"=>"'$ci'",
				"direccion"=>"'$direccion'",
				"telefono"=>"'$telefono'",
				"observacion"=>"'$observacion'",
				);
				$vendedor->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>