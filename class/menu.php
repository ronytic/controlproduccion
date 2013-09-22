<?php 
include_once("bd.php");
class menu extends bd{
	var $tabla="menu";
	function mostrarMenu($Nivel){
		$this->campos=array("*");
		switch ($Nivel) {
			case 1:{return $this->getRecords("superadmin=1 and activo=1","orden");}break;
			case 2:{return $this->getRecords("jefeproduccion=1 and activo=1","orden");}break;
			case 3:{return $this->getRecords("responsableinspeccion=1 and activo=1","orden");}break;
			case 4:{return $this->getRecords("vendedor=1 and activo=1","orden");}break;
		}
	}
}
?>