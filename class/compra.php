<?php
include_once("bd.php");
class compra extends bd{
	var $tabla="compra";
	function sumar($codproductos){
		$this->campos=array("sum(cantidadstock) as cantidadtotalstock");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
}
?>