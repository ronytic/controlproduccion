<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/vendedor.php';
	extract($_POST);

	$vendedor=new vendedor;
	$pro=$vendedor->mostrarTodo("nombre LIKE '%$nombre%' and direccion LIKE '%$direccion%' and telefono LIKE '%$telefono%' and observacion LIKE '%$observacion%'");
	$titulo=array("nombre"=>"Nombre","ci"=>"C.I.","direccion"=>"Dirección","telefono"=>"Teléfono","observacion"=>"Observación");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>