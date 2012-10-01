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
		if(strlen($name) > 0 && 
			strlen($name) <= 75 && 
			preg_match('( [a-z] | [A-Z] | [0-9] | "_")+', $name)) {
			
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
			throw new Exception("Name not in the right format. Only alpha numeric charecters with _ (underscore) & upto 75 charecters allowed");
	} 
}
?>