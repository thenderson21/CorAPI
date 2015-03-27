<?php
/**
 * StringTools class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/13/13
 * @package CoreAPI/Libraries/Extensions
 */


/**
 * ArrayTools contains useful methods for working with php arrays that are not built into the core php code.
 *
 * @package CoreAPI/Libraries/Extensions
 */
class StringTools {

/**
 * Checks to see if a string begins with a string.
 *
 * @static
 * @param string The string to be searched.
 * @param string The string to be searched for.
 * @return boolean Returns `true` or `false` depending on weather the search string is found at the beginning of the haystack.
 */
	public static function startsWith($haystack, $needle) {
		return strpos($haystack, $needle) === 0;
	}

/**
 * Checks to see if a string contains a given string or an array of strings.
 *
 * @static
 * @param string The string to be searched.
 * @param string|array The string or array of strings to be searched for.
 * @return boolean  Returns `true` or `false` depending on weather the search string is found in the haystack.
 */
	public static function contains($haystack, $needles) {
		if ( is_array($needles) ) {
			foreach ($needles as $needle) {
				if ( stripos($haystack, $needle) !== false) {
					return true;
				}
			}
		} else {
			return stripos($haystack, $needles) !== false;
		}
	}

}//end class
