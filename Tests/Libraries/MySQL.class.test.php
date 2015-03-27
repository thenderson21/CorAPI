<?php
/**
 * MySQL Class Unit Test
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

class MySQLClassTest extends PHPUnit_Framework_TestCase {

	public function testMethods(){
		$MySQL = new MySQL(MYSQL_USER, MYSQL_PASS, MYSQL_HOST);

		$this->assertTrue(  method_exists($MySQL, 'lastError'), 'Class does not have method lastError');
		$this->assertTrue(  method_exists($MySQL, 'lastQuery'), 'Class does not have method lastQuery');
		$this->assertTrue(  method_exists($MySQL, 'result'), 'Class does not have method result');
		$this->assertTrue(  method_exists($MySQL, 'records'), 'Class does not have method records');
		$this->assertTrue(  method_exists($MySQL, 'affected'), 'Class does not have method affected');
		$this->assertTrue(  method_exists($MySQL, 'rawResults'), 'Class does not have method rawResults');
		$this->assertTrue(  method_exists($MySQL, 'arrayedResult'), 'Class does not have method arrayedResult');
		$this->assertTrue(  method_exists($MySQL, 'hostname'), 'Class does not have method hostname');
		$this->assertTrue(  method_exists($MySQL, 'username'), 'Class does not have method username');
		$this->assertTrue(  method_exists($MySQL, 'password'), 'Class does not have method actionTimestamp');
		$this->assertTrue(  method_exists($MySQL, 'database'), 'Class does not have method database');
		$this->assertTrue(  method_exists($MySQL, 'databaseLink'), 'Class does not have method databaseLink');
		
		$this->assertTrue(  method_exists($MySQL, 'executeSQL'), 'Class does not have method executeSQL');
		$this->assertTrue(  method_exists($MySQL, 'insert'), 'Class does not have method insert');
		$this->assertTrue(  method_exists($MySQL, 'delete'), 'Class does not have method delete');
		$this->assertTrue(  method_exists($MySQL, 'select'), 'Class does not have method select');
		$this->assertTrue(  method_exists($MySQL, 'update'), 'Class does not have method update');
		
		$this->assertTrue(  method_exists($MySQL, 'arrayResults'), 'Class does not have method arrayResults');
		$this->assertTrue(  method_exists($MySQL, 'arrayResultsWithKey'), 'Class does not have method arrayResultsWithKey');
		$this->assertTrue(  method_exists($MySQL, 'lastInsertID'), 'Class does not have method lastInsertID');
		$this->assertTrue(  method_exists($MySQL, 'countRows'), 'Class does not have method countRows');
		$this->assertTrue(  method_exists($MySQL, 'closeConnection'), 'Class does not have method closeConnection');
	}
}
