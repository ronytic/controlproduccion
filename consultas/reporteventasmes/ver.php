<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Venta de Productos  Por mes";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin,$tipo;
		if($fechainicio!=""){
		$this->CuadroCabecera(30,"Fecha de Inicio:",20,fecha2Str($fechainicio));
		}
		if($fechafin!=""){
		$this->CuadroCabecera(30,"Fecha Fin:",20,fecha2Str($fechafin));
		}
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(60,"Nombre Producto");
		$this->TituloCabecera(15,"Uni");
		$this->TituloCabecera(20,"Cant");
		if($tipo=="Detallado"){
			$this->TituloCabecera(20,"PrecUni");
			$this->TituloCabecera(20,"Total");
			$this->TituloCabecera(30,"CodControl");
			$this->TituloCabecera(40,"Cliente");
			$this->TituloCabecera(20,"FechaVen");
		}
	}	
}


$inicial=$inicial!=""?$inicial:"%";
$final=$final!=""?$final:"%";


$existente=$existente=="1"?'and cantidadstock>0':'';
$fechainicio=$anio."-".$mes."-1";
$fechafin=$anio."-".$mes."-30";


if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas="  (fechaventa BETWEEN '$fechainicio' and '$fechafin')";
}

include_once("../../class/productos.php");
include_once("../../class/venta.php");
include_once("../../class/distribuidor.php");
include_once("../../class/cliente.php");
$venta=new venta;
$productos=new productos;
$distribuidor=new distribuidor;
$cliente=new cliente;
$where=" $fechas ";
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
if($tipo!="Detallado"){
	$pdf=new PDF("P","mm","legal");
}else{
	$pdf=new PDF("L","mm","legal");
}
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;

if($tipo!="Detallado"){
$venta->campos=array("sum(cantidad) as cantidad,max(preciounitario) as preciounitario,sum(total) as total,codproductos,codcliente,coddistribuidor,codigocontrol");
$fechas.=" GROUP BY codproductos";
}
foreach($venta->mostrarTodos($where,"fechaventa") as $inv){$i++;
	$cantidadt+=$inv['cantidad'];
	$preciot+=$inv['preciounitario'];
	$totalt+=$inv['total'];	
	$cantidadstock+=$inv['cantidadstock'];

	$pro=array_shift($productos->mostrar($inv['codproductos']));
	$clie=array_shift($cliente->mostrar($inv['codcliente']));
	$dist=array_shift($distribuidor->mostrar($inv['coddistribuidor']));
	
	$pdf->CuadroCuerpo(10,$i,0,"R",1);
	$pdf->CuadroCuerpo(60,$pro['nombre'],0,"",1);
	$pdf->CuadroCuerpo(15,$pro['unidad'],0,"",1);
	$pdf->CuadroCuerpo(20,($inv['cantidad']),1,"R",1);
	if($tipo=="Detallado"){
	$pdf->CuadroCuerpo(20,($inv['preciounitario']),1,"R",1);
	$pdf->CuadroCuerpo(20,($inv['total']),1,"R",1);
	$pdf->CuadroCuerpo(30,($inv['codigocontrol']),1,"R",1);
	$pdf->CuadroCuerpo(40,($clie['nombre']),1,"R",1);
	$pdf->CuadroCuerpo(20,fecha2Str($inv['fechaventa']),1,"",1);
	}	
	//$pdf->CuadroCuerpo(50,($clie['nombre']),1,"",1);
	//$pdf->CuadroCuerpo(50,($dist['nombre']),1,"",1);
	//$pdf->CuadroCuerpo(60,($inv['observacion']),1,"L",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(85,"Totales",1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$cantidadt,1,"R",1);
if($tipo=="Detallado"){
$pdf->CuadroCuerpoResaltar(20,$preciot,1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$totalt,1,"R",1);
}
//$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>