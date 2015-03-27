<?php
/**
 * The common.ini.php file contains the function and methods used by the CoreAPI.
 * It should be required when using the CoreAPI.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/13/13
 * @package CoreAPI
 */
 
 //Setup if not all ready included.
if (! defined('COREAPI')){
	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'constants.ini.php');
	
	/**
	 * Magic function that attempt to load undefined class.
	 *
	 * @param string The name of class load.
	 * @return void
	 */
	function coreAPI_autoload($class) {
		$dirPath = COREAPI_ROOT;
		//class directories
		$directorys = array(
			$dirPath . DIRECTORY_SEPARATOR . 'Libraries',
			$dirPath . DIRECTORY_SEPARATOR . 'Models',
			$dirPath . DIRECTORY_SEPARATOR . 'Controllers',
			$dirPath . DIRECTORY_SEPARATOR . 'Views'
		);
		if (strpos($class, "\\") !== false) {
			$namespaced = explode("\\", $class);
			$class = end($namespaced);
		}
		//for each directory
		foreach ($directorys as $directory) {
			//see if the file exsists
			if (is_file($directory . DIRECTORY_SEPARATOR . $class . '.class.php')) {
				require_once $directory . DIRECTORY_SEPARATOR . $class . '.class.php';
				//Only require the class once, so quit after to save effort, if you have more, then name them something else.
				return;
			}
		}
	}
	
	spl_autoload_register('coreAPI_autoload');
}