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

class GoogleSiteSearchClassTest extends PHPUnit_Framework_TestCase {

	protected $_googleSearch;

	protected function setUp() {
		$this->_googleSearch = new GoogleSiteSearch;
		$this->_googleSearch->cx('009616206375539138862:_7f3pu6glfg&alt');
	}

	public function testSearch() {
		$this->assertInstanceOf('SimpleXMLElement', $this->_googleSearch->search('hse'));
	}

	public function testSearchUrlException() {
		$this->setExpectedException('Exception');

		$this->_googleSearch->url('BadURL');
		$this->_googleSearch->search('hse');
	}

	public function testSearchCxException() {
		$this->setExpectedException('Exception');

		$this->_googleSearch->cx('BAD');
		$this->_googleSearch->search('hse');
	}	

	public function testSearchQException() {
		$this->setExpectedException('Exception');

		$this->_googleSearch->q(null);
		$this->_googleSearch->search();
	}

}//end class

