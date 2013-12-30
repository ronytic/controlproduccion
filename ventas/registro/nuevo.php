<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Venta";


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
		var can=$(".productos[rel="+lin+"]>option:selected").attr("rel");
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
                	<tr class="titulo"><td>N</td><td>Fecha de Venta</td><td width="450" style="width:450px !important">Producto<hr class="separador">Cliente</td><td>Cantidad<hr class="separador">Distribuidor</td><td>Precio Unitario<hr class="separador">Vendedor</td><td>Total<hr class="separador">Observaciones</td></tr>
					<tr id="marca"><td colspan="2" class="subir"><a href="#" id="aumentar">Aumentar</a></td><td colspan="3"><div class="rojoC pequeno">La Cantidad Introducida se utilizará para descontar del inventario, Revíselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO de venta</div><?php campos("Guardar","guardar","submit");?></td><td class="subir"><input type="text" value="0.00" class="der" style="width:80px;" readonly id="tt" name="tt"></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>