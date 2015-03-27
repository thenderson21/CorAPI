<?php
/**
 * The file that contains the WebTools class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id
 * @since 9/26/12
 * @package CoreAPI/WebTools
 */

/**
 * WebTools
 *
 * WebTools class contains various tools for ussage in validating web content.
 * @package CoreAPI/WebTools
 * @todo Bring Up to coding standards.
 */
class WebTools {

	/**
	 * Checks to see if a url is valid.
	 *
	 * @static
	 * @param string $url The url to be verified.
	 * @return bool Returns <b>true</b> if the provided url is valid or <b>false</b> if it is not.
	 */
	static public function isValidURL($url) {
		return ( bool )parse_url( $url);
	}

	/**
	 * Removes smarts quotes and such added by Word.
	 *
	 * @param string $text
	 * @return string Returns a string with smart quotes and such removed.
	 */
	public static function sanitizeMSTxt( $text ) {
		$find[] = 'â€œ'; // left side double smart quote
		$find[] = '“';   // left side double smart quote
		$find[] = 'â€';  // right side double smart quote
		$find[] = '”';  // right side double smart quote
		$find[] = 'â€˜'; // left side single smart quote
		$find[] = 'â€™'; // right side single smart quote
		$find[] = 'â€¦'; // elipsis
		$find[] = 'â€”'; // em dash
		$find[] = 'â€“'; // en dash

		$replace[] = '"';
		$replace[] = '"';
		$replace[] = '"';
		$replace[] = '"';
		$replace[] = "'";
		$replace[] = "'";
		$replace[] = "...";
		$replace[] = "-";
		$replace[] = "-";

		return str_replace($find, $replace, $text);
	}


	/**
	 * This method will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
	 *
	 * @static
	 * @param string $separator The string separating the items int the breadcrumb. (default: ' &raquo; ')
	 * @param string $home N(default: 'Home')
	 * @param string $homeDir (default: null)
	 * @return string Returns the string containg a html breadcrumb.
	 */
	public static function breadCrumbs($separator = ' &raquo; ', $home = 'Home', $homeDir = null) {



		// This will build our "base URL" ... Also accounts for HTTPS :)
		if ( $homeDir == null ) {
			// This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
			$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

			// This will build our "base URL" ... Also accounts for HTTPS :)
			$base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
		}else {
			// This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
			$tempPath = explode( $homeDir, parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

			$path = array_filter( explode('/', $tempPath[1] ) );

			$base =  $homeDir;
		}


		// Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
		$breadcrumbs = array("<a href=\"$base\">$home</a>");

		// Find out the index for the last value in our path array
		$last = key( array_slice( $path, -1, 1, TRUE ) );


		// Build the rest of the breadcrumbs
		foreach ($path as $x => $crumb) {
			// Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
			$title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));

			// If we are not on the last index, then display an <a> tag
			if ($x != $last)
				$breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
			// Otherwise, just display the title (minus)
			else
				$breadcrumbs[] = $title;
		}

		// Build our temporary array (pieces of bread) into one big string :)
		return implode($separator, $breadcrumbs);
	}

}//end class