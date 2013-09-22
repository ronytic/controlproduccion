<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/pedidos.php';
	extract($_POST);

	include_once '../../class/productos.php';
	include_once '../../class/cliente.php';

	$estado=$estado!=""?$estado:'%';
	$pedidos=new pedidos;
	$productos=new productos;
	$cliente=new cliente;
	$ped=$pedidos->mostrarTodo("fechapedido LIKE '%$fechapedido%' and fechaentrega LIKE '%$fechaentrega%' and codproductos LIKE '%$codproductos%' and estado LIKE '$estado'");

	$datos=array();
	foreach($ped as $p){$i++;
		$prod=array_shift($productos->mostrar($p['codproductos']));
		$cli=array_shift($cliente->mostrar($p['codcliente']));
		$datos[$i]['codcliente']=$p['codcliente'];
		$datos[$i]['nombre']=$prod['nombre'];
		$datos[$i]['cliente']=$cli['nombre'];
		$datos[$i]['fechaentrega']=$p['fechaentrega'];
		$datos[$i]['fechapedido']=$p['fechapedido'];
		$datos[$i]['estado']=$p['estado'];
	}
	$titulo=array("nombre"=>"Nombre","cliente"=>"Cliente","fechaentrega"=>"Fecha de Entrega","fechapedido"=>"Fecha de Pedido","estado"=>"Estado");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>