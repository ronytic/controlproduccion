<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Compra de Productos";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin;
		if($fechainicio!=""){
		$this->CuadroCabecera(30,"Fecha de Inicio:",20,fecha2Str($fechainicio));
		}
		if($fechafin!=""){
		$this->CuadroCabecera(30,"Fecha Fin:",20,fecha2Str($fechafin));
		}
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(55,"Nombre Producto");
		$this->TituloCabecera(15,"Uni");
		$this->TituloCabecera(15,"Cant");
		
		$this->TituloCabecera(15,"PrecUni");
		$this->TituloCabecera(15,"Total");
		$this->TituloCabecera(20,"CantStock");
		$this->TituloCabecera(20,"FechaCom");
		$this->TituloCabecera(35,"Proveedor");
		$this->TituloCabecera(50,"Observación");
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
include_once("../../class/compra.php");
include_once("../../class/proveedor.php");
$compra=new compra;
$productos=new productos;
$proveedor=new proveedor;
$where="codproductos LIKE '$codproductos' $fechas  $existente";
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
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
foreach($compra->mostrarTodos($where,"fechacompra") as $inv){$i++;
	$cantidadt+=$inv['cantidad'];
	$preciot+=$inv['preciounitario'];
	$totalt+=$inv['total'];
	$cantidadstock+=$inv['cantidadstock'];

	$pro=array_shift($productos->mostrar($inv['codproductos']));
	$prov=array_shift($proveedor->mostrar($inv['codproveedor']));
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(55,$pro['nombre'],0,"");
$pdf->CuadroCuerpo(15,$pro['unidad'],0,"");
	$pdf->CuadroCuerpo(15,($inv['cantidad']),1,"R",1);
		
	$pdf->CuadroCuerpo(15,($inv['preciounitario']),1,"R",1);
	$pdf->CuadroCuerpo(15,($inv['total']),1,"R",1);
	$pdf->CuadroCuerpo(20,($inv['cantidadstock']),1,"R",1);
	$pdf->CuadroCuerpo(20,fecha2Str($inv['fechacompra']),1,"",1);
	$pdf->CuadroCuerpo(35,($prov['nombre']),1,"",1);
	$pdf->CuadroCuerpo(50,($inv['observacion']),1,"L",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(80,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(15,$cantidadt,1,"R",1);
$pdf->CuadroCuerpoResaltar(15,$preciot,1,"R",1);
$pdf->CuadroCuerpoResaltar(15,$totalt,1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>