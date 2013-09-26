<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/compra.php");
include_once("../../class/venta.php");
$compra=new compra;
$venta=new venta;
//print_r($_POST);
extract($_POST);
//echo "<br>";
//print_r($p);

$fecha=date("Y-m-d");
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
$valores=array(	"fechacompra"=>"'$fechaproduccion'",
				"codproductos"=>"'$codproductos'",
				"cantidad"=>"'$cantidad'",
				"preciounitario"=>"'0'",
				"total"=>"'0'",
				"codproveedor"=>"'0'",
				"fechavencimiento"=>"'$fechavencimiento'",
				"observacion"=>"'$observacion - Procesado'",
				"cantidadstock"=>"'$cantidad'",
				);
$compra->insertar($valores);
foreach($p as $pro){
	$codigoproducto=$pro['codproductos'];
	$cantidadproducto=$pro['cantidad'];	
	$cantidadtotalproducto=$cantidadproducto;
	if($codigoproducto==""){break;}
	foreach($compra->mostrarTodo("codproductos=$codigoproducto and cantidadstock>0","fechacompra") as $inv){
		if((float)$cantidadproducto<=(float)$inv['cantidadstock']){
			//echo "si";
			//$mensaje[]="Sus Ventas de PRODUCTOS SE REGISTRO CORRECTAMENTE";
			$cantidadproducto=$inv['cantidadstock']-$cantidadproducto;
			$valores=array("cantidadstock"=>"$cantidadproducto","fechaventa"=>"'$fecha'");
			$compra->actualizar($valores,$inv["codcompra"]);
			
			$valores=array(	"fechaventa"=>"'$fecha'",
				"codproductos"=>"'$codigoproducto'",
				"cantidad"=>"'$cantidadtotalproducto'",
				"preciounitario"=>"'0'",
				"total"=>"'0'",
				"codcliente"=>"'0'",
				"coddistribuidor"=>"'0'",
				"observacion"=>"'Procesamiento'",
				);
			$venta->insertar($valores);

			break;	
		}else{
			//echo $cantidadsalida;
			$cantidadproducto=$cantidadproducto-$inv['cantidadstock'];
			$valores=array("cantidadstock"=>0,"fechaventa"=>"'$fecha'");
			$compra->actualizar($valores,$inv["codcompra"]);
		}
	}
}
$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$listar=1;
$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>