<?php
include_once("../../login/check.php");
$titulo="Reporte de Ventas de Productos";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodos("","nombre"),"codproductos","nombre","");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodos("","nombre"),"codcliente","nombre","");

include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_1	 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                    <tr>
                        <td colspan="4"><?php campos("Producto","codproductos","select",$prod,0)?></td>
                        <td colspan="4"><?php campos("Cliente","codcliente","select",$cli,0)?></td>
                        <td><?php campos("Código de Control","codigocontrol","text","")?></td>
                        <td><?php campos("Fecha de Inicio","fechainicio","date","")?></td>
                        <td><?php campos("Fecha Fin","fechafin","date","")?></td>
                        <td>
                        	<?php campos("Tipo","tipo","select",array("Merma"=>"Merma","Venta"=>"Venta"),0,"","Venta");?>
                        </td>
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