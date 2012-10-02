<?php
require_once 'DataBoundObject.php';
/**
 * 
 * This class helps us to do operations with Admin Table
 * @author Adarsha
 */

class Admin extends DataBoundObject {

	protected $Username;
	protected $Password;
	
	public function __construct(array $idVals = array()) {
		parent::__construct($idVals);
	}

	function __destruct() {
		parent::__destruct();
	}

	/**
	 * 
	 * @see DataBoundObject::DefineAutoIncrementField()
	 */
	protected function DefineAutoIncrementField() {	
		return null;	
	}
	
	/**
	 * 
	 * @see DataBoundObject::DefineTableName()
	 */
	protected function DefineTableName() {
		return 'AT_ADMIN';
	}
	
	/**
	 * 
	 * @see DataBoundObject::DefineRelationMap()
	 */
	protected function DefineRelationMap() {
	
	return array(
			"USERNAME" => "Username",
			"PASSWORD" => "Password"
		);
	}
	
	/**
	 * 
	 * @see DataBoundObject::DefineID()
	 */
	protected function DefineID() {
		return array('Username');
	}

	public function setPassword($p) {
		if(strlen($p) >= 2 && strlen($p) <= 75)
			parent::setPassword(md5($p));
		else
			throw new Exception("Password should be between 2 & 75 charecters");
	}

	public function setUsername($name) {
		if(preg_match('/^[a-z\d_]{2,75}$/i', $name)) {
			
			$userExist = false;
			try {
				$tmp = new Admin(array($name));
				$userExist = true;
			}
			catch (Exception $e) {

			}

			if($userExist) throw new Exception("User already exist with this name");

			parent::setUsername($name);
		}
		else
			throw new Exception("Name-$name not in the right format. Only alpha numeric charecters with _ (underscore) .(dot) - (dash) & between 2 - 75 charecters allowed");
	}

	public function markForDeletion() {
		$result = Database::query("SELECT count(username) as cnt FROM AT_ADMIN");
		$row = $result->fetch();
		if($row['cnt'] > 1) 
			parent::markForDeletion();
		else
			throw new Exception("Cant delete the admin. Only admin left");
	}

	public static function AllAdmins() {
		$result = Database::query("SELECT * FROM AT_ADMIN");
		$ans = array();
		for($row = $result->fetch();$row;$row = $result->fetch())
		{
			$e = new Admin();
			$e->populateData($row);				
			$ans[] = $e;
		}
		
		return $ans;
	}
}
?>