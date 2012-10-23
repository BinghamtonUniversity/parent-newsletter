<?php
require_once 'Database.php';
/**
 * Data Bound Object ORM
 * ORM (Object relation mapping) is done here in this class.
 * This class is not an independent class but must be further derived to the appropriate table.
 * BE CAREFUL WITH DERIVED CLASS VARIABLE NAMES DOESNT CONFLICT WITH THIS CLASS
 * @author footy
 */
abstract class DataBoundObject {
	protected $ID; //Stores the primary/composit keys of the database
	protected $AutoIncrementFeild; //Stores the attribute name of any auto increment feild in DB
	protected $strTableName; //Stores table name of DB 
	protected $arRelationMap; //Stores how the attribures are mapped to the variables of class extending this class 
	protected $blForDeletion; //Stores if or not to delete the row when object destroyes
	protected $blIsLoaded; //Indicates of the variables are loaded from DB
	protected $arModifiedRelations; //Indicates the feilds to be updated which have been changed since the previous change
	

	//The following functions are required to run this class
	/**
	 * Get table name
	 * The abstract function overrided in the subclass must return table name
	 * @return string
	 */
	abstract protected function DefineTableName();
	/**
	 * Get the realtion mapping from class variables to table names
	 * The abstract function overrided in the subclass must return an array()
	 * This must must contain the mapping of class variable names to table coloumn names
	 * Format = "[key]" => "[Value]"
	 * Where key = name in table anad value = name of the class variable
	 * @return ArrayObject
	 */
	abstract protected function DefineRelationMap();
	/**
	 * The abstract function overrided in the subclass must return the IDS
	 * The returned IDs must be in an array.
	 * When composite keys are involved, then return all the column names in the array.
	 * @return ArrayObject
	 */
	abstract protected function DefineID();
	/**
	 * Define any auto increment feild here.
	 * So that its updated when inserting is done. Only 1 feild permited
	 * @return string
	 */
	abstract protected function DefineAutoIncrementField();
	
	/**
	 * Load IDs defened
	 * A function to load all IDs
	 */
	protected function loadIDs() {
		
		if (count ( $this->ID ) > 0) {
			foreach ( $this->ID as $key => $clause ) { 
				
				if (property_exists ( $this, $clause ['field'] )) {
					$tmp = null;
					eval ( '$tmp = $this->get' . $clause ['field'] . '();' );
					$this->ID [$key] ['value'] = $tmp;

				}
			}
		}
	}
	/**
	 * Check IDs defenition
	 * A function to check if the ID feild is defined properly
	 * Note: Its defined properly when
	 * 1. It has any value at all in it
	 * 2. All the keys(primary/composite) have their corresponding values specified
	 */
	protected function isIDDefined() {
		if (count ( $this->ID ) > 0) {
			//if((array)is_array($this->ID)) { echo "Yes Array!\n"; var_dump($this->ID); }
			//var_dump($this->ID);
			foreach ( $this->ID as $clause ) {
				if (! isset ( $clause ['value'] ) || $clause ['value'] === NULL)
					return false;
			}
		}
		return true;
	}
	/*
	 * Note that you HAVE to give the id values as an ARRAY data even if its a single value
	*/
	/**
	 * Constructor
	 * Takes an optional argument.
	 * If given checks if the array correspods to the row in a table and loads it
	 * If loading fails an exception is thrown.
	 * If no argument is given then nothing is initialized
	 * @param ArrayObject $idVals
	 */
	public function __construct(array $idVals = array()) {
		$this->strTableName = $this->DefineTableName ();
		$this->arRelationMap = $this->DefineRelationMap ();
		$this->blIsLoaded = false;
		$this->blForDeletion = false;
		$this->ID = array ();
		$tmp = $this->DefineID ();
		
		for($i = 0; $i < count ( $tmp ); $i ++) {
			$this->ID [$i] ['field'] = $tmp [$i]; // field
		}
		for($j = 0; $j < count ( $idVals ); $j ++) {
			$this->ID [$j] ['value'] = $idVals [$j]; // its value
		}
		$this->AutoIncrementFeild = $this->DefineAutoIncrementField ();
		$this->arModifiedRelations = array ();
		
		if ($this->isIDDefined ()) {
			$this->Load (true);
		}
	}
	/**
	 * Enable row deletion
	 * Function used to mark the object to delete the row when it destroyes itself
	 */
	public function markForDeletion() {
		$this->blForDeletion = true;
	}
	/*
	 * 
	*/
	/**
	 * Destructor
	 * The destructor is used to DELETE the object from its database if its marked
	 * Throws exception when deletion fails if marked.
	 * @throws Exception
	 */
	public function __destruct() {
		
		$dataToBeChanged = array ();
		if ($this->isIDDefined ()) {
			if ($this->blForDeletion === TRUE) {
				$strQuery = 'DELETE FROM ' . $this->strTableName . ' WHERE ';
				foreach ( $this->ID as $clause ) {
					$strQuery .= $clause ['field'] . " = ? AND ";
					eval ( '$DATA_TO_DB_' . $clause ['field'] . ' = $clause[\'value\'];' );
					$dataToBeChanged [] = '$DATA_TO_DB_' . $clause ['field'];
				}
				$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 4 );
				$result = null;
				$parmForQuery = implode ( ',', $dataToBeChanged );
				
				eval ( '$result = Database::updateQuery($strQuery,' . $parmForQuery . ');' );
				if ($result != true) {
					throw new Exception ( "Deletion of the line failed!" );
				}
			
			}
		}
	}
	/**
	 * Loads all the data
	 * From the corresponding row in the database and fills the objec's variables 
	 * Throws exception if it fails due to ndefined IDs
	 * @throws Exception
	 */
	public function Load($fromConstructor = false) {
		
		$dataToBeChanged = array ();
		if ($this->isIDDefined ()) { 
			$strQuery = " SELECT ";
			foreach ( $this->arRelationMap as $key => $value ) {
				$strQuery .= $key . ",";
			}
			$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 1 );
			$strQuery .= " FROM " . $this->strTableName . " WHERE ";
			
			//var_dump($this->ID);

			foreach ( $this->ID as $clause ) {
				$strQuery .= $clause ['field'] . " = ? AND ";

				if($fromConstructor)
					eval ( '$DATA_TO_DB_' . $clause ['field'] . ' = $clause[\'value\'];' );
				else
					eval ( '$DATA_TO_DB_' . $clause ['field'] . ' = $this->'.$this->arRelationMap[$clause['field']].';' );
				$dataToBeChanged [] = '$DATA_TO_DB_' . $clause ['field'];
			}
			$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 4 );
			
			$result = null;
			$parmForQuery = implode ( ',', $dataToBeChanged );
			//echo '$result = Database::query($strQuery,' . $parmForQuery . ');';
			eval ( '$result = Database::query($strQuery,' . $parmForQuery . ');' );
			$row = $result->fetch ();
			if (! $row) {
				throw new Exception ( " Could not load the required ID/IDs as row not found " );
			}

			foreach ( $row as $key => $value ) {
				if (isset ( $this->arRelationMap [$key] )) {
					
					$strMember = $this->arRelationMap [$key];
					if (property_exists ( $this, $strMember )) {
						if (is_numeric ( $value )) {
							eval ( '$this->' . $strMember . ' = ' . $value . ';' );
						} else {
							eval ( '$this->' . $strMember . ' = "' . addslashes ( $value ) . '";' );
						}
					}
				}
			}
			$this->blIsLoaded = true;
		} else {
			throw new Exception ( "Complete IDs are not defined" );
		}
	}
	/*
	 * 
	*/
	/**
	 * Populate current object with own data
	 * Populate the data with the values given a row array returned from PDO object's fetch
	 * representing them using the array maping
	 * @param array $row
	 */
	public function populateData(array $row) {
		foreach ( $row as $key => $value ) {
			if (isset ( $this->arRelationMap [$key] )) {
				
				$strMember = $this->arRelationMap [$key];
				if (property_exists ( $this, $strMember )) {
					if (is_numeric ( $value )) {
						eval ( '$this->' . $strMember . ' =  $value ;' );
					} else {
						eval ( '$this->' . $strMember . ' = $value ;' );
					}
				}
			}
		}
		$this->blIsLoaded = true;
		$this->loadIDs ();
	}
	/**
	 * Insert a new row for the object in database.
	 * Inserts the new row into the database given all the requred feilds.
	 * Throws an exception if its called and a row representing it already exist.
	 * @throws Exception
	 */
	public function insert() {
		$strQuery = "INSERT INTO " . $this->strTableName . " (";
		foreach ( $this->arRelationMap as $key => $value ) {
			eval ( '$actualVal = &$this->' . $value . ';' );
			if (isset ( $actualVal )) {
				if (array_key_exists ( $value, $this->arModifiedRelations )) {
					$strQuery .= $key . ",";
					eval ( '$DATA_TO_DB_' . $key . ' = $actualVal;' );
					$dataToBeChanged [] = '$DATA_TO_DB_' . $key;
				}
			}
		}
		
		$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 1 );
		$strQuery .= ") VALUES (";
		for($i = 0; $i < count ( $dataToBeChanged ); $i ++)
			$strQuery .= '?,';
		$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 1 );
		$strQuery .= ')';
		$parmForQuery = implode ( ',', $dataToBeChanged );
		$result = false;
//		echo $strQuery;
		eval ( '$result = Database::updateQuery($strQuery,' . $parmForQuery . ');' );
		
		foreach ( $dataToBeChanged as $var ) {
			eval ( 'unset(' . $var . ');' );
		}
		unset ( $dataToBeChanged );
		if ($result === false)
			throw new Exception ( "The insertion failed!" );
		foreach ( $this->ID as $key => $clause ) {
			
			if ($clause ['field'] == $this->AutoIncrementFeild) {
				$this->ID [$key] ['value'] = Database::getLastInsertId ();
				eval ( '$this->' . $this->arRelationMap[$clause ['field']] . ' = $this->ID[$key][\'value\'];' );
				break;
			} else {
				//echo '$this->ID[$key][\'value\'] = $this->' . $this->arRelationMap[$clause ['field']] . ';';
				eval ( '$this->ID[$key][\'value\'] = $this->' . $this->arRelationMap[$clause ['field']] . ';' );
			}
		}
		$this->Load ();
		
		return $result;
	}
	/**
	 * Save changes to database
	 * Maps and saves any changes to the variables in the object
	 * to the corresponding row in the database.
	 * Throws an exception if saving fails OR if the row doesnt exist
	 * @throws Exception
	 */
	public function save() {
		$result = false;
		$dataToBeChanged = array ();
		if (count ( $this->arModifiedRelations ) > 0) {
			
			if ($this->isIDDefined ()) {
				$strQuery = "UPDATE " . $this->strTableName . " SET ";
				foreach ( $this->arRelationMap as $key => $value ) {
					eval ( '$actualVal = &$this->' . $value . ';' );
					if (array_key_exists ( $value, $this->arModifiedRelations )) {
						$strQuery .= $key . " = ? ,";
						eval ( '$DATA_TO_DB_' . $key . ' = $actualVal;' );
						$dataToBeChanged [] = '$DATA_TO_DB_' . $key;
					}
				}
				//var_dump($this);
				$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 1 );
				$strQuery .= ' WHERE ';
				
				foreach ( $this->ID as $clause ) {
					$strQuery .= $clause ['field'] . " = ? AND ";
					eval ( '$DATA_CLAUSE_TO_DB_' . $clause ['field'] . ' = $clause[\'value\'];' );
					$dataToBeChanged [] = '$DATA_CLAUSE_TO_DB_' . $clause ['field'];
				}
				$strQuery = substr ( $strQuery, 0, strlen ( $strQuery ) - 4 );
				
				$parmForQuery = implode ( ',', $dataToBeChanged );
				//echo $strQuery.'-'.$parmForQuery.$DATA_TO_DB_NAME.'-'.$DATA_CLAUSE_TO_DB_NAME.'<br>';
				eval ( '$result = Database::updateQuery($strQuery,' . $parmForQuery . ');' );
				
				//				As the changed values are updated. We need to reflect it in the modified value
				//				relationship to avoid unnecessary overhead in later saves
				unset ( $this->arModifiedRelations );
				foreach ( $dataToBeChanged as $var ) {
					eval ( 'unset(' . $var . ');' );
				}
				unset ( $dataToBeChanged );
				$this->arModifiedRelations = array ();
				//var_dump($this);
				//LOAD Again. Cos when HTML purifier changes anything its better to load.
				$this->Load ();
			} else {
				throw new Exception ( "Didnot save as not all ID defined" );
			}
		}
		return $result;
	}
	
	/**
	 * General calling function
	 * Creates the getXX() and setXX() method for class variaibles.
	 * This can be overided for class specific behaviour.
	 * @param sting $strFunction
	 * @param ArrayObject $arArguments
	 * @throws Exception
	 */
	public function __call($strFunction, $arArguments) {
		$strMethodType = substr ( $strFunction, 0, 3 );
		$strMethodMember = substr ( $strFunction, 3 );
		
		switch ($strMethodType) {
			case "set" :
				return ($this->SetAccessor ( $strMethodMember, $arArguments [0] ));
				break;
			case "get" :
				return ($this->GetAccessor ( $strMethodMember ));
				break;
			default :
				throw new Exception ( "Non existent method $strFunction call dude!" );
		}
		return false;
	}
	/**
	 * Sets the property of the class
	 * Changes the property of the class
	 * @param string $strMember
	 * @param Object(including strings) or integer $strNewValue
	 * @throws Exception
	 */
	public function SetAccessor($strMember, $strNewValue) {
		
		if (property_exists ( $this, $strMember )) {
			if (is_numeric ( $strNewValue )) {
				eval ( '$this->' . $strMember . ' = ' . $strNewValue . ';' );
			} else {
				eval ( '$this->' . $strMember . ' = "' . addslashes ( $strNewValue ) . '";' );
			}
			$this->arModifiedRelations [$strMember] = true;
		} else {
			throw new Exception ( "Property $strMember doesnt exist!" );
		}
	
	}
	/**
	 * Gets the property of the class
	 * Changes the property of the class
	 * @param string $strMember
	 * @return Object
	 * @throws Exception
	 */
	public function GetAccessor($strMember) {
		
		if ($this->blIsLoaded != true) {
			$this->Load ();
		}
		if (property_exists ( $this, $strMember )) {
			$strRetVal = null;
			eval ( '$strRetVal = $this->' . $strMember . ';' );
			return $strRetVal;
		} else {
			throw new Exception ( "Property $strMember doesnt exist!" );
		}
	}
}
?>