<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	extract($_POST);

	$productos=new productos;
	$pro=$productos->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","unidad"=>"Unidad","tiempoproduccion"=>"Tiempo de Producción");
	listadoTabla($titulo,$pro,1,"modificar.php","eliminar.php","ver.php");
}
?>