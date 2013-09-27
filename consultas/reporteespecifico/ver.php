<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Estado de Productos de Inventario con rangos de Fechas";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(80,"Nombre Producto");
		$this->TituloCabecera(40,"Compra Total");
		$this->TituloCabecera(40,"Venta Total");
		$this->TituloCabecera(40,"Stock Inventario");
	}	
}


$codproductos=$codproductos!=""?$codproductos:"%";

$existente=$existente=="1"?'and cantidadstock>0':'';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
}
include_once("../../class/productos.php");
include_once("../../class/venta.php");
include_once("../../class/compra.php");
include_once("../../class/distribuidor.php");
include_once("../../class/cliente.php");
$venta=new venta;
$compra=new compra;
$productos=new productos;
$distribuidor=new distribuidor;
$cliente=new cliente;
$where="codproductos LIKE '$codproductos'";
/*if(!empty($fechacontrato)){
	$where="`fechacontrato`<='$fechacontrato'";
}
if(!empty($codobra)){
	$where=(empty($fechacontrato))?"`codobra`=$codobra":$where." and `codobra`=$codobra";
}
if(!empty($tipocontrato)){
	$where=(empty($where))?$where."`tipocontrato` LIKE '%$tipocontrato%'":$where." and `tipocontrato` LIKE '%$tipocontrato%'";
}*/

//echo $where;
$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$totales=array();
$cantidadc=0;
$cantidadv=0;
$cantidads=0;
$cantidadstock=0;
foreach($productos->mostrarTodos($where,"nombre") as $inv){$i++;
	$comp=array_shift($compra->sumarProducto($inv['codproductos']));
	$cantidadcompratotal=$comp['cantidadcompratotal']?$comp['cantidadcompratotal']:'0';
	$comp=array_shift($venta->sumarProducto($inv['codproductos']));
	$cantidadventatotal=$comp['cantidadventatotal']?$comp['cantidadventatotal']:'0';


	$cantidadstock=$cantidadcompratotal-$cantidadventatotal;
	
	$cantidadc+=$cantidadcompratotal;
	$cantidadv+=$cantidadventatotal;
	$cantidads+=$cantidadstock;

	/**/
	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(80,$inv['nombre'],0,"");
	$pdf->CuadroCuerpo(40,$cantidadcompratotal,1,"R",1);
	$pdf->CuadroCuerpo(40,$cantidadventatotal,1,"R",1);
	$pdf->CuadroCuerpo(40,$cantidadstock,1,"R",1);
	$j=0;
	$ven=$venta->mostrarTodo("codproductos=".$inv['codproductos']."  $fechas ");
	if(count($ven)){
		$pdf->ln();
		
		$pdf->CuadroCuerpo(90,"",0,"C",0);
		$pdf->CuadroCuerpoPersonalizado(10,"N",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(20,"Cant",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(20,"Cant",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(20,"Total",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(20,"FechaVen",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(40,"Cliente",0,"C",1,"B");
		$pdf->CuadroCuerpoPersonalizado(30,"Observación",0,"C",1,"B");
	}
	$cantidadp=0;
	$preciounitariop=0;
	$totalp=0;
	foreach($ven as $v){$j++;
		$clie=array_shift($cliente->mostrar($v['codcliente']));
		$dist=array_shift($distribuidor->mostrar($v['coddistribuidor']));
		$cantidadp+=$v['cantidad'];
		$preciounitariop+=$v['preciounitario'];
		$totalp+=$v['total'];
		
		$pdf->ln();
		$pdf->CuadroCuerpo(90,"",0,"R",0);
		$pdf->CuadroCuerpo(10,$j,0,"R",1);
		$pdf->CuadroCuerpo(20,$v['cantidad'],0,"R",1);
		$pdf->CuadroCuerpo(20,$v['preciounitario'],0,"R",1);
		$pdf->CuadroCuerpo(20,$v['total'],0,"R",1);
		$pdf->CuadroCuerpo(20,fecha2Str($v['fechaventa']),0,"R",1);
		$pdf->CuadroCuerpo(40,$clie['nombre'],0,"L",1);
		$pdf->CuadroCuerpo(30,$v['observacion'],0,"L",1);
		
	}
		
	if(count($ven)){
		$pdf->ln();
		$pdf->CuadroCuerpo(90,"",0,"R",0);
		$pdf->CuadroCuerpo(10,"Total",1,"R",1);
		$pdf->CuadroCuerpo(20,$cantidadp,1,"R",1);
		$pdf->CuadroCuerpo(20,$preciounitariop,1,"R",1);
		$pdf->CuadroCuerpo(20,$totalp,1,"R",1);
		$pdf->ln();
	}
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(90,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(40,$cantidadc,1,"R",1);
$pdf->CuadroCuerpoResaltar(40,$cantidadv,1,"R",1);
$pdf->CuadroCuerpoResaltar(40,$cantidads,1,"R",1);
//$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>