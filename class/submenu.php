<?php 
include_once("bd.php");
class submenu extends bd{
	var $tabla="submenu";
	function mostrarSubMenu($codUsuario,$menu){
		$this->campos=array("*");
		switch ($codUsuario) {
			case 1:{return $this->getRecords("superadmin=1 and idmenu=$menu and activo=1","orden");}break;
			case 2:{return $this->getRecords("jefeproduccion=1 and idmenu=$menu and activo=1","orden");}break;
			case 3:{return $this->getRecords("responsableinspeccion=1 and idmenu=$menu and activo=1","orden");}break;
			case 4:{return $this->getRecords("vendedor=1 and idmenu=$menu and activo=1","orden");}break;
		}
	}
}
?>