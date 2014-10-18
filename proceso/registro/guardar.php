<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/compra.php");
include_once("../../class/venta.php");
include_once '../../class/configuracion.php';
$configuracion=new configuracion;

$compra=new compra;
$venta=new venta;
//print_r($_POST);
extract($_POST);
//echo "<br>";
//print_r($p);
$conf=array_shift($configuracion->mostrar(1));

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
$totalprecioproducto=0;
foreach($p as $pro){
	$codigoproducto=$pro['codproductos'];
	if($codigoproducto==""){break;}
	$preciomaximo=$compra->preciomaximo($codigoproducto);
	$preciomaximo=array_shift($preciomaximo);
	$preciomaxunitario=$preciomaximo['preciomaxunitario'];
	//echo $codigoproducto;
	$totalprecioproducto+=$preciomaxunitario;
	
}
$costomanodeobra=round($conf['costomanodeobra']*$cantidad,2)+$totalprecioproducto;
//$costofabricacion=round($conf['porcentajecostofabricacion']/100*$totalprecioproducto,2);
$costoproduccion=$costomanodeobra;

$costominimodeproduccion=round($conf['costominimodeproduccion']/100*$costoproduccion,2);
$costomaximodeproduccion=round($conf['costomaximodeproduccion']/100*$costoproduccion,2);
$costoventa=$costoproduccion;
/*
print_r($conf);
echo $totalprecioproducto."<br>";
echo $costomanodeobra."<br>";
echo $costofabricacion."<br>";
echo $costoproduccion."<br>";
echo $costominimodeproduccion."<br>";
echo $costomaximodeproduccion."<br>";
*/
///Cambio del Codigo por $cantidadesperada, si no es solo colocar $cantidad

$totalprecioTodosProductos=$totalprecioproducto*$cantidadesperada;
//echo $totalprecioTodosProductos;
/*$preciomaximo=$compra->preciomaximo($codigoproducto);
	$preciomaximo=array_shift($preciomaximo);

	echo $codigoproducto;
	echo "<pre>";
	print_r($preciomaximo);
	echo "</pre>";
	*/	
	$totalprecioproducto=str_replace(",",".", $totalprecioproducto);
$valores=array(	"fechacompra"=>"'$fechaproduccion'",
				"codproductos"=>"'$codproductos'",
				"cantidad"=>"'$cantidad'",
				"cantidadesperada"=>"'$cantidadesperada'",
				"preciounitario"=>"'$costoproduccion'",
				"total"=>"'$totalprecioTodosProductos'",
				"codproveedor"=>"'0'",
				"fechavencimiento"=>"'$fechavencimiento'",
				"observacion"=>"'$observacion - Procesado'",
				"cantidadstock"=>"'$cantidad'",
				
				"costominimo"=>"'$costominimodeproduccion'",
				"costomaximo"=>"'$costomaximodeproduccion'",
				"manoobra"=>"'$costomanodeobra'",
				"costofabricacion"=>"'$costofabricacion'",
				"tipo"=>"'Procesado'",
				
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