<?php
class Dynamite{
	
	private $allowed_list = array();
	 
	function __construct(){}
	
	public function set_allowed_list($list){
		if(!is_array($list))die('dynamite : an error occured') ;
		$this->allowed_list = $list ;
	}
	
	public function get_allowed_list(){
		return $this->allowed_list ;
		
	}
}
?>