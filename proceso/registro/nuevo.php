<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Producción";
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

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
	$(document).on("click",".aumentar",function(e){
		e.preventDefault();
		var posi=$(this).parent().parent();
		$.post("aumentar.php",{'l':linea},function(data){
			posi.before(data);
			$("select").not(".nolista").chosen({width:'100%'});	
			linea++;
		});
	})	
});


</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?> <hr>Producto a Procesar</div>
                
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Producción","fechaproduccion","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Producto","codproductos","select",$pro,1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number","0",0,array("class"=>"der","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",date("Y-m-d",strtotime(date("Y-m-d")." +30 day")),0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
					</tr>
					<tr><td><div class="rojoC pequeno">La Cantidad Introducida se contará para el inventario, Reviselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD</div></td><td></td></tr>
				</table>
                
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
            <tr>
				<td width="500"><select name="p[1][codproductos]" rel-linea="1" class="productos p">									
                	<option value="">Seleccionar</option>
                	<?php foreach($productos->mostrarTodo("","nombre") as $pr){$i++;
					$sum=array_shift($compra->sumar($pr['codproductos']));
					$sumatotal=$sum['cantidadtotalstock']!=""?$sum['cantidadtotalstock']:'0';?>
                    <option value="<?php echo $pr['codproductos']?>" rel="<?php echo $sumatotal;?>"><?php echo $pr['nombre']." - Cantidad Stock: ".$sumatotal;?></option>
                    <?php }?>
                </select></td>
                        
                        <td><input type="number" name="p[1][cantidad]" value="0" class="der cantidad" rel-linea="1" min="0" step="1"></td>
			</tr>
            <tr class="contenido"><td><a href="#" class="aumentar"><img src="../../imagenes/ico/nuevo1.png" height="15"> Aumentar</a></td><td></td></tr>
            </table>
            <div class="rojoC pequeno">La Cantidad Introducida de ingredientes se descontará del inventario, Reviselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD</div>
            <input type="submit" value="Guardar"> 
            </fieldset>
        </div>
        <div class="clear"></div>
        </form>
    </div>
</div>
<?php include_once '../../piepagina.php';?>