<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de PEDIDOS para  MENÚ DE COMIDA";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin;
		$this->CuadroCabecera(30,"Fecha Inicio:",20,fecha2Str($fechainicio));
		$this->CuadroCabecera(30,"Fecha Fin:",20,fecha2Str($fechafin));
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(20,"Fecha");
		$this->TituloCabecera(20,"Tipo");
		$this->TituloCabecera(45,"Plato");
		$this->TituloCabecera(40,"Ingredientes");
		$this->TituloCabecera(20,"Cantidad");
		$this->TituloCabecera(15,"Soldado");
		$this->TituloCabecera(20,"Total");
	}	
}


include_once("../../class/comida.php");
include_once("../../class/productos.php");
include_once("../../class/menucomida.php");
include_once("../../class/usuarios.php");
$menucomida=new menucomida;
$comida=new comida;
$productos=new productos;
$usuarios=new usuarios;
$where="fechacomida BETWEEN '$fechainicio' and '$fechafin'";
/*if(!empty($fechacontrato)){
	$where="`fechacontrato`<='$fechacontrato'";
}
if(!empty($codobra)){
	$where=(empty($fechacontrato))?"`codobra`=$codobra":$where." and `codobra`=$codobra";
}
if(!empty($tipocontrato)){
	$where=(empty($where))?$where."`tipocontrato` LIKE '%$tipocontrato%'":$where." and `tipocontrato` LIKE '%$tipocontrato%'";
}*/

//echo $where;
$pdf=new PDF("P","mm","legal");
$pdf->AddPage();
$totales=array();
foreach($menucomida->mostrarTodos($where) as $menucomi){$i++;
	$desayuno=array_shift($comida->mostrar($menucomi['desayuno']));
	$sopa=array_shift($comida->mostrar($menucomi['sopa']));
	$segundo=array_shift($comida->mostrar($menucomi['segundo']));
	$postre=array_shift($comida->mostrar($menucomi['postre']));
	$tetarde=array_shift($comida->mostrar($menucomi['tetarde']));
	$cena=array_shift($comida->mostrar($menucomi['cena']));

	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(20,fecha2Str($menucomi['fechacomida']));
	$pdf->CuadroCuerpo(20,"Desayuno: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$desayuno['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['desayuno']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(30,"");
	$pdf->CuadroCuerpo(20,"Sopa: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$sopa['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['sopa']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(30,"");
	$pdf->CuadroCuerpo(20,"Segundo: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$segundo['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['segundo']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(30,"");
	$pdf->CuadroCuerpo(20,"Postre: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$postre['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['postre']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(30,"");
	$pdf->CuadroCuerpo(20,"Té Tarde: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$tetarde['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['tetarde']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(30,"");
	$pdf->CuadroCuerpo(20,"Cena: ",0);
	$pdf->CuadroCuerpoPersonalizado(45,$cena['nombre'],0,"",0,"B");
	$comi=array_shift($comida->mostrar($menucomi['cena']));
	$pdf->Ln();
	for($i=1;$i<=20;$i++){
		if($comi['ingrediente'.$i]!=0){
			$prod=array_shift($productos->mostrar($comi['ingrediente'.$i]));
			$subtotal=number_format($prod['cantidad']*$menucomi['cantidad'],2);
			$totales[$comi['ingrediente'.$i]]+=$subtotal;
			$pdf->CuadroCuerpo(95,"");
			$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);
			$pdf->CuadroCuerpo(20,number_format($prod['cantidad'],2)." kg",0,"",1);
			$pdf->CuadroCuerpo(15,$menucomi['cantidad'],0,"R",1);
			$pdf->CuadroCuerpo(20,$subtotal." kg",0,"R",1);
			$pdf->Ln();
		}	
	}
	//$pdf->CuadroCuerpo(20,": ".$menucomi['cantidad'],0,"R");
	


	$pdf->Ln();
}
//print_r($totales);
$pdf->Ln();
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(185,"Totales de Pedidos de Productos",1,"C",0);
$pdf->ln();
$pdf->ln();
$i=0;
$pdf->CuadroCuerpoPersonalizado(10,"N",0,"R",1,"B");
$pdf->CuadroCuerpoPersonalizado(40,"Producto",0,"",1,"B");	
$pdf->CuadroCuerpoPersonalizado(30,"Total",0,"R",1,"B");
$pdf->ln();
foreach($totales as $k=>$v){$i++;
	$prod=array_shift($productos->mostrar($k));
	$pdf->CuadroCuerpo(10,$i,0,"R",1);
	$pdf->CuadroCuerpo(40,$prod['nombre'],0,"",1);	
	$pdf->CuadroCuerpo(30,number_format($v,2)." Kg",0,"R",1);
	$pdf->ln();	
}
$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$usu4=array_shift($usuarios->mostrarTodo("nivel=4"));
$usu3=array_shift($usuarios->mostrarTodo("nivel=3"));
$usu2=array_shift($usuarios->mostrarTodo("nivel=2"));
$pdf->CuadroCuerpoPersonalizado(90,$usu4['nombre']." ".$usu4['paterno']." ".$usu4['materno'],0,"C",0,"B");
$pdf->CuadroCuerpoPersonalizado(90,$usu3['nombre']." ".$usu3['paterno']." ".$usu3['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(90,"Encargado de Clase 1",0,"C",0);
$pdf->CuadroCuerpo(90,"Jefe de Servicio",0,"C",0);
$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(180,$usu2['nombre']." ".$usu2['paterno']." ".$usu2['materno'],0,"C",0,"B");
$pdf->ln();
$pdf->CuadroCuerpo(180,"Comandante",0,"C",0);
$pdf->Output();
?>