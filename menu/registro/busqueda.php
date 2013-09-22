<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/menucomida.php';
	include_once '../../class/comida.php';
	extract($_POST);
	$tipo=$tipo!=""?$tipo:"%";
	$menucomida=new menucomida;
	$comida=new comida;
	$comi=$menucomida->mostrarTodo("fechacomida LIKE '%$fechacomida%'");
	foreach($comi as $c){$i++;
		$desayuno=array_shift($comida->mostrar($c['desayuno']));
		$sopa=array_shift($comida->mostrar($c['sopa']));
		$segundo=array_shift($comida->mostrar($c['segundo']));
		$postre=array_shift($comida->mostrar($c['postre']));
		$tetarde=array_shift($comida->mostrar($c['tetarde']));
		$cena=array_shift($comida->mostrar($c['cena']));
		
		$datos[$i]['codmenucomida']=$c["codmenucomida"];
		$datos[$i]['fechacomida']=$c["fechacomida"];
		$datos[$i]['desayuno']=$desayuno["nombre"];
		$datos[$i]['sopa']=$sopa["nombre"];
		$datos[$i]['segundo']=$segundo["nombre"];
		$datos[$i]['postre']=$postre["nombre"];
		$datos[$i]['tetarde']=$tetarde["nombre"];
		$datos[$i]['cena']=$cena["nombre"];
		$datos[$i]['cantidad']=$c["cantidad"];
	}
	$titulo=array("fechacomida"=>"Fecha de Comida","desayuno"=>"Desayuno","sopa"=>"Sopa","segundo"=>"Segundo","postre"=>"Postre","tetarde"=>"Té Tarde","cena"=>"Cena","cantidad"=>"Cantidad");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>