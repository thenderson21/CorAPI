<?php
/**
 * File containing the CsvFeed class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 05/28/2013
 * @package CoreAPI/Libraries/DataExchange
 * @note Passed CakePHP styleguide on 05/29/2013.
 */

/**
 * Class for retrieving and processing csv feeds.
 *
 * @package CoreAPI/Libraries/DataExchange
 */
class CsvFeed implements ArrayAccess, Iterator {

	/** @var array The container array for the parsed csv string.*/
	private $__container = array();

	/** @var int The current position in the container array. Used for array access and Iteration. */
	private $__position = 0;

/**
 * Retrieves a csv file from a url then processes it into an array.  Assuming the first line is the 
 * column template.  
 *
 * **Example**
 * <code>
 * $csv_feed = new CsvFeed('http://example.com/test.txt');
 * 
 * foreach ($csv_feed as $key => $value){
 *   echo 'Key: ' + $key + "\n";
 *   var_dump($value);
 * }
 *</code>
 *
 * @access public
 * @param string 
 * @return void
 */
	public function __construct($url = '') {
		$this->__position = 0;

		if ($url !== '') {
			$ableCommerceCSV = $this->_curl($url);

			$temp = explode( $this->_newlineType($ableCommerceCSV), $ableCommerceCSV);

			foreach ($temp as $key => $value) {
				$tempArray = str_getcsv( $value , ',' , '"');

				if (! empty($value)) {
					if ($key === 0) {
						$arrayKeys = $tempArray;
					} else {
						foreach ($tempArray as $subKey => $subValue) {

							if ( is_numeric($subValue)) {
								if (ctype_digit($subValue)) {
									$this->__container[$key - 1][$arrayKeys[$subKey]] = (int)$subValue;
								} else {
									$this->__container[$key - 1][$arrayKeys[$subKey]] = (float)$subValue;
								}
							} else {
								$this->__container[$key - 1][$arrayKeys[$subKey]] = trim($subValue);
							}
						}
					}
				}
			}
		}
	}

/**
 * Assigns a value to the specified offset.
 * 
 * @access public
 * @param mixed The offset to assign the value to.
 * @param mixed The value to set.
 * @return void
 */
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->__container[] = $value;
		} else {
			$this->__container[$offset] = $value;
		}
	}

/**
 * Whether or not an offset exists.
 *
 * This method is executed when using isset() or empty() on objects implementing ArrayAccess.
 * 
 * @note When using empty() CsvFeed::offsetGet() will be called and checked if empty only if CsvFeed::offsetExists() returns TRUE.
 * @access public
 * @param mixed An offset to check for.
 * @return void
 */
	public function offsetExists($offset) {
		return isset($this->__container[$offset]);
	}

/**
 * Unsets an offset.
 * 
 * @note This method will not be called when type-casting to (unset) 
 * @access public
 * @param mixed The offset to unset.
 * @return void
 */
	public function offsetUnset($offset) {
		unset($this->__container[$offset]);
	}

/**
 * Returns the value at specified offset.
 *
 * This method is executed when checking if offset is empty().
 * 
 * @access public
 * @param mixed The offset to retrieve. 
 * @return void
 */
	public function offsetGet($offset) {
		return isset($this->__container[$offset]) ? $this->__container[$offset] : null;
	}

/**
 * Rewinds back to the first element of the Iterator
 * 
 * @access public
 * @return void
 */
	public function rewind() {
		$this->__position = 0;
	}

/**
 * Returns the current element.
 * 
 * @access public
 * @return mixed Can return any type.
 */
	public function current() {
		return $this->__container[$this->__position];
	}

/**
 * Returns the key of the current element.
 * 
 * @access public
 * @return scalar Returns scalar on success, or NULL on failure.
 */
	public function key() {
		return $this->__position;
	}

/**
 * Moves the current position to the next element.
 *
 * @note This method is called after each foreach loop.
 * @access public
 * @return void
 */
	public function next() {
		++$this->__position;
	}

/**
 * Checks if current position is valid. 
 *
 * @access public
 * @return boolean The return value will be casted to boolean and then evaluated. Returns TRUE on success or FALSE on failure.
 */
	public function valid() {
		return isset($this->__container[$this->__position]);
	}

/**
 * Detects the newline character of a given string.
 *
 * @param mixed The input string.
 * @return mixed Returns a string of the detected newline character or FALSE if unable to determin newline.
 */
	protected function _newlineType($string) {
		$winNewLine = "\r\n";	// \r\n
		$macNewLine = "\r";		// \r only
		$unixNewLine = "\n";	// \n only

		if (strpos($string, $winNewLine) !== false) {
			return $winNewLine;
		} elseif (strpos($string, $winNewLine) !== false) {
			return $winNewLine;
		} elseif (strpos($string, $unixNewLine) !== false) {
			return $unixNewLine;
		} else {
			return false;
		}
	}

/**
 * Send a web requst using curl
 *
 * @throws Exception 
 * @param string Url to request
 * @return string Results of the curl.
 */
	protected function _curl($url) {
		$timeout = 1000;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		if ( isset($accepts) ) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $accepts);
		}

		$data = curl_exec($ch);		// run curl and retrieve data;
		$response = curl_getinfo( $ch );

		curl_close($ch);	//clean us curl
		if ($response['http_code'] == 301) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $response['redirect_url'] );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			if ( isset($accepts) ) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $accepts);
			}

			$data = curl_exec($ch);	// runn curl and retrieve data;
			$response = curl_getinfo( $ch );

			curl_close($ch);	//clean us curl
		}

		if ($data == false || $response['http_code'] != 200) {
			if ( $response['http_code'] != 200 ) {
				throw new Exception('HTML Response Code: ' . $response['http_code']);
			} else {
				throw new Exception(curl_error($ch));
			}
		}
		return $data;
	}

}//end class