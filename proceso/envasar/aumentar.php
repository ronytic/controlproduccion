<?php
include_once("../../login/check.php");
include_once("../../funciones/funciones.php");
$l=$_POST['l'];
include_once("../../class/compra.php");
$compra=new compra;
include_once("../../class/envase.php");
$envase=new envase;
$pro=todolista($envase->mostrarTodo("","cantidad,unidad"),"codenvase","cantidad","");

print_r($pro);
?>
<tr>
	<td class="der"><?php echo $l;?></td>
    <td colspan="2">
        <select name="m[<?php echo $l?>][codenvase]" rel="<?php echo $l?>" class="productos p">									
            <option value="">Seleccionar</option>
            <?php foreach($envase->mostrarTodo("","cantidad,unidad") as $pr){$i++;
			?>
            <option value="<?php echo $pr['codenvase']?>" rel="<?php echo $pr['cantidad'];?>"><?php echo $pr['cantidad']." ".$pr['unidad'];?></option>
            <?php }?>
    	</select>
    </td>
    <td><?php campos("","m[$l][cantidad]","number","0",0,array("class"=>"der cantidad","min"=>0,"style"=>"width:80px;","rel"=>$l,"step"=>"1"));?></td>


    <td><?php campos("","m[$l][total]","text","0.00",0,array("class"=>"der total","readonly"=>"readonly","style"=>"width:80px;","rel"=>$l));?></td>
</tr>