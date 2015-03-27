<?php
/**
 *
 *
 *
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 5/29/13
 * @package CoreAPI/Libraries/Security
 */

/**
 *
 *
 * @package CoreAPI/Libraries/Security
 */

class EmetaLogin {

	private $__loginWebServiceUrl = 'https://www.spe.org/jws/rs/x/login';

	private $__postVarUsername = 'se_Username';

	private $__postVarPasswords = 's_Password';

	private $__accepts = array('Accept: application/json');

	private $__cookies = array();

	private $__response;

	private $__message;

	private $__action;

	private $__result;

	private $__actionCode;

	private $__actionTimestamp;

	private $__actionStatus;

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * __construct function.
 *
 * @access public
 * @param mixed $username
 * @param mixed $password
 * @return void
 */
	public function __construct($username, $password, $serverUrl = null) {
		if (!is_null($serverUrl)) {
			$this->__loginWebServiceUrl = $serverUrl;
		}
		//@TODO Temporary hack until webservice is Fixed
		$this->__loginWebServiceUrl .= '/' . $username . '/' . $password;
		
		$postOptions = $this->__postVarUsername . '=' . $username . '&' .
			$this->__postVarPasswords . '=' . $password;

		$curlOptions = array(
			//CURLOPT_POST => true,
			//CURLOPT_POSTFIELDS => $postOptions,
			CURLOPT_HTTPHEADER => $this->__accepts
		);

		$curlRequest = new Curl($this->__loginWebServiceUrl, $curlOptions);

		if (!$curlRequest->errno()) {
			$this->__response = json_decode($curlRequest->body());

			$this->__cookies = $curlRequest->cookies();

			if (isset($this->__response->message)) {
				$this->__message = $this->__response->message;
			}

			if (isset($this->__response->action)) {
				$this->__action = $this->__response->action;
			}

			if (isset($this->__response->result)) {
				$this->__result = $this->__response->result;
			}

			if (isset($this->__response->actionCode)) {
				$this->__actionCode = $this->__response->actionCode;
			}

			if (isset($this->__response->__actionTimestamp)) {
				$this->__actionTimestamp = $this->__response->__actionTimestamp;
			}

			if (isset($this->__response->actionStatus)) {
				$this->__actionStatus = $this->__response->actionStatus;
			}

			if (isset($this->__actionStatus) && $this->__actionStatus === 'success') {
				if (isset($this->__result)) {
					$this->__setCookies($this->__result);
				}
			}
		} else {
			$this->__actionStatus = 'failure';
			$this->__message = (object)array(
				array('errorMessage' => $curlRequest->error()),
				array('debugMessage' => 'Curl Request failed.'),
				array('infoMessage')
			);
		}
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//------------------------------------------------------------------------------

/**
 * Sets cookies for value pairs passed as array or simple object.
 *
 * @access private
 * @param array|object $cookieArray
 * @return void
 */
	private function __setCookies( $cookieArray) {
		$expire = (time() + 3600) * 30;
		$path = COOKIE_PATH;
		$domain = COOKIE_DOMAIN;
		$secure = COOKIE_SECURE;
		$httpOnly = COOKIE_HTTP_ONLY;

		foreach ((array)$cookieArray as $key => $value) {
			switch ($key) {
			case 'ss_EmKey':
					setrawcookie('ERIGHTS', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 'i_Constit':
					setrawcookie('sm_constitid', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 'i_EmId':
					setrawcookie('emeta_id', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 's_Name1':
					setcookie('first_name', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 's_Name2':
					setcookie('last_name', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 'sb_IsOrg':
					setcookie('is_org', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 'se_Email':
					setrawcookie('email', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;

			case 's_MemStatus':
					setcookie('status', $value, $expire, $path, $domain, $secure, $httpOnly);
					break;
			}
		}

		if (isset($this->__cookies) && !is_null($this->__cookies)) {
			if (is_array($this->__cookies)) {
				foreach ($this->__cookies as $cookies) {
					foreach ((array)$cookies as $key => $value) {
						$lowerCaseKey = strtolower($key);
						switch ($lowerCaseKey) {
						case 'path':
								$path = $value;
								break;

						case 'domain':
								$domain = $value;
								break;

						case 'expires':
								$expire = $value;
								if (($timestamp = strtotime($value)) !== false) {
									$expire = $timestamp;
								}
								break;

						case 'secure':
								$secure = true;
								break;

						case 'httponly':
								$httpOnly = true;
								break;

						default:
								$cookieName = $key;
								$cookieValue = $value;

						}
					}
					setrawcookie($cookieName, $cookieValue, $expire, $path, $domain, $secure, $httpOnly);
				}
			}
		}
	}

	//------------------------------------------------------------------------------
	//!**** Public Static Methods ****
	//------------------------------------------------------------------------------

/**
 * Logs the user out by resetting the appropiate cookies to expire in the past and
 * setting their content to nothing.
 *
 * @access public
 * @return void
 */
	public static function logout() {
		if (isset($_COOKIE['sm_constitid'])) {
			setrawcookie('sm_constitid', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['ERIGHTS'])) {
			setrawcookie('ERIGHTS', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['JSESSIONID'])) {
			setrawcookie('JSESSIONID', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['emeta_id'])) {
			setrawcookie('emeta_id', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['first_name'])) {
			setrawcookie('first_name', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['last_name'])) {
			setrawcookie('last_name', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['is_org'])) {
			setrawcookie('is_org', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['email'])) {
			setrawcookie('email', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}

		if (isset($_COOKIE['status'])) {
			setrawcookie('status', "", time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
		}
		exit;
	}

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for EmetaLogin::$__loginWebServiceUrl.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__loginWebServiceUrl to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__loginWebServiceUrl.
 */
	public function loginWebServiceUrl($value = null) {
		if (func_num_args() > 0) {
			$this->__loginWebServiceUrl = $value;
		} else {
			return $this->__loginWebServiceUrl;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__postVarUsername.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__postVarUsername to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__postVarUsername.
 */
	public function postVarUsername($value = null) {
		if (func_num_args() > 0) {
			$this->__postVarUsername = $value;
		} else {
			return $this->__postVarUsername;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__postVarPasswords.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__postVarPasswords to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__postVarPasswords.
 */
	public function postVarPasswords($value = null) {
		if (func_num_args() > 0) {
			$this->__postVarPasswords = $value;
		} else {
			return $this->__postVarPasswords;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__accepts.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__accepts to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__accepts.
 */
	public function accepts($value = null) {
		if (func_num_args() > 0) {
			$this->__accepts = $value;
		} else {
			return $this->__accepts;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__cookies.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__cookies to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__cookies.
 */
	public function cookies($value = null) {
		if (func_num_args() > 0) {
			$this->__cookies = $value;
		} else {
			return $this->__cookies;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__response.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__response to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__response.
 */
	public function response($value = null) {
		if (func_num_args() > 0) {
			$this->__response = $value;
		} else {
			return $this->__response;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__message.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__message to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__message.
 */
	public function message($value = null) {
		if (func_num_args() > 0) {
			$this->__message = $value;
		} else {
			return $this->__message;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__action.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__action to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__action.
 */
	public function action($value = null) {
		if (func_num_args() > 0) {
			$this->__action = $value;
		} else {
			return $this->__action;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__result.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__result to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__result.
 */
	public function result($value = null) {
		if (func_num_args() > 0) {
			$this->__result = $value;
		} else {
			return $this->__result;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__actionCode.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__actionCode to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__actionCode.
 */
	public function actionCode($value = null) {
		if (func_num_args() > 0) {
			$this->__actionCode = $value;
		} else {
			return $this->__actionCode;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__actionTimestamp.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__actionTimestamp to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__actionTimestamp.
 */
	public function actionTimestamp($value = null) {
		if (func_num_args() > 0) {
			$this->__actionTimestamp = $value;
		} else {
			return $this->__actionTimestamp;
		}
	}

/**
 * Getter/Setter for EmetaLogin::$__actionStatus.
 *
 * @access public
 * @param mixed Value for EmetaLogin::$__actionStatus to be set to.
 * @return mixed If no parameter are passed it returns the current value for EmetaLogin::$__actionStatus.
 */
	public function actionStatus($value = null) {
		if (func_num_args() > 0) {
			$this->__actionStatus = $value;
		} else {
			return $this->__actionStatus;
		}
	}

}//end class