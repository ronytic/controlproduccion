<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/menucomida.php");
$menucomida=new menucomida;

extract($_POST);

/*				
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
*/
//empieza la copia de archivos
$valores=array(	"fechacomida"=>"'$fechacomida'",
				"desayuno"=>"'$desayuno'",
				"sopa"=>"'$sopa'",
				"segundo"=>"'$segundo'",
				"postre"=>"'$postre'",
				"tetarde"=>"'$tetarde'",
				"cena"=>"'$cena'",
				"cantidad"=>"'$cantidad'",
				);
				$menucomida->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>