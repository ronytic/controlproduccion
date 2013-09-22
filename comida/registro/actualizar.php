<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/comida.php");
$comida=new comida;

extract($_POST);

$valores=array(	"nombre"=>"'$nombre'",
				"tipo"=>"'$tipo'",
				);
				
if($_FILES['foto']['name']!=""){
	if(($_FILES['foto']['type']=="image/jpeg" || $_FILES['foto']['type']=="image/png" || $_FILES['foto']['type']=="image/gif") && $_FILES['foto']['size']<="100000"){
		@$foto=$_FILES['foto']['name'];
		@copy($_FILES['foto']['tmp_name'],"../foto/".$_FILES['foto']['name']);
		$valores=array_merge($valores,array("foto"=>"'$foto'"));
	}else{
		//mensaje que no es valido el tipo de archivo
		$mensaje[]="El tipo de Archivo de imagen no es valido de la imagen";	
	}
}

//empieza la copia de archivos
for($i=1;$i<=20;$i++){
	$valores=array_merge($valores,array("ingrediente$i"=>"'".${"ingrediente".$i}."'"));
}
				$comida->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>