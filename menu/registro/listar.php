<?php
include_once("../../login/check.php");
$titulo="Listado de Menú de Comidas";
$folder="../../";
include_once("../../funciones/funciones.php");
$tipo=array("1"=>"Desayuno","2"=>"Sopa","3"=>"Segundo","4"=>"Postre","5"=>"Té Tarde","6"=>"Cena");
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
                        <td><?php campos("Fecha","fechacomida","date","",0,array("size"=>15));?></td>
                        
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
