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
	protected $FirstPublished = null;
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
			parent::setUser($name);
		}
		catch (Exception $e) {
			throw new Exception("The user you are trying to assign doesnt exist");
		}
	}

	public function setStatus($s) {
		if($s === self::STATUS_DRAFT || $s === self::STATUS_PUBLISHED) {
			parent::setStatus($s);
			
		}
		else
			throw new Exception("Wrong status");
	}

	private function setFirstPublished($var) {
		parent::setFirstPublished($var);
	}

	private function setCreated($var) {
		parent::setCreated($var);
	}

	private function setUpdated($var) {
		parent::setUpdated($var);
	}

	public function save() {
		$this->setUpdated(date("Y-m-d H:i:s"));

		if($this->Status === self::STATUS_PUBLISHED) {
			if($this->getFirstPublished() === null)
				$this->setFirstPublished(date("Y-m-d H:i:s"));
			$this->setPublished(date("Y-m-d H:i:s"));
		}
		parent::save();
	}

	public function insert() {
		//We have to use the direct variable value as we will try to load IDs when we are going to get and it conflicts.
		if($this->Status === self::STATUS_PUBLISHED) {
			if($this->FirstPublished == "")
				$this->setFirstPublished(date("Y-m-d H:i:s"));
			$this->setPublished(date("Y-m-d H:i:s"));
		}
		$this->setUpdated(date("Y-m-d H:i:s"));
		parent::insert();
	}

	private function setPublished($var) {
		parent::setPublished($var);
	}

	public function setTitle($var) {
		if(strlen($var) > 1 && strlen($var) <= 255) {
			parent::setTitle($var);
		}
		else
			throw new Exception("Title should be between 1 and 255 charecters");
	}

	public static function AllPosts($sort = false) {
		$query = "SELECT * FROM AT_POSTS";
		if($sort) $query .= " ORDER BY CREATED DESC ";

		$result = Database::query($query);

		$ans = array();
		for($row = $result->fetch();$row;$row = $result->fetch())
		{
			$e = new Posts();
			$e->populateData($row);				
			$ans[] = $e;
		}
		
		return $ans;
	}

	public function getCreated() {
		$val = parent::getCreated();
		if($val == "0000-00-00 00:00:00")
			return null;
		return $val;
	}

	public function getUpdated() {
		$val = parent::getUpdated();
		if($val == "0000-00-00 00:00:00")
			return null;
		return $val;
	}

	public function getFirstPublished() {
		$val = parent::getFirstPublished();
		if($val == "0000-00-00 00:00:00")
			return null;
		return $val;
	}

	public function getPublished() {
		$val = parent::getPublished();
		if($val == "0000-00-00 00:00:00")
			return null;
		return $val;
	}


}
?>