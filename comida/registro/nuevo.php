<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Comida";
include_once '../../funciones/funciones.php';
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");
$tipo=array("1"=>"Desayuno","2"=>"Sopa","3"=>"Segundo","4"=>"Postre","5"=>"Té Tarde","6"=>"Cena");
include_once $folder.'cabecerahtml.php';
?>
<?php include_once $folder.'cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_6 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
					<tr>
						<td colspan="4"><?php campos("Nombre","nombre","text","",1,array("required"=>"required"));?></td>
					</tr>
                    <tr>
                    	<td colspan="4"><?php campos("Tipo de Comida","tipo","select",$tipo,0,array("required"=>"required"))?></td>
                    </tr>
                    <?php for($i=1;$i<=5;$i++){?>
                    <tr>
                    	<td><?php campos("Ingrediente ".(($i*4)-3),"ingrediente".(($i*4)-3),"select",$pro)?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-2),"ingrediente".(($i*4)-2),"select",$pro)?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-1),"ingrediente".(($i*4)-1),"select",$pro)?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-0),"ingrediente".(($i*4)-0),"select",$pro)?></td> 
                    </tr>
                    <?php }?>
                    <tr>
						<td colspan="4"><?php campos("Foto de la Comida","foto","file","",0,array("accept"=>"image/*"));?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once $folder.'piepagina.php';?>