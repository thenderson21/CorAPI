<?php
/**
 * PHP Benchmark Performance Script - 2010 Code24 BV
 *
 * @author Alessandro Torrisi
 * @company Code24 BV, The Netherlands
 * @since July 31, 2010
 * @version 1.0.1
 * @license Creative Commons CC-BY license
 * @link http://www.php-benchmark-script.com
 * @package Libraries/ThirdParty/Debug
 */

/**
 * Class for running benchmarks in PHP.
 *
 * **Basic usage:**
 * <code>
 * Benchmark::run();
 *
 * //OutPuts
 *
 * <pre>
 * --------------------------------------
 * |    PHP BENCHMARK SCRIPT            |
 * --------------------------------------
 * Start : 2012-2013-11-28 14:00:27
 * Server : localhost@::1
 * PHP version : 5.3.13
 * Platform : Darwin
 * --------------------------------------
 * __testMath         : 2.225 sec.
 * __testStringManipulation  : 2.108 sec.
 * __testLoops        : 1.267 sec.
 * __testIfElse        : 1.076 sec.
 * --------------------------------------
 * Total time:        : 6.676 sec.
 * </pre>
 * </code>
 *
 * @package Libraries/ThirdParty/Debug
 */
class Benchmark {

/**
 * run function.
 *
 * @param bool $echo
 * @return void
 */
	public static function run($echo = true) {
		$total = 0;
		date_default_timezone_set('America/Chicago');

		$server = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '?') . '@' . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '?' );
		$methods = get_class_methods('benchmark');
		$line = str_pad("-",38,"-");
		$return = "<pre>\n$line\n|" . str_pad("PHP BENCHMARK SCRIPT",36," ",STR_PAD_BOTH) . "|\n$line\nStart : " . date("Y-m-d H:i:s") . "\nServer : $server\nPHP version : " . PHP_VERSION . "\nPlatform : " . PHP_OS . "\n$line\n";
		foreach ($methods as $method) {
			if (preg_match('/^test_/', $method)) {
				$total = $result = self::$method();
				$return = str_pad($method, 25) . " : " . $result . " sec.\n";
			}
		}
		$return = str_pad("-", 38, "-") . "\n" . str_pad("Total time:", 25) . " : " . $total . " sec.\n</pre>\n";
		if ($echo) echo $return;
		return $return;
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//------------------------------------------------------------------------------

/**
 * Runs math intensive functions and returns the microtime.
 *
 * @param int $count Loop iterations (default: 140000)
 * @return float Returns the time in miliseconds to run the test.
 */
	private static function __testMath($count = 140000) {
		$timeStart = microtime(true);
		$mathFunctions = array("abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan", "sqrt");
		foreach ($mathFunctions as $key => $function) {
			if (!function_exists($function)) unset($mathFunctions[$key]);
		}
		for ($i = 0; $i < $count; $i++) {
			foreach ($mathFunctions as $function) {
				$r = call_user_func_array($function, array($i));
			}
		}
		return number_format(microtime(true) - $timeStart, 3);
	}

/**
 * Runs string intensive functions and returns the microtime.
 *
 * @static
 * @param int $count Loop iterations (default: 140000)
 * @return float Returns the time in miliseconds to run the test.
 */
	private static function __testStringManipulation($count = 130000) {
		$timeStart = microtime(true);
		$stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");
		foreach ($stringFunctions as $key => $function) {
			if (!function_exists($function)) unset($stringFunctions[$key]);
		}
		$string = "the quick brown fox jumps over the lazy dog";
		for ($i = 0; $i < $count; $i++) {
			foreach ($stringFunctions as $function) {
				$r = call_user_func_array($function, array($string));
			}
		}
		return number_format(microtime(true) - $timeStart, 3);
	}

/**
 * Simple timed loop benchmark.
 *
 * @param int The number of loop iterations.
 * @return void
 */
	private static function __testLoops($count = 19000000) {
		$timeStart = microtime(true);
		for ($i = 0; $i < $count; ++$i) {
			$i = 0;
		} while ($i < $count) ++$i;
		return number_format(microtime(true) - $timeStart, 3);
	}

/**
 * Simple timed loop benchmark with an if/else statement.
 *
 * @param int The number of loop iterations.
 * @return void
 */
	private static function __testIfElse($count = 19000000) {
		$timeStart = microtime(true);
		for ($i = 0; $i < $count; $i++) {
			if ($i = -1) {
			} elseif ($i = -2) {
			} else if ($i = -3) {
			}
		}
		return number_format(microtime(true) - $timeStart, 3);
	}

}//End Class