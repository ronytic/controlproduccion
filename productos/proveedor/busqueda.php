<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/proveedor.php';
	extract($_POST);

	$proveedor=new proveedor;
	$pro=$proveedor->mostrarTodo("nombre LIKE '%$nombre%' and origen LIKE '%$origen%'");
	$titulo=array("nombre"=>"Nombre","direccion"=>"Dirección","telefono"=>"Teléfono","email"=>"Email","origen"=>"Origen");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>