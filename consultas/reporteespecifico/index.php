<?php
include_once("../../login/check.php");
$titulo="Reporte de Especifico de Productos en Inventario";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodos("codproductos IN(SELECT  codproductos FROM compra WHERE tipo='Procesado' GROUP BY codproductos)","nombre"),"codproductos","nombre","");

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
                        <td colspan="4"><?php campos("Producto","codproductos","select",$prod,0)?></td>
                        <td><?php campos("Ventas Fecha de Inicio","fechainicio","date","")?></td>
                        <td><?php campos("Ventas Fecha Fin","fechafin","date","")?></td>
                        <?php /*<td><?php campos("Producto Existente","existente","select",array("0"=>"No","1"=>"Si"))?></td>*/?>
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