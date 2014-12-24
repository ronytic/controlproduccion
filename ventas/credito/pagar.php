<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Realizar Pago Venta a Credito";
$id=$_GET['id'];

include_once '../../class/ventageneral.php';
$ventageneral=new ventageneral;
$mp=array_shift($ventageneral->mostrar($id));



include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dist=$distribuidor->mostrarTodo("coddistribuidor=".$mp['coddistribuidor'],"nombre");
$dist=array_shift($dist);

include_once("../../class/vendedor.php");
$vendedor=new vendedor;
$ven=$vendedor->mostrarTodo("codvendedor=".$mp['codvendedor'],"nombre");
$ven=array_shift($ven);

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodo("codcliente=".$mp['codcliente'],"nombre");
$cli=array_shift($cli);

include_once("../../class/ventacredito.php");
$ventacredito=new ventacredito;
$venc=$ventacredito->mostrarTodo("codventageneral=".$id);


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).on("ready",function(){
	$("#montopago").change(function(e) {
        var totaladeudado=$("#totaladeudado").val();
		var montopago=$(this).val();
		var totaladeudadoalafecha=totaladeudado-montopago;
		$("#totaladeudadoalafecha").val(totaladeudadoalafecha);
    });
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_1 grid_10 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">				
                <?php campos("","id","hidden",$id);?>
                <?php campos("","totaladeudado","hidden",$mp['total']);?>
<?php campos("","totalcancelado","hidden",$mp['totalcancelado']);?>
				<table class="tablareg borde">
                	<tr class="titulo"><td>Fecha de Venta</td><td>Distribuidor</td><td>Vendedor</td><td>Cliente</td><td>Fecha de Último Pago</td><td>Total</td><td>Total Cancelado</td><td>Observación</td></tr>
                    
                    <tr>
                    	<td class="der"><?php echo fecha2Str($mp['fechaventa'])?></td>
                        <td><?php echo $dist['nombre'];?></td>
                        <td><?php echo $ven['nombre'];?></td>
                        <td><?php echo $cli['nombre'];?></td>
                        <td class="der"><?php echo fecha2Str($mp['fechaultimopago']);?></td>
                        <td class="der resaltar"><?php echo $mp['total'];?></td>
                        <td class="der resaltar"><?php echo $mp['totalcancelado'];?></td>
                         <td><?php echo $mp['observacion'];?></td>
                    </tr>

                   

                    

					
				</table><br>
                <div class="titulo">Realizar Pago</div>
                <table class="tablareg">

                    <tr>
                    	<td><?php campos("Fecha de Pago","fechapago","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
                        <td><?php campos("Monto de Pago","montopago","number","0",0,array("required"=>"required","min"=>0,"max"=>$mp['total']-$mp['totalcancelado'],"class"=>"der"));?></td>
                        <td><?php campos("Saldo","totaladeudadoalafecha","number",$mp['total']-$mp['totalcancelado'],0,array("required"=>"required","readonly"=>"readonly","min"=>0,"max"=>$mp['total']-$mp['totalcancelado'],"class"=>"der"));?></td>
                        <td><?php campos("Observación","observacion","text","",0);?></td>
                        </tr>
                        <tr>
                        	<td colspan="2"> <?php campos("Guardar","guardar","submit");?></td>
                        </tr>
                </table>
                
                <br>
                <div class="titulo">Listado de Pagos</div>
                <table class="tablareg borde">
                	<tr class="titulo"><td>N</td><td>Monto Pago</td><td>Total Adeudado a la Fecha</td><td>Fecha de Pago</td><td>Observación</td></tr>
                    <?php
                    $i=0;
					foreach($venc as $vc){$i++;
					?>
                    <tr>
                    	<td><?php echo $i?></td>
                    	<td class="der"><?php echo $vc['montopago']?></td>
                        <td class="der"><?php echo $vc['totaladeudadoalafecha']?></td>
                        <td class="der"><?php echo fecha2Str($vc['fechapago'])?></td>
                        <td><?php echo $vc['observacion']?></td></tr>
                    <?php
					}
					?>
                </table>
                
               
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>