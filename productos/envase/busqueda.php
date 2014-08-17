<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/envase.php';
	extract($_POST);

	$envase=new envase;
	$env=$envase->mostrarTodo("cantidad LIKE '%$cantidad%'","cantidad");
	$titulo=array("cantidad"=>"Cantidad","observacion"=>"Observación");
	listadoTabla($titulo,$env,1,"modificar.php","eliminar.php","ver.php");
}
?>