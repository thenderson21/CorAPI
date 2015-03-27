<?php
/**
 * WebServices Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson
 * @version $Id$
 * @since 8/8/13
 * @todo When CI server is created make test database and write connection and CRUD Test.
 */

require_once ("CoreAPI/common.ini.php");

class WebServiceClassTest extends PHPUnit_Framework_TestCase {

	public function testMethods(){
		$WebService = new WebService('http://maps.googleapis.com/maps/api/geocode/json?address=dallas,tx&sensor=true');

		$this->assertTrue(  method_exists($WebService, 'serviceURL'), 'Class does not have method serviceURL');
		$this->assertTrue(  method_exists($WebService, 'serviceType'), 'Class does not have method serviceType');
		$this->assertTrue(  method_exists($WebService, 'serviceData'), 'Class does not have method serviceData');
		$this->assertTrue(  method_exists($WebService, 'serviceDataArray'), 'Class does not have method records');
		$this->assertTrue(  method_exists($WebService, 'service'), 'Class does not have method service');
	}
}
