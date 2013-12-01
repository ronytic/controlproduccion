<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Datos de Vendedor";
$id=$_GET['id'];
include_once '../../class/vendedor.php';
$vendedor=new vendedor;
$cli=array_shift($vendedor->mostrar($id));
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
						<td><?php campos("Nombre","nombre","text",$cli['nombre'],1,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Ci","ci","text",$cli['ci'],0,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Dirección","direccion","text",$cli['direccion'],0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text",$cli['telefono'],0,array("required"=>"required"));?></td>
					</tr>
                    
					<tr>
						<td><?php campos("Observación","observacion","text",$cli['observacion'],0,array("required"=>"required"));?></td>
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