<?php
/**
 *  The file that contains the Controller base class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson
 * @version $Id$
 * @since 8/13/13
 * @package CoreAPI/Controllers
 */

/**
 * Controller Base class
 *
 * @package CoreAPI/Controllers
 */
class Controller {

	protected $_viewDirectory;

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * Constructor
 * 
 * @access public
 * @return void
 */
	public function __construct() {
		$this->_viewDirectory = COREAPI_ROOT . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
	}

/**
 * Renders view.
 * 
 * @access protected
 * @param array|object optional An array or an object of values to be passed to the view for rendering.
 * @param string optional The absolute location of the view file. 
 * @return void
 */
	protected function _render($variables = null , $file = null) {
		if (is_null($file)) {
			$callingClass = get_class($this);
			$file = $this->_viewDirectory . $callingClass . '.view.php';
		}

		if (is_array($variables)) {
			extract($variables);
		} elseif ( is_object($variables)) {
			extract(get_object_vars($variables));
		}

		ob_start();
		include $file;
		$renderedView = ob_get_clean();

		return $renderedView;
	}

} //end view