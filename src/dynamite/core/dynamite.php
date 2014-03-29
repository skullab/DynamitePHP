<?php
class Dynamite{
	private $allowed_list = array();
	private $db_path ;
	private $db ;
	private $sqlite ;
	private $user_info ;
	
	function __construct(){
		if(!defined('DYNAMITE'))die();
		$this->db_path = DYNAMITE_SQLITE_PATH.'dynamite.db';
		try {
			$this->sqlite = new SQLite3($this->db_path, SQLITE3_OPEN_READONLY);
			$this->sqlite = new SQLite3($this->db_path);
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
	
	public function check_user($user,$pwd){
		$user = strtolower($user);
		$hash = $this->sqlite->querySingle("SELECT pwd FROM users WHERE name='$user'");
		if($hash && !is_null($hash)){
			if(crypt($pwd,$hash) == $hash){
				$results = $this->sqlite->query("SELECT * FROM users WHERE name='$user' AND pwd='$hash'");
				$this->user_info = $results->fetchArray(SQLITE3_ASSOC) ;
				return ($results && $results->numColumns() && $results->columnType(0) != SQLITE3_NULL) ;
			}
		}
		return false ;
	}
	
	public function get_user_info($info = false){
		if(!$info)return $this->user_info ;
		if(isset($this->user_info[$info]))return $this->user_info[$info];
		return false ;
	}
}
?>