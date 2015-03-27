<?php
/**
 * ArrayTools class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 05/28/2013
 * @package CoreAPI/Libraries/Extensions
 */


/**
 * ArrayTools contains useful methods for working with php arrays that are not built into the core php code.
 *
 * @package CoreAPI/Libraries/Extensions
 */
class ArrayTools {

/**
 * Get list of all keys of a multidimentional array
 *
 * @param array A multidimensional array to extract keys from.
 * @return array
 */
	public static function arrayKeysMulti(array $array) {
		$keys = array();

		foreach ($array as $key => $value) {
			$keys[] = $key;

			if (is_array($array[$key])) {
				$keys = array_merge($keys, self::arrayKeysMulti($array[$key]));
			}
		}

		return $keys;
	}

/**
 * Swaps array element by index.  Only works with numerically, contiguously-indexed arrays.
 *
 * **Example:**
 * ````
 * $arr = array('red', 'green', 'blue', 'yellow');
 *
 * echo implode(',', $arr); // red,green,blue,yellow
 *
 * // Move 'blue' to the beginning
 * $arr = moveValueByIndex($arr, 2, 0);
 *
 * echo implode(',', $arr); // blue,red,green,yellow
 * ````
 * @param array
 * @param integer Use NULL when you want to move the last element.
 * @param integer New index for moved element. Use NULL to push.
 * @return array Newly re-ordered array.
 * @throws Exception
 */
	public static function swapValueByIndex(array $array, $from=null, $to=null) {
		// There is no array, or there are either none or a single entry
		if (null === $array || count($array) < 2) {
			// Nothing to do, just return what we had
			return $array;
		}

		if (null === $from) {
			$from = count($array) - 1;
		}

		if (null === $to) {
			$to = 0;
		}

		if ($to == $from) {
			return $array;
		}

		if (!isset($array[$from])) {
			throw new Exception("Offset $from does not exist.");
		}

		if (!isset($array[$to])) {
			throw new Exception("Offset $to does not exist.");
		}

		if (array_keys($array) != range(0, count($array) - 1)) {
			throw new Exception("Array keys must be numeric and continuously numbered.");
		}

		$value = $array[$from];
		$array[$from] = $array[$to];
		$array[$to] = $value;

		return $array;
	}

/**
 * Checks if a value exists in an array recursivly.
 *
 * @param string The searched value.
 * @param array The array.
 * @return bool Returns TRUE if needle is found in the array, FALSE otherwise.
 */
	public static function inArrayRecursive($needle, $haystack) {
		if (strpos(json_encode($haystack), $needle) !== false) {
			return true;
		} else {
			return false;
		}
	}

/**
 * Checks if a case insensitive string value exists in an array.
 *
 * @param string The searched value.
 * @param array The array.
 * @return bool Returns TRUE if needle is found in the array, FALSE otherwise.
 */
	public static function inArrayNoCase($needle, $haystack) {
		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}

/**
 * Searches the array for a given case insensitive string and returns the corresponding key if successful
 *
 * @param string The searched value.
 * @param array The array.
 * @return mixed Returns the key for needle if it is found in the array, FALSE otherwise.
 * If needle is found in haystack more than once, the first matching key is returned.
 */
	public static function arraySearchNoCase($needle, $haystack) {
		return array_search(strtolower($needle), array_map('strtolower', $haystack));
	}

/**
 * Recursivly searches through and array for a key value pair and return an array of matched arrays.
 *
 * @param array $haystack Array to be searched.
 * @param mixed $key The array key to be matched.
 * @param mixed $value The array value to be mateched.
 * @return array|boolean  Returns an array of matched results or `false` if no key/value pair match is found.
 */
	public static function searchKeyValuePair(array $haystack, $key, $value) {
		$arrIt = new RecursiveIteratorIterator(new RecursiveArrayIterator($haystack));

		foreach ($arrIt as $sub) {
			$subArray = $arrIt->getSubIterator();
			if ($subArray[$key] === $value) {
				$outputArray[] = iterator_to_array($subArray);
			}
		}
		if (isset($outputArray) && ! is_null($outputArray)) {
			return $outputArray;
		} else {
			return false;
		}
	}

}//end class
