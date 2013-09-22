<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de SEMANA MENÚ DE COMIDA";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin;
		$this->CuadroCabecera(30,"Fecha Inicio:",20,fecha2Str($fechainicio));
		$this->CuadroCabecera(30,"Fecha Fin:",20,fecha2Str($fechafin));
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(20,"Día");
		$this->TituloCabecera(20,"Fecha");
		$this->TituloCabecera(42,"Desayuno");
		$this->TituloCabecera(42,"Sopa");
		$this->TituloCabecera(42,"Segundo");
		$this->TituloCabecera(42,"Postre");
		$this->TituloCabecera(42,"Té Tarde");
		$this->TituloCabecera(42,"Cena");
		$this->TituloCabecera(20,"Cantidad");
	}	
}


include_once("../../class/comida.php");
include_once("../../class/menucomida.php");
include_once("../../class/usuarios.php");
$menucomida=new menucomida;
$comida=new comida;
$usuarios=new usuarios;
$where="fechacomida BETWEEN '$fechainicio' and '$fechafin'";
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
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
foreach($menucomida->mostrarTodos($where) as $menucomi){$i++;
	$desayuno=array_shift($comida->mostrar($menucomi['desayuno']));
	$sopa=array_shift($comida->mostrar($menucomi['sopa']));
	$segundo=array_shift($comida->mostrar($menucomi['segundo']));
	$postre=array_shift($comida->mostrar($menucomi['postre']));
	$tetarde=array_shift($comida->mostrar($menucomi['tetarde']));
	$cena=array_shift($comida->mostrar($menucomi['cena']));

	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(20,capitalizar(strftime("%A",strtotime($menucomi['fechacomida']))));
	$pdf->CuadroCuerpo(20,fecha2Str($menucomi['fechacomida']));
	$pdf->CuadroCuerpo(42,$desayuno['nombre'],0);
	$pdf->CuadroCuerpo(42,$sopa['nombre'],0);
	$pdf->CuadroCuerpo(42,$segundo['nombre'],0);
	$pdf->CuadroCuerpo(42,$postre['nombre'],0);
	$pdf->CuadroCuerpo(42,$tetarde['nombre'],0);
	$pdf->CuadroCuerpo(42,$cena['nombre'],0);
	$pdf->CuadroCuerpo(20,$menucomi['cantidad'],0,"R");
	


	$pdf->Ln();
}

$pdf->Ln();

$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$usu4=array_shift($usuarios->mostrarTodo("nivel=4"));
$usu3=array_shift($usuarios->mostrarTodo("nivel=3"));
$usu2=array_shift($usuarios->mostrarTodo("nivel=2"));
$pdf->CuadroCuerpoPersonalizado(140,$usu4['nombre']." ".$usu4['paterno']." ".$usu4['materno'],0,"C",0,"B");
$pdf->CuadroCuerpoPersonalizado(140,$usu3['nombre']." ".$usu3['paterno']." ".$usu3['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(140,"Encargado de Clase 1",0,"C",0);
$pdf->CuadroCuerpo(140,"Jefe de Servicio",0,"C",0);
$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(280,$usu2['nombre']." ".$usu2['paterno']." ".$usu2['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(280,"Comandante",0,"C",0);
$pdf->Output();
?>