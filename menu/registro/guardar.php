<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/menucomida.php");
$menucomida=new menucomida;

extract($_POST);
//empieza la copia de archivos
/*
if(($_FILES['curriculum']['type']=="application/pdf" || $_FILES['curriculum']['type']=="application/msword" || $_FILES['curriculum']['type']=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") && $_FILES['curriculum']['size']<="500000000"){
	@$curriculum=$_FILES['curriculum']['name'];
	@copy($_FILES['curriculum']['tmp_name'],"../curriculum/".$_FILES['curriculum']['name']);
}else{
	//mensaje que no es valido el tipo de archivo	
	$mensaje[]="Archivo no válido del curriculum. Verifique e intente nuevamente";
}
*/
/*if($_FILES['foto']['name']!=""){
	if(($_FILES['foto']['type']=="image/jpeg" || $_FILES['foto']['type']=="image/png" || $_FILES['foto']['type']=="image/gif") && $_FILES['foto']['size']<="100000"){
		@$foto=$_FILES['foto']['name'];
		@copy($_FILES['foto']['tmp_name'],"../foto/".$_FILES['foto']['name']);
	}else{
		//mensaje que no es valido el tipo de archivo
		$mensaje[]="El tipo de Archivo de imagen no es valido de la imagen";	
	}
}*/
$valores=array(	"fechacomida"=>"'$fechacomida'",
				"desayuno"=>"'$desayuno'",
				"sopa"=>"'$sopa'",
				"segundo"=>"'$segundo'",
				"postre"=>"'$postre'",
				"tetarde"=>"'$tetarde'",
				"cena"=>"'$cena'",
				"cantidad"=>"'$cantidad'",
				);

$menucomida->insertar($valores);
$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";



$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>