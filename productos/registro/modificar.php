<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Producto";
$id=$_GET['id'];
include_once '../../class/productos.php';
$productos=new productos;
$pro=array_shift($productos->mostrar($id));
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text",$pro['nombre'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Descripción","descripcion","text",$pro['descripcion']);?></td>
					</tr>
					<tr><td><?php campos("Modificar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>