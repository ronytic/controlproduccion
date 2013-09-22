<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/materiaprima.php");
$materiaprima=new materiaprima;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"fecharegistro"=>"'$fecharegistro'",
				"codproductos"=>"'$codproductos'",
				"cantidad"=>"'$cantidad'",
				"color"=>"'$color'",
				"sabor"=>"'$sabor'",
				"olor"=>"'$olor'",
				"condicionempaque"=>"'$condicionempaque'",
				"codresponsable"=>"'$codresponsable'",
				"fechavencimiento"=>"'$fechavencimiento'",
				"estado"=>"'$estado'",
				"observacion"=>"'$observacion'",
				);
				$materiaprima->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>