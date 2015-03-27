<?php
/**
 *  The file that contains the Cache class
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 11/21/12
 * @package CoreAPI/WebTools
 */

/**
 * The Cache class creates a cached copy of the finished script, writes it to a file and the 
 * compaires the fressness of the cache to the cache time. The cache directory needs to be
 * writable by apache and php. 
 *
 * **Example:**
 * <code>
 * // Make a unique filename for the cache file.
 * $cache_file = getcwd().'/cached/'.md5($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']).'_'.basename(__FILE__);
 *
 * // Start caching the page. 
 * $cache = new Cache( $cache_file, 18000 ); 
 *
 * <!--PHP\Html Stuff Here -->
 *
 * $cache->end();
 * </code>
 *
 * @package CoreAPI/WebTools
 * @todo Bring up to current coding standards. 
 */
class Cache {
	/** The location of the cache file. */
	private $cacheFile = NULL;

	/**
	 * Creates a Cache object and begins the caching of the page.  If a fresh cached page exhiste it loads it.
	 * 
	 * **Overide Options**
	 * |------------------------------------------------------------------------|
	 * | Option		| Description 												|
	 * |------------------------------------------------------------------------|
	 * | cache 		| Forces the us of exhisting cached file if one exists. 	|
	 * | refresh	| Forces a refresh of the cashe even if a fresh file exists.|
	 *
	 * @param string The full filename and location. Ex: /webroot/Cache/cachefile.php
	 * @param int The cachetime in seconds.
	 * @param string Overides the default value. 
	 * @return void
	 */
	function __construct( $cachefile, $cachetime = 18000, $overide = false) {
		if( is_string($cachefile) ){
			$this->cacheFile = $cachefile;
		}else{
			throw new Exception('Invalid file argument, expecting string. ');
		}
		
		// Check if the cached file is still fresh. If it is, serve it up and exit.
		if ( file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile) || $overide === 'cache' ) && $overide !== 'refresh' ) {
			readfile( $cachefile );
			exit;
		}
		// if there is either no file OR the file to too old, render the page and capture the HTML.
		ob_start();

	}

	/**
	 * If no parameters are passed it returns the current value for Cache::$cacheFile, or set the it to the passed param.
	 * 
	 * @param string $file The full filename and location. Ex: /webroot/Cache/cachefile.php
	 * @return bool|string Returns TRUE if the value is sucessfuly set, returns current value or FALSE on failure. 
	 * @note You probally don't want to change the cache file after inital creation. 
	 */
	public function cacheFile( $file = null) {
		if ( $file === null ) {
			return $this->cacheFile;
		}elseif ( is_scalar( $file ) ) {
			$this->cacheFile;
			return TRUE;
		}else{
			return FALSE;
		}
	}


	/**
	 * Writes the cache file and prints the outputs the finished script results.
	 * 
	 * **REQUIRED** for page to load correctly!!
	 * @return void
	 */
	public function end() {
		if ( file_put_contents( $this->cacheFile, ob_get_contents() ) === FALSE ) {
			throw new Exception( "Unable to write cache file." );
		}

		// finally send browser output
		ob_end_flush();
	}

}//end class
