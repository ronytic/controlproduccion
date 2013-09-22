<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/pedidos.php");
$pedidos=new pedidos;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"codcliente"=>"'$codcliente'",
				"codproductos"=>"'$codproductos'",
				"cantidad"=>"'$cantidad'",
				"fechapedido"=>"'$fechapedido'",
				"fechaentrega"=>"'$fechaentrega'",
				"estado"=>"'$estado'",
				"observacion"=>"'$observacion'",
				);
				$pedidos->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>