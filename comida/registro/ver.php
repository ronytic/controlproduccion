<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Comida";
$id=$_GET['id'];
class PDF extends PPDF{
	
}


include_once("../../class/comida.php");
include_once("../../class/productos.php");
$comida=new comida;
$productos=new productos;
$pdf=new PDF;
$pdf->AddPage();
$comi=array_shift($comida->mostrar($id));
switch($comi['tipo']){
		 case '1':{$tipo="Desayuno";}break;
		 case '2':{$tipo="Sopa";}break;
		 case '3':{$tipo="Segundo";}break;
		 case '4':{$tipo="Postre";}break;
		 case '5':{$tipo="Te Tarde";}break;
		 case '6':{$tipo="Cena";}break;
		}
$valores=array("Nombre"=>$comi['nombre'],
				"Tipo"=>$tipo
			);
for($i=1;$i<=20;$i++){
	if($comi["ingrediente".$i]!="0"){
		$pro=array_shift($productos->mostrar($comi["ingrediente".$i]));
		
		$valores=array_merge($valores,array("Ingrediente $i"=>$pro['nombre']));	
	}
}
mostrarI($valores);

$foto="../foto/".$comi['foto'];
if(!empty($comi['foto']) && file_exists($foto)){
	$pdf->Image($foto,155,45,40,40);	
}

$pdf->Output();
?>