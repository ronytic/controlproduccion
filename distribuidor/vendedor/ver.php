<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Vendedor";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/Vendedor.php");
$Vendedor=new Vendedor;
$cli=array_shift($Vendedor->mostrar($id));
$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$cli['nombre'],
				"C.I."=>$cli['ci'],
				"Dirección"=>$cli['direccion'],
				"Teléfono"=>$cli['telefono'],
				
				"Observación"=>$cli['observacion'].""
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>