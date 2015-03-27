<?php
/**
 * LocationTools Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/21/13
 */

require_once ("CoreAPI/common.ini.php");

class LocationToolsClassTest extends PHPUnit_Framework_TestCase {
	
	public function testFetchCoordinates(){
		$coordinates = LocationTools::fetchCoordinates('Dallas,TX');
		
		$this->assertInstanceOf('stdClass', $coordinates);
		
		$this->assertObjectHasAttribute('latitude', $coordinates);
		$this->assertObjectHasAttribute('longitude', $coordinates);
		
		$this->assertInternalType('float', $coordinates->latitude);
		$this->assertInternalType('float', $coordinates->longitude);
	}

}//end class