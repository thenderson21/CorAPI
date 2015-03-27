<?php
/**
 * Debug Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/13/13
 */

require_once ("CoreAPI/common.ini.php");

class DebugClassTest extends PHPUnit_Framework_TestCase {
	
	public static $exited = false;

    protected $_test= array('one', 'two', 'three', 'four');
	
	
	public static function exited(){
		self::$exited = true;
	}
/**
 * @requires extension test_helpers
 */	
	public function testDumpExit(){
		$this->expectOutputString(Debug::dump($this->_test, null, false));
		set_exit_overload(function() { echo DebugClassTest::exited(); });
		Debug::dump($this->_test, null, true, true);
		unset_exit_overload();
    	$this->assertEquals(true, DebugClassTest::$exited );
    	
	}
	
	public function testDump(){
		$this->expectOutputString(Debug::dump($this->_test, null, false));
    	Debug::dump($this->_test);
    	
	}

	public function testTimes(){
		Debug::start();
		$time = Debug::getTime();
		$this->assertInternalType('float', $time);
		
		$this->assertGreaterThan($time, Debug::getTime());	
		
		Debug::pause();
		$pause = Debug::getTime();	
		
		foreach($this->_test as $key){}
		
		$stillPaused = Debug::getTime();
	
		$this->assertTrue(abs($stillPaused - $pause ) < 0.0001);
		
		debug::unpause();
		$this->assertGreaterThan($pause, Debug::getTime());	
		
	}
}//end class