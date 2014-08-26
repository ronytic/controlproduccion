<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/envase.php';
	extract($_POST);

	$envase=new envase;
	$env=$envase->mostrarTodo("cantidad LIKE '%$cantidad%' and unidad LIKE '%$unidad%'","cantidad,unidad");
	$titulo=array("cantidad"=>"Cantidad","unidad"=>"Unidad","observacion"=>"Observación");
	listadoTabla($titulo,$env,1,"modificar.php","eliminar.php","ver.php");
}
?>