<?php
/**
 * EmetaLogin Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson
 * @version $Id$
 * @since 8/8/13
 */

require_once ("CoreAPI/common.ini.php");
ob_start();
class EmetaLoginClassTest extends PHPUnit_Framework_TestCase {

		private $__testUser = 'bwu@spe.org';

		private $__testPass = 'abc123';

		public function testLoginSucess(){

				$login = new EmetaLogin($this->__testUser, $this->__testPass);

				//check sucess
				$this->assertEquals($login->actionStatus(), 'success');

				//check results
				$results = $login->result();
				$this->assertInstanceof('stdClass', $results);
				$this->assertEquals($this->__testUser, $results->se_Username);
				$this->assertInternalType('string', $results->ss_EmKey);
				$this->assertInternalType('int', (int) $results->i_Constit);
				$this->assertInternalType('int', (int) $results->i_EmId);
				$this->assertInternalType('string', $results->s_Name1);
				$this->assertInternalType('string', $results->s_Name2);
				$this->assertInternalType('string', $results->sb_IsOrg);
				$this->assertInternalType('string', $results->se_Email);
				$this->assertInternalType('string', $results->s_MemStatus);
		}

		public function testLoginFailure(){

				$login = new EmetaLogin($this->__testUser, 'Duum De Dum Dum.. Duuum');

				//check sucess
				$this->assertNotEquals($login->actionStatus(), 'success');

				$message = $login->message();
				$this->assertInstanceof('stdClass', $message);
		}

	//public function testLogout() {
		//Basic test that it doesn't break anythign
		/** @todo Fugure out a better way to test this. **/

		//$this->assertEmpty(EmetaLogin::logout());
	//}

	public function testMethods(){
		$login = new EmetaLogin($this->__testUser, 'Duum De Dum Dum.. Duuum');

		$this->assertTrue(  method_exists($login, 'loginWebServiceUrl'), 'Class does not have method loginWebServiceUrl');
		$this->assertTrue(  method_exists($login, 'postVarUsername'), 'Class does not have method postVarUsername');
		$this->assertTrue(  method_exists($login, 'postVarPasswords'), 'Class does not have method postVarPasswords');
		$this->assertTrue(  method_exists($login, 'accepts'), 'Class does not have method accepts');
		$this->assertTrue(  method_exists($login, 'cookies'), 'Class does not have method cookies');
		$this->assertTrue(  method_exists($login, 'response'), 'Class does not have method response');
		$this->assertTrue(  method_exists($login, 'message'), 'Class does not have method message');
		$this->assertTrue(  method_exists($login, 'action'), 'Class does not have method action');
		$this->assertTrue(  method_exists($login, 'actionCode'), 'Class does not have method actionCode');
		$this->assertTrue(  method_exists($login, 'actionTimestamp'), 'Class does not have method actionTimestamp');
		$this->assertTrue(  method_exists($login, 'actionStatus'), 'Class does not have method actionStatus');
	}
}
