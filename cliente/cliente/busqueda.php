<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/cliente.php';
	extract($_POST);

	$cliente=new cliente;
	$pro=$cliente->mostrarTodo("nombre LIKE '%$nombre%' and direccion LIKE '%$direccion%' and telefono LIKE '%$telefono%' and observacion LIKE '%$observacion%'");
	$titulo=array("nombre"=>"Nombre","direccion"=>"Dirección","telefono"=>"Teléfono","departamento"=>"Departamento","gasto"=>"Gasto de Distribución","observacion"=>"Observación");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>