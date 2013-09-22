<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Productos de Inventarios";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(60,"Nombre Producto");
		$this->TituloCabecera(20,"FechaEnt");
		$this->TituloCabecera(20,"FechaSal");
		$this->TituloCabecera(20,"Cant.Ent");
		$this->TituloCabecera(20,"Cant.Inven");
		$this->TituloCabecera(30,"Código");

	}	
}


$codproductos=$codproductos!=""?$codproductos:"%";
$fechasalida=$fechasalida!=""?$fechasalida:"%";
$existente=$existente=="1"?'and cantidadsalida>0':'';
include_once("../../class/productos.php");
include_once("../../class/inventario.php");
include_once("../../class/usuarios.php");
$inventario=new inventario;
$productos=new productos;
$usuarios=new usuarios;
$where="codproductos LIKE '$codproductos' and fechasalida LIKE '$fechasalida' $existente";
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
$pdf=new PDF("P","mm","legal");
$pdf->AddPage();
$totales=array();
$cantidade=0;
$cantidads=0;
foreach($inventario->mostrarTodos($where) as $inv){$i++;
	$cantidade+=$inv['cantidadentrada'];
	$cantidads+=$inv['cantidadsalida'];
	$pro=array_shift($productos->mostrar($inv['codproductos']));
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(60,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(20,fecha2Str($inv['fechaentrada']),0,"");
	$pdf->CuadroCuerpo(20,fecha2Str($inv['fechasalida']),0,"");
	$pdf->CuadroCuerpo(20,($inv['cantidadentrada'])."Kg",0,"R");
	$pdf->CuadroCuerpo(20,($inv['cantidadsalida'])."Kg",0,"R");
	$pdf->CuadroCuerpo(30,($inv['codigo']),0,"L",0);
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(110,"Totales",1,"R");
$pdf->CuadroCuerpoResaltar(20,$cantidade."Kg",1,"R");
$pdf->CuadroCuerpoResaltar(20,$cantidads."Kg",1,"R");
$pdf->CuadroCuerpoResaltar(30,"",1,"R");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$usu4=array_shift($usuarios->mostrarTodo("nivel=4"));
$usu3=array_shift($usuarios->mostrarTodo("nivel=3"));
$usu2=array_shift($usuarios->mostrarTodo("nivel=2"));
$pdf->CuadroCuerpoPersonalizado(90,$usu4['nombre']." ".$usu4['paterno']." ".$usu4['materno'],0,"C",0,"B");
$pdf->CuadroCuerpoPersonalizado(90,$usu3['nombre']." ".$usu3['paterno']." ".$usu3['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(90,"Encargado de Clase 1",0,"C",0);
$pdf->CuadroCuerpo(90,"Jefe de Servicio",0,"C",0);
$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(180,$usu2['nombre']." ".$usu2['paterno']." ".$usu2['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(180,"Comandante",0,"C",0);
$pdf->Output();
?>