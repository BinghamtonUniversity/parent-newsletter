<?php
require_once 'DataBoundObject.php';
/**
 * 
 * This class helps us to do operations with Admin Table
 * @author Adarsha
 */

class Admin extends DataBoundObject {

	protected $AdminID;
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
		return 'ID';	
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
			"ID"	=>	"AdminID",
			"USERNAME" => "Username",
			"PASSWORD" => "Password"
		);
	}
	
	/**
	 * 
	 * @see DataBoundObject::DefineID()
	 */
	protected function DefineID() {
		return array('ID');
	}
}
?>