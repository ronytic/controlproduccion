<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	include_once '../../class/ventageneral.php';
	include_once '../../class/cliente.php';
	include_once '../../class/vendedor.php';
	include_once '../../class/distribuidor.php';
	extract($_POST);
	
	
	$productos=new productos;
	$ventageneral=new ventageneral;
	$cliente=new cliente;
	$vendedor=new vendedor;
	$distribuidor=new distribuidor;
	
	
	$codproductos=$codproductos!=""?$codproductos:'%';
	$coddistribuidor=$coddistribuidor!=""?$coddistribuidor:'%';
	$codcliente=$codcliente!=""?$codcliente:'%';
	$fechaventa=$fechaventa!=""?$fechaventa:'%';
	$fechaultimopago=$fechaultimopago!=""?$fechaultimopago:'%';
	$cuota=($cancelado=="porpagar")?'total<>totalcancelado':'total=totalcancelado';
	foreach($ventageneral->mostrarTodo("$cuota and codcliente LIKE '$codcliente' and coddistribuidor LIKE '$coddistribuidor' and fechaultimopago LIKE '$fechaultimopago' and fechaventa LIKE '$fechaventa'")as $mp){$i++;
	$pro=array_shift($productos->mostrar($mp['codproductos']));
	$cli=array_shift($cliente->mostrar($mp['codcliente']));
	$ven=array_shift($vendedor->mostrar($mp['codvendedor']));
	$dis=array_shift($distribuidor->mostrar($mp['coddistribuidor']));
	$datos[$i]['codventageneral']=$mp['codventageneral'];
	$datos[$i]['codigocontrol']=$mp['codigocontrol'];
	$datos[$i]['fechaventa']=fecha2Str($mp['fechaventa']);
	$datos[$i]['nombrecliente']=$cli['nombre'];
	$datos[$i]['nombrevendedor']=$ven['nombre'];
	$datos[$i]['nombredistribuidor']=$dis['nombre'];
	$datos[$i]['fechaultimopago']=$mp['fechaultimopago'];
	$datos[$i]['total']=$mp['total'];
	$datos[$i]['totalcancelado']=$mp['totalcancelado'];
	$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	
	$titulo=array("fechaventa"=>"Fecha de Venta","fechaultimopago"=>"Fecha Último Pago","total"=>"Total","totalcancelado"=>"Total Cancelado","nombrecliente"=>"Cliente","nombrevendedor"=>"Vendedor","nombredistribuidor"=>"Distribuidor","codigocontrol"=>"Código de Control","observacion"=>"Observación");
	listadoTabla($titulo,$datos,1,"","","ver.php",array("Realizar Pago"=>"pagar.php"));
}
?>