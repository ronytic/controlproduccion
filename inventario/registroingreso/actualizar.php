<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/inventario.php");
$inventario=new inventario;

extract($_POST);

$fecha=date("Y-m-d");
$valores=array(	//"codproductos"=>"'$codproductos'",
				//"cantidadentrada"=>"'$cantidadentrada'",
				//"cantidadsalida"=>"'$cantidadsalida'",
				//"fechaentrada"=>"'$fecha'",
				"codigo"=>"'$codigo'",
				);
				
/*if($_FILES['foto']['name']!=""){
	if(($_FILES['foto']['type']=="image/jpeg" || $_FILES['foto']['type']=="image/png" || $_FILES['foto']['type']=="image/gif") && $_FILES['foto']['size']<="100000"){
		@$foto=$_FILES['foto']['name'];
		@copy($_FILES['foto']['tmp_name'],"../foto/".$_FILES['foto']['name']);
		$valores=array_merge($valores,array("foto"=>"'$foto'"));
	}else{
		//mensaje que no es valido el tipo de archivo
		$mensaje[]="El tipo de Archivo de imagen no es valido de la imagen";	
	}
}*/


				$inventario->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>