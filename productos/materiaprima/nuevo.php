<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Materia Prima";
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
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Registro","fecharegistro","date",date("Y-m-d"),1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Producto para Procesar","codproductos","select",$pro,1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","text");?></td>
					</tr>
                    <tr>
						<td><fieldset><legend>Tomar Muestra y Verificar</legend>
                        <?php campos("Color","color","text");?>
                        <?php campos("Sabor","sabor","text");?>
                         <?php campos("Olor","olor","text");?>
                        </fieldset></td>
					</tr>
                    <tr>
						<td><?php campos("Condición de Empaque","condicionempaque","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Responsable de Inspección","codresponsable","select",$usu);?></td>
					</tr>
                    <tr>
						<td><?php campos("Estado","estado","select",array("Pendiente"=>"Pendiente","Utilizado"=>"Utilizado"),0,"","Pendiente");?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",date("Y-m-d",strtotime(date("Y-m-d")." +30 day")),0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
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