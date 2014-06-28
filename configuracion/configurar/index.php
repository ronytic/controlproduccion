<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Configuración";
$id=1;
include_once '../../class/configuracion.php';
$configuracion=new configuracion;
$conf=array_shift($configuracion->mostrar($id));


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
						<td><?php campos("Porcentaje de la Mano de Obra","porcentajemanoobra","text",$conf['porcentajemanoobra'],1,array("required"=>"required"));?>%</td>
					</tr>
                    <tr>
						<td><?php campos("Porcentaje de Coste Indirecto de Fabricación","porcentajecostofabricacion","text",$conf['porcentajecostofabricacion']);?>%</td>
					</tr>
                    <tr>
						<td><?php campos("Porcentaje del Costo Mínimo de Producción","costominimodeproduccion","text",$conf['costominimodeproduccion']);?>%</td>
					</tr>
                    <tr>
						<td><?php campos("Porcentaje del Costo Máximo de Producción","costomaximodeproduccion","text",$conf['costomaximodeproduccion']);?>%</td>
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