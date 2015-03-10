<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Producción";
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre,unidad"," - ");

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre,origen","-");

//print_r($prov);
include_once("../../class/compra.php");
$compra=new compra;

/*$p=array();
foreach($productos->mostrarTodo("","nombre") as $pr){$i++;
	$sum=array_shift($compra->sumar($pr['codproductos']));
	$sumatotal=$sum['cantidadtotalstock'];
	$p[$i]['codproductos']=$pr['codproductos'];
	$p[$i]['nombre']=$pr['nombre']." - Cantidad Stock: ".$sumatotal;
	//$p[$i]['cantidadtotalstock']=$pr['cantidadtotalstock'];
}*/
//$p=todolista($p,"codproductos","nombre");
//echo "<br>";
//print_r($p);
include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
var linea=1;
$(document).on("ready",function(){
	
	$(document).on("change",".productos",function(e) {
    	var l=$(this).attr('rel-linea');
		var c=($(this).val());
		//alert(l);
		var p=$("select.productos[rel-linea="+l+"]>option:selected ").attr('rel');
		//alert(p);
		$("input.cantidad[rel-linea="+l+"]").val(p).attr('max',p);
	}); 
	
	$(".aumentar").click(function(e) {
		e.preventDefault();
        aumentar();
    });
	linea++;
	aumentar();
	function aumentar(){

		$.post("aumentar.php",{l:linea},function(data){
			$("#marca").before(data);
			$('input[type=date]').click(function(e){e.preventDefault();}).datepicker();
			$("select").css({'width':'100%'}).not(".nolista").select2({'placeholder':'Búsqueda no encontrada','loadMorePadding':0});
			linea++;
		});
	}
});


</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    	<div class="prefix_0 grid_11 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?> <hr>Producto a Procesar</div>
                
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Producción","fechaproduccion","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					
						<td><?php campos("Producto","codproductos","select",$pro,1,array("required"=>"required"));?></td>
					
						<td><?php campos("Cantidad Esperada","cantidadesperada","number","0",0,array("class"=>"der","min"=>0));?></td>
					
						<td><?php campos("Cantidad Resultante","cantidad","number","0",0,array("class"=>"der","min"=>0));?></td>
					</tr>
                    
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",date("Y-m-d",strtotime(date("Y-m-d")." +30 day")),0,array("required"=>"required"));?></td>
					
						<td colspan="2"><?php campos("Observación","observacion","textarea");?></td>
					</tr>
				</table>
                <div class="rojoC pequeno">La cantidad Resultante y/o Esperadad introducida se contará para el inventario, Reviselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD</div>
			</fieldset>
		</div>
    	<div class="clear"></div>
        <div class="grid12">
        	<fieldset><div class="titulo">Ingredientes del Producto</div>
            Detalle de los Ingredientes
            <table class="tabla">
            	<tr class="titulo">
                	<td>Productos - Cantidad Stock</td>
                    <td>Cantidad</td>
                </tr>

            <tr class="contenido" id="marca"><td><a href="#" class="aumentar"><img src="../../imagenes/ico/nuevo1.png" height="15"> Aumentar</a></td><td></td></tr>
            </table>
            <div class="rojoC pequeno">La Cantidad Introducida de ingredientes se descontará del inventario, Revíselo antes de Registrarlo, Posteriormente no se podrá modificar la CANTIDAD</div>
            <input type="submit" value="Guardar"> 
            </fieldset>
        </div>
        <div class="clear"></div>
        </form>
    </div>
</div>
<?php include_once '../../piepagina.php';?>