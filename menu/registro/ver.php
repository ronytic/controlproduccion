<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Menu Comida";
$id=$_GET['id'];
class PDF extends PPDF{
	
}


include_once("../../class/menucomida.php");
include_once("../../class/comida.php");
include_once("../../class/productos.php");
$menucomida=new menucomida;
$comida=new comida;
$productos=new productos;
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();
$menucomi=array_shift($menucomida->mostrar($id));
$desayuno=array_shift($comida->mostrar($menucomi['desayuno']));
$sopa=array_shift($comida->mostrar($menucomi['sopa']));
$segundo=array_shift($comida->mostrar($menucomi['segundo']));
$postre=array_shift($comida->mostrar($menucomi['postre']));
$tetarde=array_shift($comida->mostrar($menucomi['tetarde']));
$cena=array_shift($comida->mostrar($menucomi['cena']));
switch($comi['tipo']){
		 case '1':{$tipo="Desayuno";}break;
		 case '2':{$tipo="Sopa";}break;
		 case '3':{$tipo="Segundo";}break;
		 case '4':{$tipo="Postre";}break;
		 case '5':{$tipo="Te Tarde";}break;
		 case '6':{$tipo="Cena";}break;
		}
$valores=array("Fecha Comida"=>fecha2Str($menucomi['fechacomida']),
				"Desayuno"=>$desayuno['nombre'],
				"Sopa"=>$sopa['nombre'],
				"Segundo"=>$segundo['nombre'],
				"Postre"=>$postre['nombre'],
				"Té tarde"=>$tetarde['nombre'],
				"Cena"=>$cena['nombre'],
				"Cantidad"=>$menucomi['cantidad']
			);
/*for($i=1;$i<=20;$i++){
	if($comi["ingrediente".$i]!="0"){
		$pro=array_shift($productos->mostrar($comi["ingrediente".$i]));
		
		$valores=array_merge($valores,array("Ingrediente $i"=>$pro['nombre']));	
	}
}*/
mostrarI($valores);
/*
$foto="../foto/".$comi['foto'];
if(!empty($comi['foto']) && file_exists($foto)){
	$pdf->Image($foto,155,45,40,40);	
}*/

$pdf->Output();
?>