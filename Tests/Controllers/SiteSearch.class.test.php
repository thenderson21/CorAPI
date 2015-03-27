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

class SiteSearchClassTest extends PHPUnit_Framework_TestCase {
//http://dev.spe.org/sitemap/search.php?q=jpt&client=google-csbe&cx=009616206375539138862:_7f3pu6glfg&output=xml_no_dtd&ie=UTF-8&prmd=ivns&ei=g58DUrTDHcG8yAGKwoFw&start=20&sa=natcasesort
	

	public function testPost() {
		$_REQUEST = array(
			'q' => 'jpt',
			'client'=> 'google-csbe',
			'cx' => '009616206375539138862:_7f3pu6glfg',
			'output' => 'xml_no_dtd',
			'ie' => 'UTF-8',
			'prmd' => 'ivns',
			'ei' => 'g58DUrTDHcG8yAGKwoFw',
			'start' => '20',
			'sa' => 'natcasesort'

		);
		ob_start();
		$search = new SiteSearch();
		ob_end_clean();
		
		$this->assertInstanceOf('SimpleXMLElement', $search->results());
		$this->assertInstanceOf('GoogleSiteSearch', $search->search());		
	}
	
	public function testPostNoQ() {
		if (isset($_REQUEST)){
			unset($_REQUEST);
		} 		
		$_REQUEST = array(
			'q' => '',
			'client'=> 'google-csbe',
			'cx' => '009616206375539138862:_7f3pu6glfg',
			'output' => 'xml_no_dtd',
			'ie' => 'UTF-8',
			'prmd' => 'ivns',
			'ei' => 'g58DUrTDHcG8yAGKwoFw',
			'start' => '20',
			'sa' => 'natcasesort'

		);
		ob_start();
		$search = new SiteSearch();
		ob_end_clean();	
	}

	public function testPostQisSpace() {
		if (isset($_REQUEST)){
			unset($_REQUEST);
		} 		
		$_REQUEST = array(
			'q' => ' ',
			'client'=> 'google-csbe',
			'cx' => '009616206375539138862:_7f3pu6glfg',
			'output' => 'xml_no_dtd',
			'ie' => 'UTF-8',
			'prmd' => 'ivns',
			'ei' => 'g58DUrTDHcG8yAGKwoFw',
			'start' => '20',
			'sa' => 'natcasesort'

		);
		ob_start();
		$search = new SiteSearch();
		ob_end_clean();	
	}

	public function testNoPostVar() {
		if (isset($_REQUEST)){
			unset($_REQUEST);
		}  
		ob_start();
		$search = new SiteSearch();
		ob_end_clean();
	}


}