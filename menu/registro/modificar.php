<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Menú de Comida";
$id=$_GET['id'];
include_once '../../class/comida.php';
include_once '../../class/menucomida.php';
$menucomida=new menucomida;
$comida=new comida;
$menucomi=array_shift($menucomida->mostrar($id));

$desa=todolista($comida->mostrarTodo("tipo=1","nombre"),"codcomida","nombre","");
$sopa=todolista($comida->mostrarTodo("tipo=2","nombre"),"codcomida","nombre","");
$segu=todolista($comida->mostrarTodo("tipo=3","nombre"),"codcomida","nombre","");
$postre=todolista($comida->mostrarTodo("tipo=4","nombre"),"codcomida","nombre","");
$tetarde=todolista($comida->mostrarTodo("tipo=5","nombre"),"codcomida","nombre","");
$cena=todolista($comida->mostrarTodo("tipo=6","nombre"),"codcomida","nombre","");

$tipo=array("1"=>"Desayuno","2"=>"Sopa","3"=>"Segundo","4"=>"Postre","5"=>"Té Tarde","6"=>"Cena");
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
						<td colspan="4"><?php campos("Fecha","fechacomida","date",$menucomi['fechacomida'],0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
                    	<td colspan="4"><?php campos("Desayuno","desayuno","select",$desa,0,array("required"=>"required"),$menucomi['desayuno'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Sopa","sopa","select",$sopa,0,array("required"=>"required"),$menucomi['sopa'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Segundo","segundo","select",$segu,0,array("required"=>"required"),$menucomi['segundo'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Postre","postre","select",$postre,0,array("required"=>"required"),$menucomi['postre'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Té Tarde","tetarde","select",$tetarde,0,array("required"=>"required"),$menucomi['tetarde'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Cena","cena","select",$cena,0,array("required"=>"required"),$menucomi['cena'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><?php campos("Cantidad Soldados","cantidad","number",$menucomi['cantidad'],0,array("min"=>0,"step"=>1))?></td>
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