<?php
/**
 * The file that contains the WebServices class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id
 * @since 9/21/12
 * @package CoreAPI/Libraries/DataInterchange
 */

/**
 * WebService
 *
 * WebServices Class file. The WebService class gets, process and returns an object file for the requested service.
 * @package CoreAPI/Libraries/DataInterchange
 * @todo Update documentation.
 * @todo Add Better exception handeling
 */
class WebService {

	//------------------------------------------------------------------------------
	//!**** Public Variables ****
	//------------------------------------------------------------------------------

	private $__serviceURL;			///< The url of the webservice requested.
	private $__serviceType;			///< The file type/encoding of the webservice.
	private $__serviceData;			///< The Raw unprocess data.
	private $__serviceDataArray;	///< An array of processed data for parralell webservices fetches.
	private $__service;				///< Object retrieved from the url.


	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * Class Constructor
 *
 * @throws Exception Throws an Exception on error.
 */
	public function __construct() {
		Debug::mark(__METHOD__);
		$argv = func_get_args();

		switch (func_num_args()) {
		case 0:
			throw new Exception("Missing URL.");

		case 1:
				if (is_array($argv[0])) {
						$this->__serviceURL = $argv[0];
						$this->__serviceType = array('json'); //Default service type.
				} else {
					if (WebTools::isValidUrl($argv[0])) {
						$this->__serviceURL = $argv[0];
						$this->__serviceType = array('json'); //Default service type.
					} else {
						throw new Exception("'$argv[0]' is not a valid argument.");
					}
				}
				break;

		case 2:
				if (WebTools::isValidUrl($argv[0])) {
					$this->__serviceURL = $argv[0];
					switch ($argv[1]) {
					case 'json':
							$this->__serviceType = array('json');
							break;

					case 'xml':
							$this->__serviceType = array('xml');
							break;

					default: //default file type
						throw new Exception("'$argv[1]' is not a valid type.");
					}
					break;
				} else {
					throw new Exception("'$argv[0]' is not a valid URL.");
				}
		}//end switch

		$this->__serviceData = $this->__getData($this->__serviceURL);
		$this->__service = $this->__processData($this->__serviceData);
		Debug::mark(__METHOD__);
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//------------------------------------------------------------------------------

/**
 * Returns string of requested data. Json or XML.
 *
 * @return objec
 * @throws Exception Throws an Exception on error.
 * @todo Update methods documentation.
 */
	private function __getData() {
		Debug::mark(__METHOD__);
		$accptedTypes = array('xml', 'json');	//accepted types of data
		$accepts = array('Accept: application/json');	//Default file encoding
		$timeout = 5;	//Default timeout for Curl Requests

		$argv = func_get_args();

		switch (func_num_args()) {
		case 0:
			throw new Exception("Missing URL.");

		case 1:
				if (is_array($argv[0])) {
					foreach ($argv[0] as $key => $URLValue) {
						if (WebTools::isValidUrl($URLValue)) {
							$url[$key] = $URLValue;
						}
					}
				} elseif (WebTools::isValidUrl($argv[0]) && !is_array($argv[0])) {
					$url = $argv[0];
				} else {
					throw new Exception("'$argv[0]' is not a valid URL.");
				}
				break;

		case 2:
				if (WebTools::isValidUrl($argv[0])) {
					$url = $argv[0];
					if (in_array($argv[1], $accptedTypes)) {
						switch ($argv[1]) {
						case 'json':
								$accepts = array('Accept: application/json');
								break;

						case 'xml':
								$accepts = array('Accept: application/xml');
								break;

						default: //default file type
								$accepts = array('Accept: application/json');
						}
					} else {
						throw new Exception("'$argv[1]' is not a valid type.");
					}
					break;
				} else {
					throw new Exception("'$argv[0]' is not a valid URL.");
				}
		}//end switch
		Debug::mark(__METHOD__);

		if (is_array($url)) {
			$data = new CurlP($url);
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			if (isset($accepts)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $accepts);
			}

			$data = curl_exec($ch); // runn curl and retrieve data;
			$response = curl_getinfo($ch);

			curl_close($ch); //clean us curl

			if ($response['http_code'] == 301) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $response['redirect_url']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

				if (isset($accepts)) {
					curl_setopt($ch, CURLOPT_HTTPHEADER, $accepts);
				}

				$data = curl_exec($ch); // runn curl and retrieve data;
				$response = curl_getinfo($ch);

				curl_close($ch); //clean us curl
			}

			if ($data == false || $response['http_code'] != 200) {
				if ($response['http_code'] != 200) {
					throw new Exception('HTML Response Code: ' . $response['http_code']);
				} else {
					throw new Exception(curl_error($ch));
				}
			}
		}
		Debug::mark(__METHOD__);
		return $data;
	}

/**
 * Prosseses data and returns object of the inputed webservice.
 *
 * @access private
 * @param mixed Object, string or and array of strings encoded.
 * @param string 'json' or 'xml' (default: 'json')
 * @return object Returns an object representin the encoded string, array, or object.
 * @throws Exception Throws an Exception on error.
 */
	private function __processData($data, $encoding = 'json') {
		Debug::mark(__METHOD__);

		$argv = func_get_args();
		$data = $argv[0];

		$object;

		switch (func_num_args()) {
		case 0:
			throw new Exception("Missing Argument.");

		case 1:
				if (is_string($data)) {
					$object = Json::decode($data);
				} elseif (is_object($data)) {
					if ($data instanceof CurlP) {
						foreach ($data->__getData() as $key => $dataValue) {
							$object[$key] = Json::decode($dataValue);

						}
					} else {
						throw new Exception("Unknown object type.");
					}
				} elseif (is_array($data)) {
					foreach ($data as $key => $dataValue) {
						$object[$key] = Json::decode($dataValue);
					}
				} else {
					throw new Exception("Invalid argument type.");
				}
				break;

		case 2:
				switch ($encoding) {
				case 'xml':
						$object = new SimpleXMLElement($data);
						break;

				default:
						$object = Json::decode($data);

				}
				break;
		}//end switch

		Debug::mark(__METHOD__);
		return $object;
	} //end function __processData()

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for WebService::$__serviceURL.
 *
 * @access public
 * @param mixed Value for WebService::$__serviceURL to be set to.
 * @return mixed If no parameter are passed it returns the current value for WebService::$__serviceURL.
 */
	public function serviceURL($value = null) {
		if (func_num_args() > 0) {
			$this->__serviceURL = $value;
		} else {
			return $this->__serviceURL;
		}
	}

/**
 * Getter/Setter for WebService::$__serviceType.
 *
 * @access public
 * @param mixed Value for WebService::$__serviceType to be set to.
 * @return mixed If no parameter are passed it returns the current value for WebService::$__serviceType.
 */
	public function serviceType($value = null) {
		if (func_num_args() > 0) {
			$this->__serviceType = $value;
		} else {
			return $this->__serviceType;
		}
	}

/**
 * Getter/Setter for WebService::$__serviceData.
 *
 * @access public
 * @param mixed Value for WebService::$__serviceData to be set to.
 * @return mixed If no parameter are passed it returns the current value for WebService::$__serviceData.
 */
	public function serviceData($value = null) {
		if (func_num_args() > 0) {
			$this->__serviceData = $value;
		} else {
			return $this->__serviceData;
		}
	}

/**
 * Getter/Setter for WebService::$__serviceDataArray.
 *
 * @access public
 * @param mixed Value for WebService::$__serviceDataArray to be set to.
 * @return mixed If no parameter are passed it returns the current value for WebService::$__serviceDataArray.
 */
	public function serviceDataArray($value = null) {
		if (func_num_args() > 0) {
			$this->__serviceDataArray = $value;
		} else {
			return $this->__serviceDataArray;
		}
	}

/**
 * Getter/Setter for WebService::$__service.
 *
 * @access public
 * @param mixed Value for WebService::$__service to be set to.
 * @return mixed If no parameter are passed it returns the current value for WebService::$__service.
 */
	public function service($value = null) {
		if (func_num_args() > 0) {
			$this->__service = $value;
		} else {
			return $this->__service;
		}
	}

}//end class