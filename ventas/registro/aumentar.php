<?php
include_once("../../login/check.php");
include_once("../../funciones/funciones.php");
$l=$_POST['l'];
include_once("../../class/compra.php");
$compra=new compra;
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

include_once("../../class/envasado.php");
$envasado=new envasado;
$env=$envasado->agrupado();

include_once("../../class/envase.php");
$envase=new envase;
?>
<tr>
	<td class="der"><?php echo $l;?></td>
    <td colspan="3">
        <select name="m[<?php echo $l?>][codproductos]" rel="<?php echo $l?>" class="productos p">									
            <option value="">Seleccionar</option>
            <optgroup label="Productos Directos">
            <?php foreach($productos->mostrarTodo("","nombre") as $pr){$i++;
            $sum=array_shift($compra->sumar($pr['codproductos']));
            $sumatotal=$sum['cantidadtotalstock']!=""?$sum['cantidadtotalstock']:'0';?>
            <option value="<?php echo $pr['codproductos']?>" rel="<?php echo $sumatotal;?>"><?php echo $pr['nombre']." - Stock: ".$sumatotal." ".$pr['unidad'];?></option>
            
            <?php }?>
            </optgroup>
            <optgroup label="Productos Envasados">
            <?php foreach($env as $e){
				$prod=$productos->mostrar($e['codproductos']);
				$prod=array_shift($prod);
				$enva=$envase->mostrar($e['codenvase']);
				$enva=array_shift($enva);
				?>
				<option value="<?php echo "e-".$e['codproductos']."-".$e['codenvase']."-".$e[]?>" rel="<?php echo $e['cantidadtotal'];?>"><?php echo $prod['nombre']?> - Envase: <?php echo $enva['cantidad']?> <?php echo $enva['unidad']?>  - Stock: <?php echo $e['cantidadtotal']?> Envases</option>	
			<?php }?>
            
            </optgroup>
    	</select>
    </td>
    <td><?php campos("","m[$l][cantidad]","number","0",0,array("class"=>"der cantidad","min"=>0,"style"=>"width:80px;","rel"=>$l,"step"=>"1"));?></td>

    <td><?php campos("","m[$l][preciounitario]","number","0.00",0,array("step"=>"0.1","min"=>0,"class"=>"der preciounitario","style"=>"width:80px;","rel"=>$l));?></td>

    <td><?php campos("","m[$l][total]","text","0.00",0,array("class"=>"der total","readonly"=>"readonly","style"=>"width:80px;","rel"=>$l));?></td>
</tr>