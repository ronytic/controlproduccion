<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/comida.php';
	extract($_POST);
	$tipo=$tipo!=""?$tipo:"%";
	$comida=new comida;
	$comi=$comida->mostrarTodo("nombre LIKE '%$nombre%' and tipo LIKE '$tipo'");
	foreach($comi as $c){$i++;
		$datos[$i]['codcomida']=$c["codcomida"];
		$datos[$i]['nombre']=$c["nombre"];
		switch($c['tipo']){
		 case '1':{$datos[$i]['tipo']="Desayuno";}break;
		 case '2':{$datos[$i]['tipo']="Sopa";}break;
		 case '3':{$datos[$i]['tipo']="Segundo";}break;
		 case '4':{$datos[$i]['tipo']="Postre";}break;
		 case '5':{$datos[$i]['tipo']="Te Tarde";}break;
		 case '6':{$datos[$i]['tipo']="Cena";}break;
		}
	}
	$titulo=array("nombre"=>"Nombre","tipo"=>"Tipo");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>