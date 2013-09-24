<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/distribuidor.php';
	extract($_POST);

	$distribuidor=new distribuidor;
	$pro=$distribuidor->mostrarTodo("nombre LIKE '%$nombre%' and direccion LIKE '%$direccion%' and telefono LIKE '%$telefono%' and observacion LIKE '%$observacion%'");
	$titulo=array("nombre"=>"Nombre","direccion"=>"Dirección","telefono"=>"Teléfono","departamento"=>"Departamento","observacion"=>"Observación");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>