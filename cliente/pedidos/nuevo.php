<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Pedido de Productos";
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
var linea=0
var totalt=0;
$(document).on("ready",function(){
	
	$(document).on("change",".cantidad,.preciounitario",function(e){
		var lin=$(this).attr("rel");
		var cantidad=$(".cantidad[rel="+lin+"]").val();
		var preciounitario=$(".preciounitario[rel="+lin+"]").val();
		var total=(cantidad*preciounitario).toFixed(2);
		$(".total[rel="+lin+"]").val(total);
		totalt=0;
		$(".total").each(function(index, element) {
            totalt+=parseFloat($(this).val());
			//alert(totalt);
        });
		$("#tt").val(totalt.toFixed(2));
	});	
	$(document).on("change",".total",function(e){
		alert("asd");
	});	
	function aumentar(){

		$.post("aumentar.php",{l:linea},function(data){
			$("#marca").before(data);
			$('input[type=date]').click(function(e){e.preventDefault();}).datepicker();
			$("select").css({'width':'100%'}).not(".nolista").select2({'placeholder':'Búsqueda no encontrada','loadMorePadding':0});
			linea++;
		});
	}
	linea++;
	aumentar();
	$("#aumentar").click(function(e) {
		e.preventDefault();
        aumentar();
    });
	});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_0 grid_11 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr class="titulo">
                        <td colspan="2">Fecha de Pedido</td>
                        <td width="450" style="width:450px !important">Cliente</td>
                        <td>Fecha de Entrega</td>
                        <td>Estado</td>
                        <td>Observaciones</td>
                    </tr>
					<tr>
                    	<td colspan="2"><?php campos("","fechapedido","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
						<td><?php campos("","codcliente","select",$cli);?></td>
                        <td><?php campos("","fechaentrega","date",date("Y-m-d",strtotime(date("Y-m-d").' +3 Day')),0,"");?></td>
                        <td><?php campos("","estado","select",$estado,0,"","Pendiente");?></td>
                        <td><?php campos("","observacion","textarea","",0,array("cols"=>20,"rows"=>1));?></td>
					</tr>
					<tr class="titulo">
                    	<td width="20">N</td>
                        <td width="50" style="width:450px !important" colspan="2">Producto</td>
                        <td>Cantidad</td>
                        <td>Precio Unitario</td>
                        <td>Total</td>
                    </tr>
                    
					<tr id="marca">
                    	<td colspan="2" class="subir"><a href="#" id="aumentar">Aumentar</a></td>
                    	<td><?php campos("Guardar","guardar","submit");?></td><td></td>
                    	<td class="subir"><input type="text" value="0.00" class="der" style="width:80px;" readonly id="tt" name="tt"></td>    
                    </tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>