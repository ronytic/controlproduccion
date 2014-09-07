<?php
include_once("bd.php");
class envasado extends bd{
	var $tabla="envasado";
	function sumarProducto($codproductos){
		$this->campos=array("sum(cantidadstock) as cantidadventatotal");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
	function agrupado(){
		$this->campos=array("sum(cantidad) as cantidadtotal,codenvase,codproductos,codcompra");
		return $this->getRecords("activo=1","","codproductos,codenvase");	
	}
}
?>