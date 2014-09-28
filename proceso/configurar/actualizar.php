<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/configuracion.php");
$configuracion=new configuracion;
extract($_POST);
//empieza la copia de archivos
$valores=array(	//"porcentajecostofabricacion"=>"'$porcentajecostofabricacion'",
				"costomanodeobra"=>"'$costomanodeobra'",
				"costominimodeproduccion"=>"'$costominimodeproduccion'",
				"costomaximodeproduccion"=>"'$costomaximodeproduccion'",
				
				);
				$configuracion->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";

$nuevo=1;
$listar=1;
$codinsercion=1;
$archivovolver="index.php";
$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>