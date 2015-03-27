<?php
/**
 * File for MySQL class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/6/13
 * @package CoreAPI/Libraries/Database
 */

/**
 *
 * @package CoreAPI/Libraries/Database
 */
class MySQL {

	//------------------------------------------------------------------------------
	//!**** Private Variables ****
	//------------------------------------------------------------------------------

	private $__lastError;		// Holds the last error
	private $__lastQuery;		// Holds the last query
	private $__result;			// Holds the MySQL query result
	private $__records;			// Holds the total number of records returned
	private $__affected;		// Holds the total number of records affected
	private $__rawResults;		// Holds raw 'arrayed' results
	private $__arrayedResult;	// Holds an array of the result

	private $__hostname;		// MySQL Hostname
	private $__username;		// MySQL Username
	private $__password;		// MySQL Password
	private $__database;		// MySQL Database

	private $__databaseLink;	// Database Connection Link

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * Class constructor method.
 */
	public function __construct($username, $password, $hostname='localhost', $database=null) {
		$this->__database = $database;
		$this->__username = $username;
		$this->__password = $password;
		$this->__hostname = $hostname;

		$this->__connect();
	}

/**
 * Class destructor method.
 */
	public function __destruct() {
		$this->closeConnection();
	}

	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//------------------------------------------------------------------------------

/**
 * Executes MySQL query
 *
 * @param string Query String
 * @returns array|boolean Returns an array of results, or a `true` (if an UPDATE or DELETE).
 */
	public function executeSQL($query) {
		$this->__lastQuery = $query;
		if ($this->__result = $this->__databaseLink->query($query)) {
			$this->__records = $this->__result->num_rows;
			$this->__affected = $this->__databaseLink->affected_rows;

			if ($this->__records > 0) {
				$this->arrayResults();
				return $this->__arrayedResult;
			} else {
				return true;
			}

		} else {
			$this->__lastError = $this->__databaseLink->errno;
			return false;
		}
	}

/**
 * Adds a record to the database based on the array key names
 *
 * @param array $privates
 * @param string $table
 * @param string $exclude (default: '')
 * @return boolean Returns `true` on success or `false` if there is an error.
 */
	public function insert($privates, $table, $exclude = '') {
		// Catch Exclusions
		if ($exclude == '') {
			$exclude = array();
		}

		array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

		// Prepare Variables
		$privates = $this->__secureData($privates);

		$query = "INSERT INTO `{$table}` SET ";
		foreach ($privates as $key => $value) {
			if (in_array($key, $exclude)) {
				continue;
			}
			//$query .= '`' . $key . '` = "' . $value . '", ';
			$query .= "`{$key}` = '{$value}', ";
		}

		$query = substr($query, 0, -2);

		return $this->executeSQL($query);
	}

/**
 * Deletes a record from the database
 *
 * @access public
 * @param mixed $table
 * @param string $where (default: '')
 * @param string $limit (default: '')
 * @param bool $like (default: false)
 * @return void
 */
	public function delete($table, $where='', $limit='', $like=false) {
		$query = "DELETE FROM `{$table}` WHERE ";
		if (is_array($where) && $where != '') {
			// Prepare Variables
			$where = $this->__secureData($where);

			foreach ($where as $key => $value) {
				if ($like) {
					//$query .= '`' . $key . '` LIKE "%' . $value . '%" AND ';
					$query .= "`{$key}` LIKE '%{$value}%' AND ";
				} else {
					//$query .= '`' . $key . '` = "' . $value . '" AND ';
					$query .= "`{$key}` = '{$value}' AND ";
				}
			}

			$query = substr($query, 0, -5);
		}

		if ($limit != '') {
			$query .= ' LIMIT ' . $limit;
		}

		return $this->executeSQL($query);
	}

/**
 * Gets a single row from $from where $where is true.
 *
 * @param string $from
 * @param array|string $where (default: '')
 * @param string $orderBy (default: '')
 * @param string $limit (default: '')
 * @param bool $like (default: false)
 * @param string $operand (default: 'AND')
 * @param string $cols (default: '*')
 * @return array|boolean Returns an array of results or `false` on faliure.
 */
	public function select($from, $where='', $orderBy='', $limit='', $like=false, $operand='AND', $cols='*') {
		// Catch Exceptions
		if (trim($from) == '') {
			return false;
		}

		$query = "SELECT {$cols} FROM `{$from}` WHERE ";

		if (is_array($where) && $where != '') {
			// Prepare Variables
			$where = $this->__secureData($where);

			foreach ($where as $key => $value) {
				if ($like) {
					//$query .= '`' . $key . '` LIKE "%' . $value . '%" ' . $operand . ' ';
					$query .= "`{$key}` LIKE '%{$value}%' {$operand} ";
				} else {
					//$query .= '`' . $key . '` = "' . $value . '" ' . $operand . ' ';
					$query .= "`{$key}` = '{$value}' {$operand} ";
				}
			}

			$query = substr($query, 0, -(strlen($operand) + 2));

		} else {
			$query = substr($query, 0, -7);
		}

		if ($orderBy != '') {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != '') {
			$query .= ' LIMIT ' . $limit;
		}

		return $this->executeSQL($query);
	}

/**
 * Updates a record in the database based on WHERE.
 *
 * @access public
 * @param mixed $table
 * @param mixed $set
 * @param mixed $where
 * @param string $exclude (default: '')
 * @return bolean Returns `true` on success or `false` on faliure.
 */
	public function update($table, $set, $where, $exclude = '') {
		// Catch Exceptions
		if (trim($table) == '' || !is_array($set) || !is_array($where)) {
			return false;
		}
		if ($exclude == '') {
			$exclude = array();
		}

		array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

		$set = $this->__secureData($set);
		$where = $this->__secureData($where);

		// SET

		$query = "UPDATE `{$table}` SET ";

		foreach ($set as $key => $value) {
			if (in_array($key, $exclude)) {
				continue;
			}
			$query .= "`{$key}` = '{$value}', ";
		}

		$query = substr($query, 0, -2);

		// WHERE

		$query .= ' WHERE ';

		foreach ($where as $key => $value) {
			$query .= "`{$key}` = '{$value}' AND ";
		}

		$query = substr($query, 0, -5);

		return $this->executeSQL($query);
	}

/**
 * 'Arrays' a single result
 *
 * @access public
 * @return array
 */
	public function arrayResult() {
		$this->__arrayedResult = $this->__result->fetch_assoc();
		return $this->__arrayedResult;
	}

/**
 * 'Arrays' multiple result
 *
 * @access public
 * @return array
 */
	public function arrayResults() {
		if ($this->__records == 1) {
			return $this->arrayResult();
		}

		$this->__arrayedResult = array();
		while ($data = $this->__result->fetch_assoc()) {
			$this->__arrayedResult[] = $data;
		}
		return $this->__arrayedResult;
	}

/**
 * 'Arrays' multiple results with a key.
 *
 * @access public
 * @param string $key (default: 'id')
 * @return array
 */
	public function arrayResultsWithKey($key='id') {
		if (isset($this->__arrayedResult)) {
			unset($this->__arrayedResult);
		}
		$this->__arrayedResult = array();
		while ($row = $this->__result->fetch_assoc()) {
			foreach ($row as $theKey => $theValue) {
				$this->__arrayedResult[$row[$key]][$theKey] = $theValue;
			}
		}
		return $this->__arrayedResult;
	}

/**
 * Returns ID of the last `insert`.
 * 
 * @access public
 * @return mixed Table row ID.
 */
	public function lastInsertID() {
		return mysql_insert_id();
	}

/**
 * Return number of rows
 * 
 * @access public
 * @param string The table to be queried.
 * @param string The value to be matched. (default: '')
 * @return int The mumber of rows where conditions are met. 
 */
	public function countRows($from, $where='') {
		$result = $this->select($from, $where, '', '', false, 'AND', 'count(*)');
		return $result["count(*)"];
	}

/**
 * Closes the connections.
 *
 * @access public
 * @return void
 */
	public function closeConnection() {
		if ($this->__databaseLink) {
			$this->__databaseLink->close();
		}
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//-----------------------------------------------------------------------------

/**
 * Connects class to database
 *
 * @access private
 * @param bool Use persistant connection?(default: false)
 * @return boolean
 */
	private function __connect($persistant = false) {
		$this->closeConnection();

		if ($persistant) {
			$this->__databaseLink = new mysqli($this->__hostname, $this->__username, $this->__password);
		} else {
			$this->__databaseLink = new mysqli($this->__hostname, $this->__username, $this->__password);
		}

		if ($this->__databaseLink->connect_error) {
			$this->__lastError = 'Could not connect to server: ' . $this->__databaseLink->connect_error;
			return false;
		}

		if (!$this->__useDB() ) {
			$this->__lastError = 'Could not connect to database: ' . $this->__databaseLink->error;
			return false;
		}
		return true;
	}

/**
 * Select database to use
 *
 * @access private
 * @return boolean
 */
	private function __useDB() {
		if (!$this->__databaseLink->select_db($this->__database)) {
			$this->__lastError = 'Cannot select database: ' . $this->__databaseLink->error;
			return false;
		} else {
			return true;
		}
	}

/**
 * Performs a 'mysql_real_escape_string' on the entire array/string
 *
 * @access private
 * @param array|string Data to be secured.
 * @return array|string The secured Data.
 */
	private function __secureData($data) {
		if (is_array($data)) {
			foreach ($data as $key => $val) {
				if (!is_array($data[$key])) {
					$data[$key] = $this->__databaseLink->real_escape_string($data[$key]);
				}
			}
		} else {
			$data = $this->__databaseLink->real_escape_string($data);
		}
		return $data;
	}

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for MySQL::$__lastError.
 *
 * @access public
 * @param mixed Value for MySQL::$__lastError to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__lastError.
 */
	public function lastError($value = null) {
		if (func_num_args() > 0) {
			$this->__lastError = $value;
		} else {
			return $this->__lastError;
		}
	}

/**
 * Getter/Setter for MySQL::$__lastQuery.
 *
 * @access public
 * @param mixed Value for MySQL::$__lastQuery to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__lastQuery.
 */
	public function lastQuery($value = null) {
		if (func_num_args() > 0) {
			$this->__lastQuery = $value;
		} else {
			return $this->__lastQuery;
		}
	}

/**
 * Getter/Setter for MySQL::$__result.
 *
 * @access public
 * @param mixed Value for MySQL::$__result to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__result.
 */
	public function result($value = null) {
		if (func_num_args() > 0) {
			$this->__result = $value;
		} else {
			return $this->__result;
		}
	}

/**
 * Getter/Setter for MySQL::$__records.
 *
 * @access public
 * @param mixed Value for MySQL::$__records to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__records.
 */
	public function records($value = null) {
		if (func_num_args() > 0) {
			$this->__records = $value;
		} else {
			return $this->__records;
		}
	}

/**
 * Getter/Setter for MySQL::$__affected.
 *
 * @access public
 * @param mixed Value for MySQL::$__affected to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__affected.
 */
	public function affected($value = null) {
		if (func_num_args() > 0) {
			$this->__affected = $value;
		} else {
			return $this->__affected;
		}
	}

/**
 * Getter/Setter for MySQL::$__rawResults.
 *
 * @access public
 * @param mixed Value for MySQL::$__rawResults to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__rawResults.
 */
	public function rawResults($value = null) {
		if (func_num_args() > 0) {
			$this->__rawResults = $value;
		} else {
			return $this->__rawResults;
		}
	}

/**
 * Getter/Setter for MySQL::$__arrayedResult.
 *
 * @access public
 * @param mixed Value for MySQL::$__arrayedResult to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__arrayedResult.
 */
	public function arrayedResult($value = null) {
		if (func_num_args() > 0) {
			$this->__arrayedResult = $value;
		} else {
			return $this->__arrayedResult;
		}
	}

/**
 * Getter/Setter for MySQL::$__hostname.
 *
 * @access public
 * @param mixed Value for MySQL::$__hostname to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__hostname.
 */
	public function hostname($value = null) {
		if (func_num_args() > 0) {
			$this->__hostname = $value;
		} else {
			return $this->__hostname;
		}
	}

/**
 * Getter/Setter for MySQL::$__username.
 *
 * @access public
 * @param mixed Value for MySQL::$__username to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__username.
 */
	public function username($value = null) {
		if (func_num_args() > 0) {
			$this->__username = $value;
		} else {
			return $this->__username;
		}
	}

/**
 * Getter/Setter for MySQL::$__password.
 *
 * @access public
 * @param mixed Value for MySQL::$__password to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__password.
 */
	public function password($value = null) {
		if (func_num_args() > 0) {
			$this->__password = $value;
		} else {
			return $this->__password;
		}
	}

/**
 * Getter/Setter for MySQL::$__database.
 *
 * @access public
 * @param mixed Value for MySQL::$__database to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__database.
 */
	public function database($value = null) {
		if (func_num_args() > 0) {
			$this->__database = $value;
		} else {
			return $this->__database;
		}
	}

/**
 * Getter/Setter for MySQL::$__databaseLink.
 *
 * @access public
 * @param mixed Value for MySQL::$__databaseLink to be set to.
 * @return mixed If no parameter are passed it returns the current value for MySQL::$__databaseLink.
 */
	public function databaseLink($value = null) {
		if (func_num_args() > 0) {
			$this->__databaseLink = $value;
		} else {
			return $this->__databaseLink;
		}
	}

} //end Class
