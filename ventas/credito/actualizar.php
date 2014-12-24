<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/ventageneral.php");
$ventageneral=new ventageneral;

include_once("../../class/ventacredito.php");
$ventacredito=new ventacredito;

extract($_POST);
//empieza la copia de archivos
$totalcancelado=($totalcancelado+$montopago);
$valores=array(	//"fechaventa"=>"'$fechaventa'",
				//"codproductos"=>"'$codproductos'",
				//"cantidad"=>"'$cantidadventatotal'",
				//"preciounitario"=>"'$preciounitario'",
				"totalcancelado"=>"'$totalcancelado'",
				
				"fechaultimopago"=>"'$fechapago'",
				);
				$ventageneral->actualizar($valores,$id);
				
				
				$valores=array(	
				"codventageneral"=>"'$id'",
				"montopago"=>"'$montopago'",
				"totaladeudado"=>"'$totaladeudado'",
				"totaladeudadoalafecha"=>"'$totaladeudadoalafecha'",
				"fechapago"=>"'$fechapago'",
				"observacion"=>"'$observacion'",
				);
					$ventacredito->insertar($valores);
				
header("Location:pagar.php?id=".$id);				
				
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>