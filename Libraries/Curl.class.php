<?php
/**
 * Curl class file
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 6/4/13
 * @package CoreAPI/Libraries/WebTools
 */

/**
 * Class for performing curl requests.
 * @package CoreAPI/Libraries/WebTools
 */
class Curl {

	private $__defaults = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CONNECTTIMEOUT => 2000,
		CURLOPT_HEADER => true,
		CURLOPT_FOLLOWLOCATION => true
	);

	private $__sesson;

	private $__options;

	private $__response;

	private $__header = null;

	private $__body;

	private $__cookies;

	private $__errno = null;

	private $__error = null;

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * Constructor method or the Curl class.
 *
 *  Example:
 * ````
 *  $request = new Curl('http://example.com', array(CURLOPT_CONNECTTIMEOUT => 2000));
 * ````
 * @access public
 * @param mixed $url
 * @param array $options An array of curl options with the key the curl option and the value the curl option value.
 * @return void
 */
	public function __construct($url, array $options = null) {
		$this->__options = $options;

		$this->__sesson = $this->__curl($url);
	}

/**
 * Descructor method or the Curl class.
 *
 * @access public
 * @return void
 */
	public function __destruct() {
		curl_close($this->__sesson);
	}

/**
 * __get function.
 *
 * @access public
 * @param string Name of varriable to be gotten
 * @return void
 * @throws Exception if an error is encountered. 
 */
	public function __get($name) {
		$privateName = "__" . $name;
		$protectedName = "_" . $name;
		if (property_exists($this,$privateName)) {
			return $this->$privateName;
		} elseif (property_exists($this,$protectedName)) {
			return $this->$protectedName;
		} elseif (property_exists($this,$name)) {
			return $this->$name;
		} else {
			throw new Exception('Property is unavailable.');
		}
	}

/**
 * __set function.
 *
 * @access public
 * @param string Name of varriable to be set
 * @param mixed Value of varriable to be set
 * @return mixed
 */
	public function __set($name, $value) {
		$privateName = "__" . $name;
		$protectedName = "_" . $name;
		if (property_exists($this,$privateName)) {
			$this->$privateName = $value;
		} elseif (property_exists($this,$protectedName)) {
			$this->$protectedName = $value;
		} else {
			$this->$name = $value;
		}
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//------------------------------------------------------------------------------

/**
 * Performs a curl request.
 *
 * @access private
 * @param string The fully qualified url.
 * @return mixed Returns the curl sesson.
 */
	private function __curl($url) {
		$curlSession = curl_init($url);

		foreach ($this->__defaults as $key => $value) {
			curl_setopt($curlSession, $key, $value);
		}

		if (isset($this->__options) && ! is_null($this->__options)) {
			foreach ($this->__options as $key => $value) {
				curl_setopt($curlSession, $key, $value);
			}
		}

		if (isset($this->__accepts) && ! is_null($this->__accepts)) {
			curl_setopt($curlSession, CURLOPT_HTTPHEADER, $this->accepts);
		}

		$data = curl_exec($curlSession);	// run curl and retrieve data;
		$this->__errno = curl_errno($curlSession);
		$this->__error = curl_error($curlSession);

		if (!curl_errno($curlSession)) {
			$this->response = curl_getinfo($curlSession);
			$this->__explodeHeader($data);
			// get cookies
			$cookies = array();
			preg_match_all('/Set-Cookie:(?<cookie>\s{0,}.*)$/im', $this->__header, $cookies);

			// basic parsing of cookie strings
			$cookieParts = array();
			foreach ($cookies['cookie'] as $key => $value) {
				$cookieParts[$key] = explode(';', $value);
				foreach ($cookieParts[$key] as $subKey => $subValue) {
					$temp = explode('=', $subValue);
					$cookieKey = trim($temp[0]);

					if (array_key_exists(1, $temp)) {
						$cookieValue = trim($temp[1]);
					} else {
						$cookieValue;
					}

					$this->__cookies[$key][$cookieKey] = $cookieValue;
				}
			}
		}
		return $curlSession;
	}

/**
 * Separates the http header from the results of a curl request.
 * 
 * @access private
 * @param string Raw http request results
 * @return void
 * @throws Exception Throws and Exception if and error is encountered.
 */
	private function __explodeHeader($data) {
			if (stripos($data, "\r\n\r\n")) {
				list($header, $this->__body) = explode("\r\n\r\n", $data, 2);

				//Check if $this->__header has been set before and act accordingly.
				if (is_null($this->__header)) {
					$this->__header = $header;
				} else {
					$this->__header .= "\r\n\r\n" . $header;
				}

				if (preg_match('/^HTTP\/\d\.\d\s/',$this->__body)) {
					$this->__explodeHeader($this->__body);
				}
			} else {
				throw new Exception('Unable to detect end of http header.');
			}
	}

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for Curl::$__defaults.
 *
 * @access public
 * @param mixed Value for Curl::$__defaults to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__defaults.
 */
	public function defaults($value = null) {
		if (func_num_args() > 0) {
			$this->__defaults = $value;
		} else {
			return $this->__defaults;
		}
	}

/**
 * Getter/Setter for Curl::$__options.
 *
 * @access public
 * @param mixed Value for Curl::$__options to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__options.
 */
	public function options($value = null) {
		if (func_num_args() > 0) {
			$this->__options = $value;
		} else {
			return $this->__options;
		}
	}

/**
 * Getter/Setter for Curl::$__response.
 *
 * @access public
 * @param mixed Value for Curl::$__response to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__response.
 */
	public function response($value = null) {
		if (func_num_args() > 0) {
			$this->__response = $value;
		} else {
			return $this->__response;
		}
	}

/**
 * Getter/Setter for Curl::$__header.
 *
 * @access public
 * @param mixed Value for Curl::$__header to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__header.
 */
	public function header($value = null) {
		if (func_num_args() > 0) {
			$this->__header = $value;
		} else {
			return $this->__header;
		}
	}

/**
 * Getter/Setter for Curl::$__body.
 *
 * @access public
 * @param mixed Value for Curl::$__body to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__body.
 */
	public function body($value = null) {
		if (func_num_args() > 0) {
			$this->__body = $value;
		} else {
			return $this->__body;
		}
	}

/**
 * Getter/Setter for Curl::$__cookies.
 *
 * @access public
 * @param mixed Value for Curl::$__cookies to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__cookies.
 */
	public function cookies($value = null) {
		if (func_num_args() > 0) {
			$this->__cookies = $value;
		} else {
			return $this->__cookies;
		}
	}

/**
 * Getter/Setter for Curl::$__errno.
 *
 * @access public
 * @param mixed Value for Curl::$__cookies to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__errno.
 */
	public function errno($value = null) {
		if (func_num_args() > 0) {
			$this->__errno = $value;
		} else {
			return $this->__errno;
		}
	}

/**
 * Getter/Setter for Curl::$__error.
 *
 * @access public
 * @param mixed Value for Curl::$__cookies to be set to.
 * @return mixed If no parameter are passed it returns the current value for Curl::$__error.
 */
	public function error($value = null) {
		if (func_num_args() > 0) {
			$this->__error = $value;
		} else {
			return $this->__error;
		}
	}

}//end class