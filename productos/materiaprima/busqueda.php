<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	include_once '../../class/materiaprima.php';
	extract($_POST);
	
	
	$productos=new productos;
	$materiaprima=new materiaprima;
	
	
	$codproductos=$codproductos!=""?$codproductos:'%';
	$fechavencimiento=$fechavencimiento!=""?$fechavencimiento:'%';
	
	foreach($materiaprima->mostrarTodo("condicionempaque LIKE '%$condicionempaque%' and codproductos LIKE '$codproductos' and fechavencimiento LIKE '$fechavencimiento' and estado LIKE '%$estado%'")as $mp){$i++;
	$pro=array_shift($productos->mostrar($mp['codproductos']));
	$datos[$i]['codmateriaprima']=$mp['codmateriaprima'];
	$datos[$i]['producto']=$pro['nombre'];
	$datos[$i]['fecharegistro']=$mp['fecharegistro'];
	$datos[$i]['fechavencimiento']=$mp['fechavencimiento'];
	$datos[$i]['condicionempaque']=$mp['condicionempaque'];
	}
	
	
	
	$titulo=array("fecharegistro"=>"Fecha de Ingreso","producto"=>"Producto","condicionempaque"=>"Condición de Empaque","fechavencimiento"=>"Fecha de Vencimiento");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>