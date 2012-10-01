<?php
require_once 'DataBoundObject.php';
require_once 'Admin.php';
/**
 * 
 * This class helps us to do operations with Admin Table
 * @author Adarsha
 */

class Posts extends DataBoundObject {

	protected $PostID;
	protected $User;
	protected $Title;
	protected $Data;
	protected $Status; //0- DRAFT, 1- PUBLISHED
	protected $Created;
	protected $Updated;
	protected $FirstPublished;
	protected $Published;

	protected $UserObject;
	
	const STATUS_DRAFT = 0;
	const STATUS_PUBLISHED = 1;

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
			"USER" => "User",
			"TITLE" => "Title",
			"POST" => "Data",
			"STATUS" => "Status",
			"CREATED" => "Created",
			"UPDATED" => "Updated",
			"FIRST_PUBLISHED" => "FirstPublished",
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

	private function setPostID() {
		throw new Exception("cant change post ID");
	}

	public function setUser($name) {
		try {
			$this->UserObject = new Admin(array($name));
			parent::setUser($id);
		}
		catch (Exception $e) {
			throw new Exception("The user you are trying to assign doesnt exist");
		}
	}

	public function setStatus($s) {
		if($s === this::STATUS_DRAFT || $s === this::STATUS_PUBLISHED) {
			parent::setStatus($s);
			if($this->Status === this::STATUS_PUBLISHED) {
				$this->setFirstPublished(date("Y-m-d H:i:s"));
				$this->setPublished(date("Y-m-d H:i:s"));
			}
		}
		else
			throw new Exception("Wrong status");
	}

	public function setFirstPublished() {
		throw new Exception("Cant explicitly call this function");
	}

	public function setCreated() {
		throw new Exception("cant change created");
	}

	public function setUpdated() {
		throw new Exception("Cant explicitly call Posts::setUpdated()");
	}

	public function save() {
		parent::setUpdated(date("Y-m-d H:i:s"));
		if($this>Status == this::STATUS_PUBLISHED)
			parent::setPublished(date("Y-m-d H:i:s"));
		parent::save();
	}

	public function setPublished() {
		throw new Exception("Cant explicitly call Posts::setPublished()");
	}

}
?>