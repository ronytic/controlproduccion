<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/venta.php");
$venta=new venta;
include_once("../../class/compra.php");
$compra=new compra;
include_once("../../class/envasado.php");
$envasado=new envasado;

include_once("../../class/ventageneral.php");
$ventageneral=new ventageneral;

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
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
if($modopago=="contado"){
	$totalcancelado=$tt;	
}else{
	$totalcancelado=0;	
}
$valores=array(	
				"total"=>"'$tt'",
				"totalcancelado"=>"'$totalcancelado'",
				"coddistribuidor"=>"'$coddistribuidor'",
				"codvendedor"=>"'$codvendedor'",
				"codcliente"=>"'$codcliente'",
				"codigocontrol"=>"'$codigocontrol'",
				"fechaventa"=>"'$fechaventa'",
				"observacion"=>"'$observacion'",
				"tipoventa"=>"'$modopago'",
				"tipo"=>"'$tipo'",
				);
					$ventageneral->insertar($valores);
					$ultimo=$ventageneral->last_id();
					
foreach($m as $ma){
	extract($ma);
	
	$cantidadventatotal=$cantidad;
	$fecha=date("Y-m-d");
	$totalproducto=0;
	$dividido=explode("-",$codproductos);
	//print_r($dividido);
	if($dividido[0]=="e"){
		$codproduc=$dividido[1];
		$codenvase=$dividido[2];
		foreach($envasado->mostrarTodo("codproductos=$codproduc and codenvase=$codenvase and cantidadstock>0","") as $inv){
			$totalproducto+=$inv['cantidadstock'];
			//echo "A";
		}
		//echo $totalproducto;
		if($totalproducto<$cantidad){
			$mensaje[]="No Existe en Inventario la Cantidad de productos Envasados que Solicita<hr><strong>Cantidad de Inventario: $totalproducto<br>Cantidad de Solicitada: $cantidad</strong>";
		}else{
			foreach($envasado->mostrarTodo("codproductos=$codproduc and codenvase=$codenvase and cantidadstock>0","fecha") as $inv){
				if((float)$cantidad<=(float)$inv['cantidadstock']){
					//echo "si";
					$mensaje[]="Las Ventas de sus PRODUCTOS ENVASADOS SE REGISTRO CORRECTAMENTE";
					$cantidad=$inv['cantidadstock']-$cantidad;
					$valores=array("cantidadstock"=>"$cantidad","fechaventa"=>"'$fecha'");
					$envasado->actualizar($valores,$inv["codenvasado"]);
					
					$valores=array(	"fechaventa"=>"'$fechaventa'",
						"codproductos"=>"'$codproduc'",
						"codenvase"=>"'$codenvase'",
						"codenvasado"=>"'".$inv['codenvasado']."'",
						"cantidad"=>"'$cantidadventatotal'",
						"preciounitario"=>"'$preciounitario'",
						"total"=>"'$total'",
						"codcliente"=>"'$codcliente'",
						"coddistribuidor"=>"'$coddistribuidor'",
						"codvendedor"=>"'$codvendedor'",
						"observacion"=>"'$observacion'",
						"tipo"=>"'envasado'",
						"codigocontrol"=>"'$codigocontrol'",
						"codventageneral"=>"'$ultimo'",
						"tipoventa"=>"'$tipo'",
					);
					$venta->insertar($valores);
					//echo "Guardando Venta";
					/*echo "<pre>";
					print_r($valores);
					echo "</pre>";*/
					break;	
				}else{
					//echo $cantidadsalida;
					$cantidad=$cantidad-$inv['cantidadstock'];
					$valores=array("cantidadstock"=>0,"fechaventa"=>"'$fecha'");
					$envasado->actualizar($valores,$inv["codenvasado"]);
					//echo "Actualizando";
				}
			}
		}
		
		
		//Fin de Venta Envasado
	}else{//Si es Venta Directa
		
		foreach($compra->mostrarTodo("codproductos=$codproductos and cantidadstock>0","fechacompra") as $inv){
			$totalproducto+=$inv['cantidadstock'];
		}
	
		//echo $totalproducto;
		if($totalproducto<$cantidad){
			$mensaje[]="No Existe en Inventario la Cantidad que Solicita<hr><strong>Cantidad de Inventario: $totalproducto<br>Cantidad de Solicitada: $cantidad</strong>";
		}else{
			foreach($compra->mostrarTodo("codproductos=$codproductos and cantidadstock>0","fechacompra") as $inv){
				if((float)$cantidad<=(float)$inv['cantidadstock']){
					//echo "si";
					$mensaje[]="Las Ventas de sus PRODUCTOS SE REGISTRO CORRECTAMENTE";
					$cantidad=$inv['cantidadstock']-$cantidad;
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
						"tipo"=>"'directo'",
						"codigocontrol"=>"'$codigocontrol'",
						"codventageneral"=>"'$ultimo'",
						"tipoventa"=>"'$tipo'",
					);
					$venta->insertar($valores);
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
	}//Fin Producto Directo
}//Fin Foreach

//$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";
//exit();


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>