<?php
class Dynamite{
	private $allowed_list = array();
	private $db_path ;
	private $db ;
	private $sqlite ;
	
	function __construct(){
		if(!defined('DYNAMITE'))die();
		$this->db_path = DYNAMITE_SQLITE_PATH.'dynamite.db';
		try {
			$this->sqlite = new SQLite3($this->db_path, SQLITE3_OPEN_READONLY);
		} catch (Exception $e) {
			die(DYNAMITE_NOT_READY);
		}
	}
	
	public function set_allowed_list($list){
		if(!is_array($list))die('dynamite : an error occured') ;
		$this->allowed_list = $list ;
	}
	
	public function get_allowed_list(){
		return $this->allowed_list ;
		
	}
}
?>