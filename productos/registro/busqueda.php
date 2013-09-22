<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	extract($_POST);

	$productos=new productos;
	$pro=$productos->mostrarTodo("nombre LIKE '%$nombre%' and codproveedor LIKE '%$codproveedor%' and destino LIKE '%$destino%'","nombre");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"Descripción");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>