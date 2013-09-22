<?php
include_once("../../login/check.php");
$titulo="Reporte de PEDIDOS para Menú Semana ";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/obra.php");
$obra=new obra;
$listaobras=todoLista($obra->mostrarTodo(),"codobra","nombre","-");

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
                        <td><?php campos("Fecha Inicio","fechainicio","date",date('Y-m-d'),0,array("size"=>15));?></td>
                        <td><?php campos("Fecha Fin","fechafin","date",date('Y-m-d',strtotime(date("Y-m-d")." + 7 day")),0);?></td>
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