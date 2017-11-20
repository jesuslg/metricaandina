<?php

class ChangeString {
	
	function __construct(){
	}


	public function build($parametro){
		$newphrase = "";
		$abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "ñ", "o",
					 "p", "q", "r","s", "t", "u", "v", "w", "x", "y", "z");
		$num = strlen($parametro);
		$cont_abc = count($abc);
		for($a=0; $a < $num; $a++){
			if (array_search($parametro[$a], $abc) !== false) {
				$i = array_search($parametro[$a], $abc);
				if ($i+1 == $cont_abc) {
					$newphrase .= $abc[0];
				}else{
					$newphrase .= $abc[$i+1];
				}
			}else{
				$newphrase .= $parametro[$a];
			}
		}
		return $newphrase;
	}


}