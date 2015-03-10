<?php
include_once("../../login/check.php");
$titulo="Reporte de Ventas de Productos - Por Mes";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodos("","nombre"),"codproductos","nombre","");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodos("","nombre"),"codcliente","nombre","");

$mes=array();
for($i=1;$i<=12;$i++){
	$mes[$i]=$i;
}
$anio=array();
for($i=2010;$i<=date('Y');$i++){
	$anio[$i]=$i;
}
$tipo=array("Detallado"=>"Detallado","Resumido"=>"Resumido");

include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                    <tr>
                        <td colspan="4"><?php campos("Mes","mes","select",$mes,0)?></td>
                        <td colspan="4"><?php campos("Año","anio","select",$anio,0)?></td>
                        <td colspan="1"><?php campos("Tipo de Reporte","tipo","select",$tipo,0,"","Detallado")?></td>	                        <?php /*<td><?php campos("Fecha de Inicio","fechainicio","date","")?></td>
                        <td><?php campos("Fecha Fin","fechafin","date","")?></td>
                        <td><?php campos("Producto Existente","existente","select",array("0"=>"No","1"=>"Si"))?></td>*/?>
                    </tr>
                    <tr>
                        <td><?php campos("Ver Reporte","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>