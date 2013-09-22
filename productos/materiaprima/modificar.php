<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Materia Prima";
$id=$_GET['id'];
include_once '../../class/materiaprima.php';
$materiaprima=new materiaprima;
$mp=array_shift($materiaprima->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("destino='Procesado'","nombre"),"codproductos","nombre","");

include_once("../../class/usuarios.php");
$usuarios=new usuarios;
$usu=todolista($usuarios->mostrarTodo("nivel='3'","paterno,materno,nombre"),"codusuarios","nombre,paterno","");


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
						<td><?php campos("Fecha de Registro","fecharegistro","date",$mp['fecharegistro'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Producto para Procesar","codproductos","select",$pro,1,array("required"=>"required"),$mp['codproductos']);?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","text",$mp['cantidad']);?></td>
					</tr>
                    <tr>
						<td><fieldset><legend>Tomar Muestra y Verificar</legend>
                        <?php campos("Color","color","text",$mp['color']);?>
                        <?php campos("Sabor","sabor","text",$mp['sabor']);?>
                         <?php campos("Olor","olor","text",$mp['olor']);?>
                        </fieldset></td>
					</tr>
                    <tr>
						<td><?php campos("Condición de Empaque","condicionempaque","text",$mp['condicionempaque']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Responsable de Inspección","codresponsable","select",$usu,"","",$mp['codresponsable']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Estado","estado","select",array("Pendiente"=>"Pendiente","Utilizado"=>"Utilizado"),0,"",$mp['estado']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",$mp['fechavencimiento'],0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$mp['observacion']);?></td>
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