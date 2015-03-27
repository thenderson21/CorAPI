<?php
/**
 * The file that contains the Console class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/25/12
 * @package CoreAPI/Debug
 */

/**
 * Console class sends a message to the browser console log.
 *
 * @package CoreAPI/Debug
 * @todo Make work.
 * @todo Bring up to current coding standards.
 */
class Console {

	protected function __construct() {
		if (!defined("LOG"))    define("LOG", 1);
		if (!defined("INFO"))   define("INFO", 2);
		if (!defined("WARN"))   define("WARN", 3);
		if (!defined("ERROR"))  define("ERROR", 4);

		/* @todo Find better solution for Defining NL */
		define("NL", "\r\n");
		echo '<script type="text/javascript">'.NL;

		/// this is for IE and other browsers w/o console
		echo 'if (!window.console) console = {};';
		echo 'console.log = console.log || function(){};';
		echo 'console.warn = console.warn || function(){};';
		echo 'console.error = console.error || function(){};';
		echo 'console.info = console.info || function(){};';
		echo 'console.debug = console.debug || function(){};';
		echo '</script>'.NL;
		/// end of IE
	}

	public static function log($name, $var = null, $type = LOG) {
		$console = new static();	
			
		echo '<script type="text/javascript">'.NL;
		switch ($type) {
		case LOG:
			echo 'console.log("'.$name.'");'.NL;
			break;
		case INFO:
			echo 'console.info("'.$name.'");'.NL;
			break;
		case WARN:
			echo 'console.warn("'.$name.'");'.NL;
			break;
		case ERROR:
			echo 'console.error("'.$name.'");'.NL;
			break;
		}

		if (!empty($var)) {
			if (is_object($var) || is_array($var)) {
				$object = json_encode($var);
				echo 'var object'.preg_replace('~[^A-Z|0-9]~i', "_", $name).' = \''.str_replace("'", "\'", $object).'\';'.NL;
				echo 'var val'.preg_replace('~[^A-Z|0-9]~i', "_", $name).' = eval("(" + object'.preg_replace('~[^A-Z|0-9]~i', "_", $name).' + ")" );'.NL;
				switch ($type) {
				case LOG:
					echo 'console.debug(val'.preg_replace('~[^A-Z|0-9]~i', "_", $name).');'.NL;
					break;
				case INFO:
					echo 'console.info(val'.preg_replace('~[^A-Z|0-9]~i', "_", $name).');'.NL;
					break;
				case WARN:
					echo 'console.warn(val'.preg_replace('~[^A-Z|0-9]~i', "_", $name).');'.NL;
					break;
				case ERROR:
					echo 'console.error(val'.preg_replace('~[^A-Z|0-9]~i', "_", $name).');'.NL;
					break;
				}
			} else {
				switch ($type) {
				case LOG:
					echo 'console.debug("'.str_replace('"', '\\"', $var).'");'.NL;
					break;
				case INFO:
					echo 'console.info("'.str_replace('"', '\\"', $var).'");'.NL;
					break;
				case WARN:
					echo 'console.warn("'.str_replace('"', '\\"', $var).'");'.NL;
					break;
				case ERROR:
					echo 'console.error("'.str_replace('"', '\\"', $var).'");'.NL;
					break;
				}
			}
		}
		echo '</script>'.NL;
	}
}//end Class