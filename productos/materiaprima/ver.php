<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Materia Prima";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/materiaprima.php");
$materiaprima=new materiaprima;
$mp=array_shift($materiaprima->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=array_shift($productos->mostrar($mp['codproductos']));

include_once("../../class/usuarios.php");
$usuarios=new usuarios;
$us=array_shift($usuarios->mostrar($mp['codresponsable']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Fecha de Registro"=>fecha2Str($pro['fecharegistro']),
				"Producto"=>$pro['nombre'],
				"Tomar Muestra y Verificar"=>"",
				"Color"=>$mp['color'],
				"Sabor"=>$mp['sabor'],
				"Olor"=>$mp['olor'],
				"Condición de Empaque"=>$mp['condicionempaque'],
				"Responsable"=>$us['nombre'],
				"Fecha de Vencimiento"=>fecha2Str($mp['fechavencimiento']),
				"Estado"=>($mp['estado']),
				"Observación"=>($mp['observacion']),
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>