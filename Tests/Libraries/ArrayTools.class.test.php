<?php
/**
 * SiteSearch Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson
 * @version $Id$
 * @since 8/8/13
 */

require_once ("CoreAPI/common.ini.php");

class ArrayToolsClassTest extends PHPUnit_Framework_TestCase {

    protected $_expectedArray = array('one', 'two', 'three', 'four'); 	
	protected $_multiDemArray = array('one' => 1, 'two'=> 2, 'three' => 3, 'four'=> 4, array('A'=>'a','b','c') ); 
	
	
	public function testArrayKeysMulti() {
		$test = array("one", "two", "three", "four", 0, 'A', 0, 1);
		$this->assertEquals($test, ArrayTools::arrayKeysMulti($this->_multiDemArray));
	}
	
	public function testArrayKeysMultiArrayException() {	
		$this->setExpectedException('PHPUnit_Framework_Error');
	
		$resultArray = ArrayTools::arrayKeysMulti('bjork');		
	}
	
	public function testMoveValueByIndex() {
		
		$testArray = array('four', 'two', 'three', 'one');

		$resultArray = ArrayTools::swapValueByIndex($testArray, 3, 0);
		$this->assertEquals($this->_expectedArray,  $resultArray);
	}

	public function testMoveValueByIndexFromException() {
		$this->setExpectedException('Exception');

		$resultArray = ArrayTools::swapValueByIndex($this->_expectedArray, 15, 0);
	}

	public function testMoveValueByIndexToException() {	
		$this->setExpectedException('Exception');
	
		$resultArray = ArrayTools::swapValueByIndex($this->_expectedArray, 3, 15);		
	}
	
	public function testMoveValueByIndexArrayException() {	
		$this->setExpectedException('PHPUnit_Framework_Error');
	
		$resultArray = ArrayTools::swapValueByIndex(null, 3, 15);		
	}

	public function testInArrayRecursive() {
		$this->assertEquals(true, ArrayTools::inArrayRecursive('one', $this->_expectedArray));
		
		$this->assertEquals(false, ArrayTools::inArrayRecursive('none', $this->_expectedArray));		
	}

	public function testInArrayNoCase() {
		$this->assertEquals(true, ArrayTools::inArrayNoCase('one', $this->_expectedArray));
		$this->assertEquals(true, ArrayTools::inArrayNoCase('ONE', $this->_expectedArray));
		$this->assertEquals(true, ArrayTools::inArrayNoCase('One', $this->_expectedArray));
		
		$this->assertEquals(false, ArrayTools::inArrayNoCase('none', $this->_expectedArray));	
	}


	public function testArraySearchNoCase() {
		$this->assertEquals(0, ArrayTools::arraySearchNoCase('one', $this->_expectedArray));
		$this->assertEquals(0, ArrayTools::arraySearchNoCase('ONE', $this->_expectedArray));
		$this->assertEquals(0, ArrayTools::arraySearchNoCase('One', $this->_expectedArray));
		
		$this->assertEquals(false, ArrayTools::inArrayRecursive('none', $this->_expectedArray));	
	}

	public function testSearchKeyValuePair() {
		$this->assertEquals(array($this->_multiDemArray), ArrayTools::searchKeyValuePair($this->_multiDemArray, 'three', 3));
		
		$this->assertEquals(false, ArrayTools::searchKeyValuePair($this->_multiDemArray, 0, 'monkeys'));
	}


}//end class