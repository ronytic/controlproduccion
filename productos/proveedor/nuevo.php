<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Proveedor";
include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text","",1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Dirección","direccion","text","",0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text","",0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Email","email","text","",0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Origen","origen","text","",0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea","",0,array());?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>