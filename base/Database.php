<?php
require_once 'config.php';

/**
 * 
 * This is the main database class and we intend to give a static class
 * The entire datbase connection in maintained as 1 connection
 * All methods are static to avoid any objects being build
 * The class is final as it shouldnt be extended 
 * @author Adarsha
 */
final class Database {
	
	private static $db = DB;
	private static $host = HOST;
	private static $username = NORMAL_USER;
	private static $password = NORMAL_PASS;
	
	private static $dbConn = null; //Holds the database connection
	private static $queryCatch = array (); //Holds the query cache for faster processing
	private static $HTMLconfig = NULL; // Will store any configuration required for HTML purifier
	

	/**
	 * Constructor is private as no objects need to be created for static class
	 */
	private function __construct() {
	
	}
	/**
	 * Sets the HTML Purifier's configuration to be used in the subsequent queries.
	 * @param HTML Purifier Object $c
	 */
	public static function setHTMLConfig($c) {
		self::$HTMLconfig = $c;
	}
	/**
	 * 
	 * Returns the HTML Purifier's configuration to be used in the subsequent queries.
	 */
	public static function getHTMLConfig() {
		return self::$HTMLconfig;
	}
	/**
	 * Changes the Username and password to admin
	 * and sets the connection variable to NULL which is initialized on next call 
	 */
	public static function changeToAdmin() {
		self::$username = ADMIN_USER;
		self::$password = ADMIN_PASS;
		self::$dbConn = NULL;
	}
	/**
	 * Changes the Username and password to normal user (by default)
	 * and sets the connection variable to NULL which is initialized on next call 
	 */
	public static function changeToUser() {
		self::$username = NORMAL_USER;
		self::$password = NORMAL_PASS;
		self::$dbConn = NULL;
	}
	/**
	 * Connects to database if connection doesnt exist yet
	 * Uses the username and password of the static variable
	 * Uses PDO and Persistant connections
	 */
	private static function CONNECT() {
		if (self::$dbConn === null) {
			$connUrl = "mysql:host=" . self::$host . ";dbname=" . self::$db;
			self::$dbConn = new PDO ( $connUrl, self::$username, self::$password, array (PDO::ATTR_PERSISTENT => true ) );
		}
	}
	
	/**
	 * To execute the query(general)
	 * Takes the query & optional arguments to fill up the parameters
	 * Returns: 	Returns TRUE on success or FALSE on failure.
	 * NOTE: Use this only when all the values are strings OR INT. BLOB has to be implemented. 
	 * @param String $sql
	 * @return bool
	 */
	public static function query($sql) {
		self::CONNECT ();
		
		if (isset ( self::$queryCatch [$sql] ) && is_object ( self::$queryCatch [$sql] )) {
			$query = self::$queryCatch [$sql];
		} else {
			$query = self::$dbConn->prepare ( $sql );
			self::$queryCatch [$sql] = $query;
		}
		
		$numargs = func_num_args ();
		$arg_list = func_get_args ();
		//start from 1st parameter as 0th parameter is the query
		
		for($i = 1; $i < $numargs; $i ++) {
			//echo $arg_list[$i]." - ";
			if (is_int ( $arg_list [$i] )) {
				$query->bindParam ( $i, $arg_list [$i], PDO::PARAM_INT );
			} else {
				$query->bindParam ( $i, $arg_list [$i], PDO::PARAM_STR );
			}
		}
		
		
		$query->execute ();
		
		return $query;
	}
	/**
	 * Function: 	To execute the query (insert/update/delete)
	 * Parameters: 	Takes the query
	 * And optional arguments to fill up the parameters
	 * Returns: 	Returns TRUE on success or FALSE on failure.
	 * 
	 * @param String $sql
	 * @return bool
	 */
	public static function updateQuery($sql) {
		self::CONNECT ();
		
		if (isset ( self::$queryCatch [$sql] ) && is_object ( self::$queryCatch [$sql] )) {
			$query = self::$queryCatch [$sql];
		} else {
			$query = self::$dbConn->prepare ( $sql );
			self::$queryCatch [$sql] = $query;
		}
		
		$numargs = func_num_args ();
		$arg_list = func_get_args ();
		//start from 1st parameter as 0th parameter is the query
		
		for($i = 1; $i < $numargs; $i ++) {
			
			if (is_int ( $arg_list [$i] )) {
				$query->bindParam ( $i, $arg_list [$i], PDO::PARAM_INT );
			} else {
				$query->bindParam ( $i, $arg_list [$i], PDO::PARAM_STR );
			}
		}
		return $query->execute ();
	}
	
	/**
	 * Returns the last ID created by a INSERT statement if its there
	 * @return integer
	 */
	public static function getLastInsertId() {
		return intval ( self::$dbConn->lastInsertId () );
	}
}

?>