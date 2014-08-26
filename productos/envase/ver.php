<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Tipo de Envases";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/envase.php");
$envase=new envase;
$env=array_shift($envase->mostrar($id));

/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=array_shift($proveedor->mostrar($pro['codproveedor']));*/

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Cantidad"=>$env['cantidad'],
				"Unidad"=>$env['unidad'],
				"Observación"=>$env['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>