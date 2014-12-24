<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Venta a Crédito";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/ventageneral.php");
$ventageneral=new ventageneral;
$mp=array_shift($ventageneral->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=array_shift($productos->mostrar($mp['codproductos']));

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dis=array_shift($distribuidor->mostrar($mp['coddistribuidor']));

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=array_shift($cliente->mostrar($mp['codcliente']));

include_once("../../class/vendedor.php");
$vendedor=new vendedor;
$ven=array_shift($vendedor->mostrar($mp['codvendedor']));

include_once("../../class/ventacredito.php");
$ventacredito=new ventacredito;

$venc=$ventacredito->mostrarTodo("codventageneral=".$id);
$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Fecha de Venta"=>fecha2Str($mp['fechaventa']),
				"Fecha de Último Pago"=>fecha2Str($mp['fechaultimopago']),
				
				
				"Total"=>"Bs ".$mp['total'],
				"Total Cancelado"=>"Bs ".$mp['totalcancelado'],
				"Distribuidor"=>$dis['nombre']." - ".$dis['direccion'],
				"Vendedor"=>$ven['nombre']." - ".$ven['direccion'],
				"Cliente"=>$cli['nombre'],
				"Código de Control"=>($mp['codigocontrol']),
				"Observación"=>($mp['observacion']),
			));

$pdf->CuadroCuerpoResaltar(10,"Nº",1,"C",1,3);
$pdf->CuadroCuerpoResaltar(30,"Código de Venta",1,"C",1,3);
$pdf->CuadroCuerpoResaltar(30,"Pago",1,"C",1,3);
$pdf->CuadroCuerpoResaltar(30,"Saldo",1,"C",1,3);
$pdf->CuadroCuerpoResaltar(30,"Fecha",1,"C",1,3);
$pdf->ln();
$i=0;
$total=0;
foreach($venc as $vc){$i++;
$total+=$vc['montopago'];
$pdf->CuadroCuerpoResaltar(10,$i,0,"R",1,3);
$pdf->CuadroCuerpoResaltar(30,$id,0,"R",1,3);
$pdf->CuadroCuerpoResaltar(30,$vc['montopago'],0,"R",1,3);
$pdf->CuadroCuerpoResaltar(30,$vc['totaladeudadoalafecha'],0,"R",1,3);
$pdf->CuadroCuerpoResaltar(30,fecha2Str($vc['fechapago']),0,"C",1,3);
$pdf->ln();	
}
$pdf->CuadroCuerpoResaltar(40,"Total",0,"R",0,3);
$pdf->CuadroCuerpoResaltar(30,$total,1,"R",1,3);
$pdf->Output();
?>