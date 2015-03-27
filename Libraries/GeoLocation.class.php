<?php
/**
 * Class file for the GeoLocation class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/19/12
 * @package CoreAPI/LocationTools
 */

/**
 * GeoLocation class attempts to locate the user's location from their ip address.
 *
 * @requires PHP 4.5+
 * @package CoreAPI/LocationTools
 * @todo Update to use the XmlHandler class.
 * @todo Bring up to coding standards.
 */
class GeoLocation {
	/**#@+
		 * @var string
		 */
	/** GeoLocation::$doc
	 *
	 * XML document. */
	var $doc = null;

	/** GeoLocation::$host
	 *
	 * Url of the host of the geo location service. */
	var $host = "http://api.hostip.info/?ip=<IP>";

	/** GeoLocation::$city
	 *
	 * The city returned from geo location service. */
	var $city = 'unknown';

	/** GeoLocation::$country
	 *
	 * The country returned from geo location service. */
	var $country = 'unknown';

	/** GeoLocation::$longitude
	 *
	 * The longitude returned from geo location service. */
	var $longitude = '0';

	/** GeoLocation::$latitude
	 *
	 * The latitude returned from geo location service. */
	var $latitude  = '0';
	/**#@-*/


	/**
	 * GeoLocation::__construct
	 *
	 * Creates a new GeoLocation object.
	 * 
	 * @param string $ip An ip address.
	 * @return void
	 */
	function __construct( $ip ) {
		$this->doc = new PHP45XML();
		$this->doc->preserveWhiteSpace = false;

		// prepare url of service
		$host  = str_replace( "<IP>", $ip, $this->host);
		$reply = $this->fetch($host);

		// decode the reply and make it available
		$this->decode($reply);
	}

	/**
	 * GeoLocation::GeoLocation
	 *
	 * Old Style constructor function. Creates a new GeoLocation object.
	 *
	 * @deprecated 
	 * @param string $ip An ip address.
	 * @return void
	 */
	function GeoLocation($ip) {
		$this->doc = new PHP45XML();
		$this->doc->preserveWhiteSpace = false;

		// prepare url of service
		$host  = str_replace( "<IP>", $ip, $this->host);
		$reply = $this->fetch($host);

		// decode the reply and make it available
		$this->decode($reply);
	}


	/**
	 * GeoLocation::fetch
	 * 
	 * @param string $host
	 * @return string The method returns the read data or FALSE on failure.
	 */
	function fetch( $host ) {
		$reply = 'error';
		// try curl or fopen
		if ( function_exists('curl_init') ) {
			// use curl too fetch site
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL           , $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$reply = curl_exec($ch);
			curl_close($ch);
		} else {
			// fall back on fopen
			$reply = file_get_contents($host, 'r');
		}
		return $reply;
	}

	/**
	 * GeoLocation::decode
	 * 
	 * @param string $text
	 * @return void
	 */
	function decode($text) {
		// load in php version independent manner
		$this->doc->loadXML($text);
		// use the PHP4/5 XML wrapper to decode the result
		$result = $this->doc->xpath("//gml:name");

		if ( array_key_exists('city', $result) ) {
			$this->city = $result['city'];
		}

		if ( array_key_exists('country', $result) ) {
			$this->country = $result['country'];
		}

		if ( array_key_exists('lng', $result) ) {
			$this->longitude = $result['lng'];
		}
		if ( array_key_exists('lat', $result) ) {
			$this->latitude  = $result['lat'];
		}

	}
}

?>