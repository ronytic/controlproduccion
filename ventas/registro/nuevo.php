<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Venta";

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dist=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre,departamento","-");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");

include_once("../../class/vendedor.php");
$vendedor=new vendedor;
$ven=todolista($vendedor->mostrarTodo("","nombre"),"codvendedor","nombre","-");

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
	$(document).on("change",".productos",function(){
		var lin=$(this).attr("rel");
		var can=$(".productos[rel="+lin+"]>optgroup>option:selected").attr('rel');
		$(".cantidad[rel="+lin+"]").attr({'max':can});
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
                        <td colspan="2">Fecha de Venta</td>
                        <td colspan="1">Código de Control</td>
                        <td width="450" style="width:450px !important">Cliente</td>
                        <td>Distribuidor</td>
                        <td>Vendedor</td>
                        <td>Observaciones</td>
                    </tr>
                    <tr>
                    	<td colspan="2"><?php campos("","fechaventa","date",date("Y-m-d"),0,array("required"=>"required","style"=>"width:130px"));?></td>
                        <td><?php campos("","codigocontrol","text","",0,array("placeholder"=>"Ingrese su Código de Control","size"=>15));?></td>
                        <td><?php campos("","codcliente","select",$cli);?></td>
                        <td><?php campos("","coddistribuidor","select",$dist);?></td>
                        <td><?php campos("","codvendedor","select",$ven);?></td>
                        <td><?php campos("","observacion","textarea","",0,array("rows"=>1,"cols"=>25,"placeholder"=>"Ingrese su observación"));?></td>
                    </tr>
                    <tr class="titulo">
                    	<td width="20">N</td>
                        <td width="50" style="width:450px !important" colspan="3">Producto</td>
                        <td>Cantidad</td>
                        <td>Precio Unitario</td>
                        <td>Total</td>
                    </tr>
                    
                    
					<tr id="marca">
                    	<td colspan="2" class="subir"><a href="#" id="aumentar">Aumentar</a></td>
                        <td colspan="4"><div class="rojoC pequeno">La Cantidad Introducida se utilizará para descontar del inventario, Revíselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO de venta</div><?php campos("Guardar","guardar","submit");?> </td>
                        <td class="subir"><input type="text" value="0.00" class="der" style="width:80px;" readonly id="tt" name="tt"><br><?php campos("Modo de Pago","modopago","select",array("contado"=>"Contado","credito"=>"Credito"));?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>