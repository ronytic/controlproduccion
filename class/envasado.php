<?php
include_once("bd.php");
class envasado extends bd{
	var $tabla="envasado";
	function sumarProducto($codproductos){
		$this->campos=array("sum(cantidad) as cantidadventatotal");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
}
?>