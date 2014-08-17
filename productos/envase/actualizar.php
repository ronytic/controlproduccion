<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/envase.php");
$envase=new envase;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"cantidad"=>"'$cantidad'",
				"observacion"=>"'$observacion'",
				);
				$envase->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>