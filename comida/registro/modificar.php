<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Comida";
$id=$_GET['id'];
include_once '../../class/comida.php';
include_once '../../class/productos.php';
$productos=new productos;
$comida=new comida;
$pro=array_shift($productos->mostrar($id));
$comi=array_shift($comida->mostrar($id));

$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");
$tipo=array("1"=>"Desayuno","2"=>"Sopa","3"=>"Segundo","4"=>"Postre","5"=>"Té Tarde","6"=>"Cena");
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
						<td colspan="4"><?php campos("Nombre","nombre","text",$comi['nombre'],1,array("required"=>"required"));?></td>
					</tr>
                    <tr>
                    	<td colspan="4"><?php campos("Tipo de Comida","tipo","select",$tipo,0,array("required"=>"required"),$comi['tipo'])?></td>
                    </tr>
                    <?php for($i=1;$i<=5;$i++){?>
                    <tr>
                    	<td><?php campos("Ingrediente ".(($i*4)-3),"ingrediente".(($i*4)-3),"select",$pro,0,"",$comi["ingrediente".(($i*4)-3)])?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-2),"ingrediente".(($i*4)-2),"select",$pro,0,"",$comi["ingrediente".(($i*4)-2)])?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-1),"ingrediente".(($i*4)-1),"select",$pro,0,"",$comi["ingrediente".(($i*4)-1)])?></td>
                        <td><?php campos("Ingrediente ".(($i*4)-0),"ingrediente".(($i*4)-0),"select",$pro,0,"",$comi["ingrediente".(($i*4)-0)])?></td> 
                    </tr>
                    <?php }?>
                    <tr>
						<td colspan="4"><?php campos("Foto de la Comida","foto","file","",0,array("accept"=>"image/*"));?><?php $ar="../foto/".$comi['foto'];
						if($comi['foto']!="" && file_exists($ar)){?>
                        <a href="<?php echo $ar?>" target="_blank">
                        Abrir Imagen<br>
                        <img src="<?php echo $ar?>" width="250">
                        </a>
                        <?php }else{
							echo "No se Guardo Ninguna Imagen";	
						}?></td>
					</tr>
                    <tr>
					<tr><td><?php campos("Modificar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>