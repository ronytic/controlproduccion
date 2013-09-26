<?php
include_once '../../login/check.php';
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

$l=$_POST['l'];
$l++;
include_once("../../class/compra.php");
$compra=new compra;
?>
<tr>
				<td width="500"><select name="p[<?php echo $l?>][codproductos]" rel-linea="<?php echo $l?>" class="productos p">									
                	<option value="">Seleccionar</option>
                	<?php foreach($productos->mostrarTodo("","nombre") as $pr){$i++;
					$sum=array_shift($compra->sumar($pr['codproductos']));
					$sumatotal=$sum['cantidadtotalstock']!=""?$sum['cantidadtotalstock']:'0';?>
                    <option value="<?php echo $pr['codproductos']?>" rel="<?php echo $sumatotal;?>"><?php echo $pr['nombre']." - Cantidad Stock: ".$sumatotal;?></option>
                    <?php }?>
                </select></td>
                        
                        <td><input type="number" name="p[<?php echo $l?>][cantidad]" value="0" class="der cantidad" rel-linea="<?php echo $l?>" min="0" step="1"></td>
			</tr>