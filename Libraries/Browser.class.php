<?php
/**
 * Basic browser information.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @package CoreAPI/WebTools
 */


/**
 * Browser class collects useful information about the users browser.
 *
 * @package CoreAPI/WebTools
 * @todo Bring up to current coding standards.
 */
class Browser {

	/**
	 * Constructs a Browser object.
	 *
	 * @return boolean true if sucessfuly constructed.
	 */
	function __construct() {
		return true;
	}

	//Public Functions

	/**
	 * The getIP function attempts to discover and return the client's browser ip address.
	 *
	 * @return string ip address of clients browser.
	 */
	public static function getIP() {
		return   (isset($_REQUEST['ip']) && !empty($_REQUEST['ip']))? escapeshellcmd(htmlentities($_REQUEST['ip'])) : ((isset($_SERVER['HTTP_X_FORWARDED_FOR']))?  substr($_SERVER['HTTP_X_FORWARDED_FOR'], strrpos($_SERVER['HTTP_X_FORWARDED_FOR'], ' ')) : $_SERVER['REMOTE_ADDR']);

	}

}//end class

?>