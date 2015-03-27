<?php
/**
 * StringTools Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/13/13
 */

require_once ("CoreAPI/common.ini.php");

class StringToolsClassTest extends PHPUnit_Framework_TestCase {

    protected $_needles = array('one', 'two', 'three', 'four');
	

	public function testStartsWith(){
		//Should Returns True
    	$this->assertEquals(true, StringTools::startsWith('This should return true.', 'This'));
    	
    	//Should Returns False
    	$this->assertEquals(false, StringTools::startsWith('This should return false.', 'FAIL'));
    	$this->assertEquals(false, StringTools::startsWith('So should this.', 'this'));
    	$this->assertEquals(false, StringTools::startsWith('So should this.', 'so'));
	}

	public function testContains() {
		//Should Returns True
		$this->assertEquals(true, StringTools::contains('This is the one string to rule them all.', 'one'));
		$this->assertEquals(true, StringTools::contains('This is the one string to rule them all.', $this->_needles));
		$this->assertEquals(true, StringTools::contains('This is the three string to rule them all.', $this->_needles));
		
		//Should Returns False
		$this->assertEquals(false, StringTools::contains('This is the one string to rule them all.', 'FAIL'));
		$this->assertEquals(false, StringTools::contains('This is not string to rule them all.', $this->_needles));
	}

}//end class