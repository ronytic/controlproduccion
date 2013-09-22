<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Proveedor";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=array_shift($proveedor->mostrar($id));
$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$pro['nombre'],
				"Dirección"=>$pro['direccion'],
				"Teléfono"=>$pro['telefono'],
				"Correo"=>$pro['email']."",
				"Origen"=>$pro['origen']."",
				"Observación"=>$pro['observacion'].""
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>