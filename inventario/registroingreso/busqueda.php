<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/inventario.php';
	include_once '../../class/productos.php';
	extract($_POST);
	$codproductos=$codproductos!=""?$codproductos:"%";
	$fechaentrada=$fechaentrada!=""?$fechaentrada:"%";
	$inventario=new inventario;
	$productos=new productos;
	$inv=$inventario->mostrarTodo("codproductos LIKE '$codproductos' and fechaentrada LIKE '$fechaentrada'");
	foreach($inv as $c){$i++;
	$pro=array_shift($productos->mostrar($c['codproductos']));
		$datos[$i]['codinventario']=$c["codinventario"];
		$datos[$i]['nombre']=$pro["nombre"];
		$datos[$i]['fechaentrada']=$c["fechaentrada"];
		$datos[$i]['cantidadentrada']=$c["cantidadentrada"];
		$datos[$i]['cantidadsalida']=$c["cantidadsalida"];
		
		
	}
	$titulo=array("nombre"=>"Producto","fechaentrada"=>"Fecha Entrada","cantidadentrada"=>"Cantidad Entrada","cantidadsalida"=>"Cantidad Salida");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>