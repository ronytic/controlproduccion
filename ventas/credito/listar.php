<?php
include_once("../../login/check.php");
$titulo="Listado de Ventas a Crédito";
$folder="../../";
include_once("../../class/productos.php");
$productos=new productos;
$prod=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dis=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre","-");

include_once("../../class/vendedor.php");
$vendedor=new vendedor;
$ven=todolista($vendedor->mostrarTodo("","nombre"),"codvendedor","nombre","-");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");

include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_10 prefix_1 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Estado","cancelado","select",array("cancelado"=>"Cancelado","porpagar"=>"Por Pagar"),0,"","porpagar");?></td>
                        <td><?php campos("Cliente","codcliente","select",$cli,"");?></td>
                        <td><?php campos("Fecha de Venta","fechaventa","date","");?></td>
                        <td><?php campos("Fecha de Último Pago","fechaultimopago","date","");?></td>
                    </tr>    
                    <tr>
                        <td><?php campos("Distribuidor","coddistribuidor","select",$dis,"");?></td>
                        <td><?php campos("Vendedor","codvendedor","select",$ven,"");?></td>
                        <td><?php campos("Código de Control","codigocontrol","text","","");?></td>
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
