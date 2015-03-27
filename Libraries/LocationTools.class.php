<?php
/**
 * LocationTool class file.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/10/12
 * @package CoreAPI/Libraries/LocationTools
 */

/**
 * Class for obtaining location information and coordianates.
 *
 * The LocationTools class contains methods useful for finding locations given different information.
 *
 * @uses Message
 * @package CoreAPI/Libraries/LocationTools
 */
class LocationTools {

	//------------------------------------------------------------------------------
	//!**** Public Static Methods ****
	//------------------------------------------------------------------------------

/**
 * Fetches the latitude and longitude coordinates for a given location from geo location services such
 * as google maps.  If unable to determin coordinates it returns false and sets a new Message or throws
 * a new exception if invalid arguments are passed.
 *
 * @uses Message
 * @static
 * @param string Name of city to be located.
 * @return object Returns an object with properties latitude and longitude or returns `false` of unable to determine coordinates.
 * @throws Exception Throw an exception on error.
 * @todo Add support for other geolocation services.
 */
	public static function fetchCoordinates( $city ) {
		if (is_string($city)) {
			$webService = new WebService('http://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($city) . '&sensor=true');
			$locationsArray = Json::decode($webService->serviceData());
			$LatLon = (object)array();

			if (count($locationsArray->results ) == 1) {
				$LatLon->latitude = $locationsArray->results[0]->geometry->location->lat;
				$LatLon->longitude = $locationsArray->results[0]->geometry->location->lng;
				return $LatLon;
			} else {
				new Message(__METHOD__ . ' is unable to determine the location of ' . $city . '.', 'notice');
				Message::$notices[Message::getLastNoticeId()]->obj = $locationsArray; //append location object to Message::Object
				return false;
			}
		} else {
			throw new Exception(__METHOD__ . 'is expecting a string variable instead of ' . gettype( $city ));
		}
	}

}//end class