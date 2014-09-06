<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Producto a Envasar";

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dist=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre,departamento","-");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");

include_once("../../class/vendedor.php");
$vendedor=new vendedor;
$ven=todolista($vendedor->mostrarTodo("","nombre"),"codvendedor","nombre","-");

include_once("../../class/compra.php");
$compra=new compra;
$id=$_GET['id'];
$com=array_shift($compra->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$prod=array_shift($productos->mostrar($com['codproductos']));


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
var linea=0
var totalt=0;
var totalcantidadenvasar=<?php echo $com['cantidadstock']?>;
$(document).on("ready",function(){
	
	$(document).on("change",".productos,.cantidad",function(e){
		var lin=$(this).attr("rel");
					
		//alert(lin);
		var	unidad=$(".productos[rel="+lin+"]>option:selected").attr("rel");
		var cantidad=$(".cantidad[rel="+lin+"]").val();
		var total=(cantidad*unidad).toFixed(2);
		$(".total[rel="+lin+"]").val(total);
		totalt=0;
		$(".total").each(function(index, element) {
            totalt+=parseFloat($(this).val());
			//alert(totalt);
        });
		//alert(unidad)
		$("#tt").val(totalt.toFixed(2));
		if(totalt>totalcantidadenvasar){
			$("#formulario").attr("onsubmit","return false");
			$("#guardar").attr("disabled","disabled");
			alert("La Cantidad Introducida para envasar es mayor a la cantidad en Stock");	
		}else{
			$("#formulario").removeAttr("onsubmit");
			$("#guardar").removeAttr("disabled");
		}
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
		//var lin=$(this).attr("rel");
		//var can=$(".productos[rel="+lin+"]>option:selected").attr("rel");
		//$(".cantidad[rel="+lin+"]").attr({'max':can});
	});
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_0 grid_11 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?> - <?php echo $prod['nombre']." - ".$com['cantidadstock']." ".$prod['unidad']?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data" id="formulario">
                <input type="hidden" name="codproductos" value="<?php echo $prod['codproductos']?>">
				<table class="tablareg">
                    <tr class="titulo">
                    	<td width="20">N</td>
                        <td width="50" style="width:450px !important" colspan="2">Producto</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                    </tr>
                    
                    
					<tr id="marca">
                    	<td colspan="2" class="subir"><a href="#" id="aumentar">Aumentar</a></td>
                        <td colspan="1"><div class="rojoC pequeno">La Cantidad Introducida se utilizará para envasar los productos, no se podrá modificar posteriormente</div><?php campos("Guardar","guardar","submit","",0,array("disabled"=>"disabled"));?></td>
                        <td></td>
                        <td class="subir"><input type="text" value="0.00" class="der" style="width:80px;" readonly id="tt" name="tt"></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>