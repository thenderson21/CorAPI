<?php
/**
 *
 *
 *
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson
 * @version $Id$
 * @since 7/15/13
 * @package CoreAPI/Libraries/DataExchange
 */

/**
 * Personify integration class.
 *
 * @package CoreAPI/Libraries/DataExchange
 * @todo Needs to be finished.
 */
class Personify {

	private $__userID;

	private $__disciplines = null;

	private $__userServiceUrl = 'http://insideqa.spe.org/jws/rs/x/login/customer/';

	private $__userServiceUrlDisciplin = '/disciplines';

	private $__defaultCurlOptions = array(
			CURLOPT_HTTPHEADER => array('Accept: application/json')
		);

/**
 * Class Constructor.
 *
 * @access public
 * @param string The personify User Id.
 * @return void
 */
	public function __construct($userID) {
		$this->__userID = $userID;
	}

/**
 * Gets the diciplins by user id.
 *
 * @access public
 * @return object Returns requested personify object.
 */
	public function getDisciplines() {
		$curlRequest = new Curl($webServiceURL, $curlOptions);
		return json_decode($curlRequest->body());
	}

/**
 * Getter/Setter for Personify::$__userID.
 *
 * @access public
 * @param mixed Value for Personify::$__userID to be set to.
 * @return mixed If no parameter are passed it returns the current value for Personify::$__userID.
 */
	public function userID($value = null) {
		if (func_num_args() > 0) {
			$this->__userID = $value;
		} else {
			return $this->__userID;
		}
	}

/**
 * Getter/Setter for Personify::$__disciplines.
 *
 * @access public
 * @param mixed Value for Personify::$__disciplines to be set to.
 * @return mixed If no parameter are passed it returns the current value for Personify::$__disciplines.
 */
	public function disciplines($value = null) {
		if (func_num_args() > 0) {
			$this->__disciplines = $value;
		} else {
		if (is_null($this->__disciplines)) {
				$webServiceURL = $this->__userServiceUrl . $this->__userID . $this->__userServiceUrlDisciplin;
				$curlRequest = new Curl($webServiceURL, $this->__defaultCurlOptions);
				if (! $curlRequest->errno()) {
					$this->__disciplines = json_decode($curlRequest->body());
				}
		}
			return $this->__disciplines;
		}
	}

/**
 * Getter/Setter for Personify::$__userServiceUrl.
 *
 * @access public
 * @param mixed Value for Personify::$__userServiceUrl to be set to.
 * @return mixed If no parameter are passed it returns the current value for Personify::$__userServiceUrl.
 */
	public function userServiceUrl($value = null) {
		if (func_num_args() > 0) {
			$this->__userServiceUrl = $value;
		} else {
			return $this->__userServiceUrl;
		}
	}

/**
 * Getter/Setter for Personify::$__userServiceUrlDisciplin.
 *
 * @access public
 * @param mixed Value for Personify::$__userServiceUrlDisciplin to be set to.
 * @return mixed If no parameter are passed it returns the current value for Personify::$__userServiceUrlDisciplin.
 */
	public function userServiceUrlDisciplin($value = null) {
		if (func_num_args() > 0) {
			$this->__userServiceUrlDisciplin = $value;
		} else {
			return $this->__userServiceUrlDisciplin;
		}
	}

/**
 * Getter/Setter for Personify::$__defaultCurlOptions.
 *
 * @access public
 * @param mixed Value for Personify::$__defaultCurlOptions to be set to.
 * @return mixed If no parameter are passed it returns the current value for Personify::$__defaultCurlOptions.
 */
	public function defaultCurlOptions($value = null) {
		if (func_num_args() > 0) {
			$this->__defaultCurlOptions = $value;
		} else {
			return $this->__defaultCurlOptions;
		}
	}

}//end class