<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/venta.php");
$venta=new venta;
include_once("../../class/compra.php");
$compra=new compra;

extract($_POST);
//empieza la copia de archivos
/*
if(($_FILES['curriculum']['type']=="application/pdf" || $_FILES['curriculum']['type']=="application/msword" || $_FILES['curriculum']['type']=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") && $_FILES['curriculum']['size']<="500000000"){
	@$curriculum=$_FILES['curriculum']['name'];
	@copy($_FILES['curriculum']['tmp_name'],"../curriculum/".$_FILES['curriculum']['name']);
}else{
	//mensaje que no es valido el tipo de archivo	
	$mensaje[]="Archivo no válido del curriculum. Verifique e intente nuevamente";
}
*/
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/


foreach($m as $ma){
	extract($ma);
	
	$cantidadventatotal=$total;
	$fecha=date("Y-m-d");
	$totalproducto=0;
	foreach($compra->mostrarTodo("codproductos=$codproductos and cantidadstock>0","fechacompra") as $inv){
		$totalproducto+=$inv['cantidadstock'];
	}
	
	//echo $totalproducto;
	if($totalproducto<$cantidadventatotal){
		$mensaje[]="No Existe en Inventario la Cantidad que Solicita<hr><strong>Cantidad de Inventario: $totalproducto<br>Cantidad de Solicitada: $cantidadventatotal</strong>";
	}else{
		foreach($compra->mostrarTodo("codproductos=$codproductos and cantidadstock>0","fechacompra") as $inv){
			if((float)$cantidadventatotal<=(float)$inv['cantidadstock']){
				//echo "si";
				$mensaje[]="Se Registraron los envases de los los productos correctamente";
				$cantidad=$inv['cantidadstock']-$cantidadventatotal;
				$valores=array("cantidadstock"=>"$cantidad","fechaventa"=>"'$fecha'");
				$compra->actualizar($valores,$inv["codcompra"]);
				
				$valores=array(	"fechaventa"=>"'$fechaventa'",
					"codproductos"=>"'$codproductos'",
					"cantidad"=>"'$cantidadventatotal'",
					"preciounitario"=>"'$preciounitario'",
					"total"=>"'$total'",
					"codcliente"=>"'$codcliente'",
					"coddistribuidor"=>"'$coddistribuidor'",
					"codvendedor"=>"'$codvendedor'",
					"observacion"=>"'$observacion'",
					);
				//$venta->insertar($valores);
				/*echo "<pre>";
				print_r($valores);
				echo "</pre>";*/
				break;	
			}else{
				//echo $cantidadsalida;
				$cantidad=$cantidad-$inv['cantidadstock'];
				$valores=array("cantidadstock"=>0,"fechaventa"=>"'$fecha'");
				$compra->actualizar($valores,$inv["codcompra"]);
			}
		}
	}
}//Fin Foreach

//$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";
//exit();


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>