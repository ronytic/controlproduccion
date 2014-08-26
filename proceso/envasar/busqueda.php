<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	include_once '../../class/compra.php';
	extract($_POST);
	
	
	$productos=new productos;
	$compra=new compra;
	
	
	$codproductos=$codproductos!=""?$codproductos:'%';
	$codproveedor=$codproveedor!=""?$codproveedor:'%';
	//$fechavencimientoinicio=$fechavencimientoinicio!=""?$fechavencimientoinicio:'%';
	//$fechavencimientofin=$fechavencimientofin!=""?$fechavencimientofin:'%';
	
	if($merma=="Si"){
		$valormerma=" and cantidad<cantidadesperada";	
	}
	$fecha=($fechavencimientoinicio!="" && $fechavencimientofin!="")?" and fechavencimiento BETWEEN '$fechavencimientoinicio' and '$fechavencimientofin'":'';
	foreach($compra->mostrarTodo("codproveedor LIKE '$codproveedor' and codproductos LIKE '$codproductos' $fecha $valormerma and tipo='procesado' and cantidadstock>0")as $mp){$i++;
		$pro=array_shift($productos->mostrar($mp['codproductos']));
		$datos[$i]['codcompra']=$mp['codcompra'];
		$datos[$i]['producto']=$pro['nombre'];
		$datos[$i]['fechacompra']=$mp['fechacompra'];
		$datos[$i]['fechavencimiento']=$mp['fechavencimiento'];
		$datos[$i]['cantidad']=$mp['cantidad'];
		$datos[$i]['cantidadesperada']=$mp['cantidadesperada'];
		$datos[$i]['cantidadstock']=$mp['cantidadstock'];
		$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	if($merma=="No"){
		$titulo=array("fechacompra"=>"Fecha de Compra","producto"=>"Producto","cantidad"=>"Cantidad","cantidadstock"=>"Cantidad Stock","fechavencimiento"=>"Fecha de Vencimiento","observacion"=>"Observación");
	}else{
		$titulo=array("fechacompra"=>"Fecha de Compra","producto"=>"Producto","cantidad"=>"Cantidad Resultante","cantidadesperada"=>"Cantidad Esperada","cantidadstock"=>"Cantidad Stock","fechavencimiento"=>"Fecha de Vencimiento","observacion"=>"Observación");
	}
	if($_SESSION['Nivel']==1 || $_SESSION['Nivel']==2){
		$eliminar="eliminar.php";
	}else{
		$eliminar="";
	}
	listadoTabla($titulo,$datos,1,"",$eliminar,"",array("Envasar"=>"envasar.php"));
}
?>