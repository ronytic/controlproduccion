<?php
include_once("../../login/check.php");
$titulo="Listado de Materias Primas";
$folder="../../";
include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodo("destino='Procesado'","nombre"),"codproductos","nombre","");

include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Condición Empaque","condicionempaque","text","",1,array("size"=>15));?></td>
                        <td><?php campos("Producto","codproductos","select",$prod);?></td>
                        <td><?php campos("Estado","estado","select",array("Pendiente"=>"Pendiente","Utilizado"=>"Utilizado"),0,"","Pendiente");?></td>
                        <td><?php campos("Fecha de Vencimiento","fechavencimiento","date",$prod);?></td>
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
<?php include_once "../../piepagina.php";?>
