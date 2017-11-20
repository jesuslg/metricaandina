<?php
class CompleteRange{
	
	function __construct(){

	}

	public function build($param){
		asort($param);//ordenar de menor a mayor por si acaso
		$nuevo_orden = array();
		$valor_max = max($param);
		$valor_min = min($param);
		$elementos = count($param);

		for ($i=$valor_min; $i <= $valor_max  ; $i++) { 
			array_push($nuevo_orden, $i);
		}
		
		return $nuevo_orden;
	}


}