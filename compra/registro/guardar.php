<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/compra.php");
$compra=new compra;

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
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

foreach($m as $ma){
	
	if($ma['codproductos']!=0 && $ma['codproductos']!=""){
$valores=array(	"fechacompra"=>"'".$fechacompra."'",
				"codproductos"=>"'".$ma['codproductos']."'",
				"cantidad"=>"'".$ma['cantidad']."'",
				"cantidadesperada"=>"'".$ma['cantidad']."'",
				"preciounitario"=>"'".$ma['preciounitario']."'",
				"total"=>"'".$ma['total']."'",
				"codproveedor"=>"'".$codproveedor."'",
				"fechavencimiento"=>"'".$ma['fechavencimiento']."'",
				"observacion"=>"'".$observacion."'",
				"cantidadstock"=>"'".$ma['cantidad']."'",
				);
				
		/*echo "<pre>";
print_r($ma);
echo "</pre>";			*/	
	$compra->insertar($valores);
	}
}
$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";

//exit();

$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>