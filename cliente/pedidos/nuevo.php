<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Pedido de Productos";
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","");

include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

$estado=array("Pendiente"=>"Pendiente","Entregado"=>"Entregado");
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
						<td><?php campos("Cliente","codcliente","select",$cli);?></td>
					</tr>
					<tr>
						<td><?php campos("Producto","codproductos","select",$prod);?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","text");?></td>
					</tr>
					<tr>
						<td><?php campos("Fecha de Pedido","fechapedido","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Entrega","fechaentrega","date",date("Y-m-d",strtotime(date("Y-m-d").' +3 Day')),0,"");?></td>
					</tr>
                    <tr>
						<td><?php campos("Estado","estado","select",$estado,0,"","Pendiente");?></td>
					</tr>
					<tr>
						<td><?php campos("Observación","observacion","textarea","",0,array("cols"=>30,"rows"=>5));?></td>
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