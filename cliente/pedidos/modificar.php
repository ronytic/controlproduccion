<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Pedido";
$id=$_GET['id'];
include_once '../../class/pedidos.php';
$pedidos=new pedidos;
$ped=array_shift($pedidos->mostrar($id));

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","");

include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre,unidad"," - ");

$estado=array("Pendiente"=>"Pendiente","Entregado"=>"Entregado");
include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
	$(document).on("ready",function(){
		$("#cantidad,#preciounitario").on("change",function(){
			cantidad=$("#cantidad").val()
			preciounitario=	$("#preciounitario").val()
			var total=(cantidad*preciounitario).toFixed(2);
			$("#total").val(total)
		});
	});
</script>
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
						<td><?php campos("Cliente","codcliente","select",$cli,0,"",$ped['codcliente']);?></td>
					</tr>
					<tr>
						<td><?php campos("Producto","codproductos","select",$prod,0,"",$ped['codproductos']);?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number",$ped['cantidad'],0,array("step"=>"0.1"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Precio Unitario","preciounitario","number",$ped['preciounitario'],0,array("step"=>"0.1"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","number",$ped['total'],0,array("step"=>"0.1","readonly"=>"readonly"));?></td>
					</tr>
					<tr>
						<td><?php campos("Fecha de Pedido","fechapedido","date",$ped['fechapedido'],0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Entrega","fechaentrega","date",$ped['fechaentrega'],0,"");?></td>
					</tr>
                    <tr>
						<td><?php campos("Estado","estado","select",$estado,0,"",$ped['estado']);?></td>
					</tr>
					<tr>
						<td><?php campos("Observación","observacion","textarea",$ped['observacion'],0,array("cols"=>30,"rows"=>5));?></td>
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