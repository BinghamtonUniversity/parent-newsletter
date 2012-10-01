<?php
require_once 'DataBoundObject.php';
/**
 * 
 * This class helps us to do operations with Admin Table
 * @author Adarsha
 */

class Posts extends DataBoundObject {

	protected $PostID;
	protected $UserID;
	protected $Title;
	protected $Data;
	protected $Status;
	protected $Created;
	protected $Updated;
	protected $Published;
	
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
		return 'AT_POSTS	';
	}
	
	/**
	 * 
	 * @see DataBoundObject::DefineRelationMap()
	 */
	protected function DefineRelationMap() {
	
	return array(
			"ID"	=>	"PostID",
			"UID" => "UserID",
			"TITLE" => "Title",
			"POST" => "Data",
			"STATUS" => "Status",
			"CREATED" => "Created",
			"UPDATED" => "Updated",
			"PUBLISHED" => "Published"
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