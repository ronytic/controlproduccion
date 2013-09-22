<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Datos de Clientes";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=array_shift($cliente->mostrar($id));
$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$cli['nombre'],
				"Dirección"=>$cli['direccion'],
				"Teléfono"=>$cli['telefono'],
				"Departamento"=>$cli['departamento'],
				"Observación"=>$cli['observacion'].""
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>