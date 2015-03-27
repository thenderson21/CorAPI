<?php
/**
 * The file that contains the Debug class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/25/12
 * @package CoreAPI/Libraries/Debugging
 */

/**
 * Debug class contains usefule debugging methods and varriables.
 *
 * @package CoreAPI/Libraries/Debugging
 */
class Debug {

	/** @var int The initial timer time measure from UNIX Epoch */
	public static $startTime;

	/** @var int The amount of time in miliseconds that the timer was paused . */
	public static $pauseTime;

	/** @var array Marks for benchmarking and debuging. */
	public static $marks;

	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//------------------------------------------------------------------------------

/**
 * Debug helper function. This is a wrapper for var_dump() that adds
 * the <pre /> tags, cleans up newlines and indents, and runs
 * htmlentities() before output.
 *
 * **Example:**
 * ````
 * $arr = array('One' = 1);
 *
 * Debug::dump($var);
 * ````
 * @param mixed The variable to dump.
 * @param string Label to prepend to output.
 * @param boolean Print the output if true.
 * @param boolean Exit after echoing if true.
 */
	public static function dump($var, $label = null, $print = true, $exit = false) {
		// format the label
		$labelText = $label;
		$label = ($label === null) ? '' : '<h2 style="margin: 0px">' . trim($label) . '</h2>';

		// var_dump the variable into a buffer and keep the output
		ob_start();
		var_dump($var);
		$output = ob_get_clean();

		// neaten the newlines and indents
		$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

		if (is_array($var)) {
			$keys = ArrayTools::arrayKeysMulti($var);
			$maxlen = 0;

			// determine the number of characters in the longest key
			foreach ($keys as $key) {
				$len = strlen($key);
				if ($len > $maxlen) {
					$maxlen = $len;
				}
			}

			// account for [" and "]
			$maxlen += 4;

			// append spaces between "] and =>
			$output = preg_replace_callback('/\[.*\]/', create_function('$matches', 'return str_pad($matches[0], ' . $maxlen . ');'), $output);
		}

		if (PHP_SAPI == 'cli') {
			$output = PHP_EOL . $labelText . PHP_EOL . $output . PHP_EOL;
		} else {
			if (!extension_loaded('xdebug')) {
				$output = htmlspecialchars($output, ENT_QUOTES);
			}

			$output = '<pre style="font-family: \'Courier New\'; font-size: 11px; background-color: #FBFED7; margin: 5px auto; padding: 10px; border: 1px solid #CCCCCC; max-width: 1000px;">' . $label . $output . '</pre>';
		}

		if ($print === true && $exit === true) {
			print $output;
			exit;
		} elseif ($print === true && $exit !== true) {
			print $output;
		} else {
			return $output;
		}

		if ($exit === true) {
			exit;
		}
	}

/**
 * Debug helper function. This is a wrapper for print_r() that adds
 * the <pre /> tags, cleans up newlines and indents, and runs
 * htmlentities() before output.
 *
 * **Example:**
 * ````
 * $arr = array('One' = 1);
 *
 * Debug::printR($var);
 * ````
 * @param mixed The variable to dump.
 * @param string Label to prepend to output.
 * @param boolean Print the output if true.
 * @param boolean Exit after echoing if true.
 */
	public static function printR($var, $label = null, $print = true, $exit = false) {
		// format the label
		$labelText = $label;
		$label = ($label === null) ? '' : '<h2 style="margin: 0px">' . trim($label) . '</h2>';

		// var_dump the variable into a buffer and keep the output
		ob_start();
		print_r($var);
		$output = ob_get_clean();

		// neaten the newlines and indents
		//$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

		if (is_array($var)) {
			$keys = ArrayTools::arrayKeysMulti($var);
			$maxlen = 0;

			// determine the number of characters in the longest key
			foreach ($keys as $key) {
				$len = strlen($key);
				if ($len > $maxlen) {
					$maxlen = $len;
				}
			}

			// account for [" and "]
			$maxlen += 4;

			// append spaces between "] and =>
			$output = preg_replace_callback('/\[.*\]/', create_function('$matches', 'return str_pad($matches[0], ' . $maxlen . ');'), $output);
		}

		if (PHP_SAPI == 'cli') {
			$output = PHP_EOL . $labelText . PHP_EOL . $output . PHP_EOL;
		} else {
			if (!extension_loaded('xdebug')) {
				$output = htmlspecialchars($output, ENT_QUOTES);
			}

			$output = '<pre style="font-family: \'Courier New\'; font-size: 11px; background-color: #FBFED7; margin: 5px auto; padding: 10px; border: 1px solid #CCCCCC; max-width: 1000px;">' . $label . $output . '</pre>';
		}

		if ($print === true && $exit === true) {
			print $output;
			exit;
		} elseif ($print === true && $exit !== true) {
			print $output;
		} else {
			return $output;
		}

		if ($exit === true) {
			exit;
		}
	}

	//------------------------------------------------------------------------------
	//!	 Script Timing/Benchmarking Methods
	//------------------------------------------------------------------------------

/**
 * Starts the timer.
 *
 * **Example:**
 * ````
 * Debug::start(__METHOD__); //Starts the timer.
 * ````
 * @param string A short descriptive representation of marker location. ex: __METHOD__
 */
	public static function start($method = null) {
		self::$marks = null;
		self::$startTime = null;
		self::$startTime = self::getTime();
		self::$pauseTime = 0;

		$trace = debug_backtrace();

		//unset(self::$marks);

		if (!$method) {
			self::$marks[] = (object)array('time' => self::$startTime, 'trace' => $trace);
		} else {
			self::$marks[] = (object)array('time' => self::$startTime, 'method' => $method, 'trace' => $trace);
		}
	}

/**
 * Pauses the timer.
 *
 * **Example:**
 * ````
 * Debug::start(); //Starts the timer.
 *
 * Debug::pause(); //Pauses the timer.
 * ````
 * @return void
 */
	public static function pause() {
		self::$pauseTime = self::getTime();
	}

/**
 * Un-pauses the timer.
 *
 * **Example:**
 * ````
 * Debug::start(); //Starts the timer.
 *
 * Debug::pause(); //Pauses the timer.
 *
 * Debug::unpause(); //Restarts the timer.
 * ````
 * @return void
 */
	public static function unpause() {
		self::$startTime += (self::getTime() - self::$pauseTime);
		self::$pauseTime = 0;
	}

/**
 * Get the current timer value in miliseconds rounded to a specified decimal point.
 *
 * **Example:**
 * ````
 * Debug::start(); //Starts the timer.
 *
 * echo Debug::get(); //Prints 1.311E-5.
 * ````
 * @param int An integer representing how many decimal placed to round to. (default: 8)
 * @return int Current timer value in miliseconds.
 */
	public static function getTimer($decimals = 8) {
		return round((self::getTime() - self::$startTime), $decimals);
	}

/**
 * Get the current timer value in seconds.
 *
 * **Example:**
 * ````
 * Debug::start(); //Starts the timer.
 *
 * echo Debug::getTime(); //Prints 1353085737.6486
 * ````
 * @return float Current timer value in seconds.
 */
	public static function getTime() {
		list($usec, $sec) = explode(' ', microtime());
		return (float)$usec + (float)$sec;
	}

/**
 * Records debuging information at given location;
 *
 * @param string A short descriptive representation of marker location. ex: __METHOD__
 */
	public static function mark($method = null) {
		$trace = debug_backtrace();
		$time = self::getTime();

		if (!$method) {
			self::$marks[] = (object)array('time' => $time, 'trace' => $trace);
		} else {
			self::$marks[] = (object)array('time' => $time, 'method' => $method, 'trace' => $trace);
		}
	}

/**
 * Outputs the all markes in human readabe format (kinda).
 *
 * @return void
 */
	public static function dumpMarks() {
		if (PHP_SAPI !== 'cli') {
			echo '<pre style="font-family: \'Courier New\'; font-size: 11px; background-color: #FBFED7; margin: 5px auto; padding: 10px; border: 1px solid #CCCCCC; max-width: 1000px;">';
		}

		var_dump(self::$marks);

		if (PHP_SAPI !== 'cli') {
			echo "</pre>";
		}
	}

/**
 * Outputs the all times in human readable format (kinda).
 *
 * @return void
 */
	public static function dumpTimes() {
		if (PHP_SAPI !== 'cli') {
			echo '<div class="debugging"><pre style="font-family: \'Courier New\'; font-size: 11px; background-color: #FBFED7; margin: 5px auto; padding: 10px; border: 1px solid #CCCCCC; max-width: 1000px;">';
		}
		$lastMark = self::$startTime;
		foreach (self::$marks as $key => $mark) {
			$markFile = $mark->trace[0]['file'];
			$markLine = $mark->trace[0]['line'];
			$markTime = $mark->time;
			$ElapsedTimeStart = $markTime - self::$startTime;

			if ($key === 0) {
				if (isset($mark->method) && !is_null($mark->method)) {
					echo $mark->method . " \n";
				}
				echo "Debugger Started: in $markFile on line $markLine at $markTime sec.\n\n";
			} else {

				if (isset($mark->method) && !is_null($mark->method)) {
					echo "\t" . $mark->method . " \n";
				}

				echo "\tMark[$key]: in $markFile on line $markLine at $markTime sec.\n";

				if ($key === 1) {
					echo "\tElapsed time from start: $ElapsedTimeStart sec.\n\n";
				} else {
					$ElapsedTimeMark = $markTime - $lastMark;
					echo "\tElapsed time from start: $ElapsedTimeStart sec. Since Last Mark: $ElapsedTimeMark sec.\n\n";
				}
			}
			$lastMark = $mark->time;
		}
		if (PHP_SAPI !== 'cli') {
			echo "</pre></div>";
		}
	}

}//end class