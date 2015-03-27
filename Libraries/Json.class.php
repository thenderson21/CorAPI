<?php
/**
 * Class file for JsonHandler class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id
 * @since 10/19/12
 * @package CoreAPI/Libraries/DataInterchange
 */

/**
 * JsonHandler class contain methods parcing json statements.
 *
 * @package CoreAPI/Libraries/DataInterchange
 */
class Json {


	/** @var array Contains an array of the standard errors that json_last_error() returns.  */
	protected static $_messages = array(
		JSON_ERROR_NONE => 'No error has occurred',
		JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
		JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON',
		JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
		JSON_ERROR_SYNTAX => 'Syntax error',
		JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
	);



/**
 * Returns a string containing the JSON representation of `$value`.
 *
 * @static
 * @note This function only works with UTF-8 encoded data.
 * @param mixed The value being encoded. Can be any type except a resource.
 * @param int $options (default: 0)
 * @return string|boolean Returns a JSON encoded string on success or `false` on failure.
 */
	public static function encode($value, $options = 0) {
		$result = json_encode($value, $options);

		if ($result) {
			return $result;
		}
		throw new Exception(static::$_messages[json_last_error()]);
	}

/**
 * Takes a JSON encoded string and converts it into a PHP variable.
 * 
 * @static
 * @param mixed $json
 * @param bool $assoc (default: false)
 * @return mixed Returns the value encoded in json in appropriate PHP type.
 * Values `true`, `false` and `null` (case-insensitive) are returned as `TRUE`, `FALSE` and `NULL` respectively.
 * `NULL` is returned if the json cannot be decoded or if the encoded data is deeper than the recursion limit.
 */
	public static function decode($json, $assoc = false) {
		$result = json_decode($json, $assoc);

		if ($result) {
			return $result;
		}

		if ( static::$_messages[json_last_error()] != JSON_ERROR_NONE ) {
			throw new Exception(static::$_messages[json_last_error()]);
		}

	}

}
?>
