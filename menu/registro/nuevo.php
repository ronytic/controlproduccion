<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Menú de Comidas";
include_once '../../funciones/funciones.php';
include_once("../../class/comida.php");
$comida=new comida;
$desa=todolista($comida->mostrarTodo("tipo=1","nombre"),"codcomida","nombre","");
$sopa=todolista($comida->mostrarTodo("tipo=2","nombre"),"codcomida","nombre","");
$segu=todolista($comida->mostrarTodo("tipo=3","nombre"),"codcomida","nombre","");
$postre=todolista($comida->mostrarTodo("tipo=4","nombre"),"codcomida","nombre","");
$tetarde=todolista($comida->mostrarTodo("tipo=5","nombre"),"codcomida","nombre","");
$cena=todolista($comida->mostrarTodo("tipo=6","nombre"),"codcomida","nombre","");

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
						<td colspan="4"><?php campos("Fecha","fechacomida","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
                    	<td colspan="4"><?php campos("Desayuno","desayuno","select",$desa,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Sopa","sopa","select",$sopa,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Segundo","segundo","select",$segu,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Postre","postre","select",$postre,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Té Tarde","tetarde","select",$tetarde,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Cena","cena","select",$cena,0,array("required"=>"required"))?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Cantidad Soldados","cantidad","number","0",0,array("min"=>0,"step"=>1))?></td>
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