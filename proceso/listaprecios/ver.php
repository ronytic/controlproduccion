<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Lista de Precios";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(60,"Nombre del Producto");
		$this->TituloCabecera(30,"Costo de Prod.");
		
		$this->TituloCabecera(30,"Costo Mínimo");
		$this->TituloCabecera(30,"Costo Máximo");
		$this->TituloCabecera(30,"Stock");
		$this->TituloCabecera(15,"Unidad");
		$this->TituloCabecera(20,"F. Compra");
		$this->TituloCabecera(20,"F. Venc.");
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
include_once '../../class/configuracion.php';
$configuracion=new configuracion;
$venta=new venta;
$compra=new compra;
$productos=new productos;
$distribuidor=new distribuidor;
$cliente=new cliente;

$conf=array_shift($configuracion->mostrar(1));
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
foreach($productos->mostrarTodos($where,"nombre") as $inv){
	switch($proceso){
		case 'Procesado':{$TipoProceso=" and tipo='Procesado'";}break;
		case 'Comprado':{$TipoProceso=" and tipo=''";}break;	
		default: {$TipoProceso="";}break;
	}
	$where2="codproductos LIKE '{$inv['codproductos']}' $TipoProceso";
	//$comp=array_shift($compra->sumarProducto());
	
	$compralista=$compra->mostrarTodo($where2,1);
	
	
	$cantidadcompratotal=count($compralista);
	
	//$cantidadcompratotal=$comp['cantidadcompratotal']?$comp['cantidadcompratotal']:'0';
	if($cantidadcompratotal>0){
		$i++;
		
	/*$comp=array_shift($venta->sumarProducto($inv['codproductos']));
	$cantidadventatotal=$comp['cantidadventatotal']?$comp['cantidadventatotal']:'0';
*/
	


	
	$pdf->CuadroCuerpo(10,$i,1,"R",1);
	$pdf->CuadroCuerpo(60,$inv['nombre'],1,"",1);
	$in=0;
		foreach($compralista as $cl){$in++;
			if($in>1){
				$pdf->CuadroCuerpo(10,"",0,"R",0);
				$pdf->CuadroCuerpo(60,"",0,"",0);
			}
			$costoproduccion=$cl['preciounitario'];
			$costominimodeproduccion=round($conf['costominimodeproduccion']/100*$costoproduccion,2);
			$costomaximodeproduccion=round($conf['costomaximodeproduccion']/100*$costoproduccion,2);
			
			$preciominimo=$costoproduccion+$costominimodeproduccion;
			$preciomaximo=$costoproduccion+$costomaximodeproduccion;
			$pdf->CuadroCuerpo(30,$costoproduccion,1,"R",1);
			$pdf->CuadroCuerpo(30,$preciominimo,1,"R",1);
			$pdf->CuadroCuerpo(30,$preciomaximo,1,"R",1);
			$pdf->CuadroCuerpo(30,$cantidadcompratotal,0,"R",1);
			
			$pdf->CuadroCuerpo(15,$inv['unidad'],0,"",1);
			
			$pdf->CuadroCuerpo(20,fecha2Str($cl['fechacompra']),0,"",1);
			$pdf->CuadroCuerpo(20,fecha2Str($cl['fechavencimiento']),0,"",1);
			$pdf->ln();
		}
		$pdf->ln();
	}
}
/*$pdf->Linea();

$pdf->CuadroCuerpoResaltar(90,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(40,$cantidadc,1,"R",1);
$pdf->CuadroCuerpoResaltar(40,$cantidadv,1,"R",1);
$pdf->CuadroCuerpoResaltar(40,$cantidads,1,"R",1);
//$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");*/
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>