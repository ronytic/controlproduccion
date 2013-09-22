<?php
include_once("../../login/check.php");
$titulo="Listado de Salidas de Productos";
$folder="../../";
include_once("../../funciones/funciones.php");
include_once("../../class/productos.php");
$productos=new productos;

$prod=todolista($productos->mostrarTodo(),"codproductos","nombre","");
include_once $folder."cabecerahtml.php";
?>
<?php include_once $folder."cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td colspan="4"><?php campos("Producto","codproductos","select",$prod,0)?></td>
                        <td><?php campos("Fecha de Salida","fechasalida","date","")?></td>
                        <td><?php campos("Producto Existente","existente","select",array("0"=>"No","1"=>"Si"))?></td>
                        <td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once $folder."piepagina.php";?>
