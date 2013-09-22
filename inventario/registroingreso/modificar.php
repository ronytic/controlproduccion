<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar el Ingreso de Productos";
$id=$_GET['id'];
include_once '../../class/inventario.php';
include_once '../../class/productos.php';
$productos=new productos;
$inventario=new inventario;
$inv=array_shift($inventario->mostrar($id));

$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");
include_once '../../funciones/funciones.php';
include_once $folder.'cabecerahtml.php';
?>
<?php include_once $folder.'cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Producto","codproductos","select",$pro,0,array("readonly"=>"readonly","disabled"=>"disabled"),$inv['codproductos'])?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Entrada","fechaentrada","date",$inv['fechaentrada'],0,array("readonly"=>"readonly","disabled"=>"disabled"))?></td>
					</tr>
                    <tr>
                    	<td><?php campos("Cantidad de Entrada","cantidadentrada","number",$inv['cantidadentrada'],0,array("required"=>"required","min"=>0,"step"=>1,"class"=>"der","readonly"=>"readonly","disabled"=>"disabled"))?> Kg<br><small>La Cantidad no se modifica por cuestión de seguridad</small></td>
                    </tr>
                    <tr>
						<td><?php campos("Código","codigo","text",$inv['codigo'],0,"");?></td>
					</tr>
					<tr><td><?php campos("Modificar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once $folder.'piepagina.php';?>