<?php
class ClearPar{
	
	function __construct(){
	
	}

	public function build($param){
		$separar = explode("()", $param);
		$newparam = "";
		foreach ($separar as $key => $value) {
			if ($value == "") {
				$newparam .= "()";
			}else{
				$newparam .= "";
			}
		}
		return $newparam;
	}


}