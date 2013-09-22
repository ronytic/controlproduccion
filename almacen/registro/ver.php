<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Pedidos";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/pedidos.php");
$pedidos=new pedidos;
$ped=array_shift($pedidos->mostrar($id));

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=array_shift($cliente->mostrar($ped['codcliente']));

include_once("../../class/productos.php");
$productos=new productos;
$prod=array_shift($productos->mostrar($ped['codproductos']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Cliente"=>$cli['nombre'],
				"Productos"=>$prod['nombre'],
				"Cantidad"=>$ped['cantidad'],
				"Fecha de Pedido"=>fecha2Str($ped['fechapedido']),
				"Fecha de Entrega"=>fecha2Str($ped['fechaentrega']),
				"Observación"=>$ped['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>