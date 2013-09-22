<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/cliente.php';
	extract($_POST);

	$cliente=new cliente;
	$pro=$cliente->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","direccion"=>"Dirección","telefono"=>"Teléfono","departamento"=>"Departamento","observacion"=>"Observación");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>