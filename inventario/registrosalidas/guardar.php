<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/inventario.php");
$inventario=new inventario;

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
*//*
if($_FILES['foto']['name']!=""){
	if(($_FILES['foto']['type']=="image/jpeg" || $_FILES['foto']['type']=="image/png" || $_FILES['foto']['type']=="image/gif") && $_FILES['foto']['size']<="100000"){
		@$foto=$_FILES['foto']['name'];
		@copy($_FILES['foto']['tmp_name'],"../foto/".$_FILES['foto']['name']);
	}else{
		//mensaje que no es valido el tipo de archivo
		$mensaje[]="El tipo de Archivo de imagen no es valido de la imagen";	
	}
}*/
$fecha=date("Y-m-d");
$totalproducto=0;
foreach($inventario->mostrarTodo("codproductos=$codproductos and cantidadsalida>0","fechaentrada") as $inv){
	$totalproducto+=$inv['cantidadsalida'];
}
//echo $totalproducto;
if($totalproducto<$cantidadsalida){
	$mensaje[]="No Existe en Inventario la Cantidad que Solicita<hr><strong>Cantidad de Inventario: $totalproducto<br>Cantidad de Solicitada: $cantidadsalida</strong>";
}else{
	
	foreach($inventario->mostrarTodo("codproductos=$codproductos and cantidadsalida>0","fechaentrada") as $inv){
		if((float)$cantidadsalida<(float)$inv['cantidadsalida']){
			//echo "si";
			$mensaje[]="SUS SALIDA DE PRODUCTOS SE REGISTRO CORRECTAMENTE";
			$cantidadsalida=$inv['cantidadsalida']-$cantidadsalida;
			$valores=array("cantidadsalida"=>"$cantidadsalida","fechasalida"=>"'$fecha'");
			$inventario->actualizar($valores,$inv["codinventario"]);
			break;	
		}else{
			//echo $cantidadsalida;
			$cantidadsalida=$cantidadsalida-$inv['cantidadsalida'];
			$valores=array("cantidadsalida"=>0,"fechasalida"=>"'$fecha'");
			$inventario->actualizar($valores,$inv["codinventario"]);
		}
	}
}


//$inventario->insertar($valores);
//$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";



$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>