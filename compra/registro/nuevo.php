<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Compra";


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre,origen","-");
?>
<script language="javascript">
var linea=0
$(document).on("ready",function(){
	
	$(document).on("change",".cantidad,.preciounitario",function(e){
		var lin=$(this).attr("rel");
		var cantidad=$(".cantidad[rel="+lin+"]").val();
		var preciounitario=$(".preciounitario[rel="+lin+"]").val();
		var total=(cantidad*preciounitario).toFixed(2);
		$(".total[rel="+lin+"]").val(total);
		
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
                        <td colspan="2">Fecha de Compra</td>
                        <td colspan="2">Proveedor</td>
                        <td colspan="2">Observaciones</td>
                    </tr>
                    <tr>
                    	<td colspan="2"><?php campos("","fechacompra","date",date("Y-m-d"),0,array("required"=>"required","style"=>"width:135px","rel"=>$l));?></td>
                        <td colspan="2"><?php campos("","codproveedor","select",$prov);?></td>
                        <td colspan="2"><?php campos("","observacion","textarea","",0,array("cols"=>35,"rows"=>1,"placeholder"=>"Ingrese su Observación"));?></td>
                    </tr>
                    <tr class="titulo">
                    	<td>N</td>
                        <td width="300">Producto</td>
                        <td>Cantidad</td>
                        <td>Precio Unitario</td>
                        <td>Total</td>
                        <td>Fecha de Vencimiento</td>
                    </tr>
					<tr id="marca"><td colspan="2"><a href="#" id="aumentar">Aumentar</a></td><td colspan="7"><div class="rojoC pequeno">La Cantidad Introducida se contará para el inventario, Reviselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO</div><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>