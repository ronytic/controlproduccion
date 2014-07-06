<?php
include_once("../../login/check.php");
include_once '../../funciones/funciones.php';
$l=$_POST['l'];
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre,unidad"," - ");


?>
<tr>
	<td><?php echo $l;?></td>
    <td><?php campos("","m[$l][codproductos]","select",$pro,1,array("required"=>"required","class"=>"select"));?></td>
    
    <td><?php campos("","m[$l][cantidad]","number","0",0,array("class"=>"cantidad der","min"=>0,"style"=>"","rel"=>$l,"step"=>"0.1"));?></td>
    
    <td><?php campos("","m[$l][preciounitario]","number","0.00",0,array("step"=>"0.1","min"=>0,"class"=>"preciounitario der","style"=>"","rel"=>$l));?></td>
    
    <td><?php campos("","m[$l][total]","text","0.00",0,array("class"=>"der total","readonly"=>"readonly","style"=>"","rel"=>$l));?></td>
	<td><?php campos("","m[$l][fechavencimiento]","date",date("Y-m-d",strtotime(date("Y-m-d")." +30 day")),0,array("required"=>"required","style"=>"width:135px"));?></td>
</tr> 