<?php
/**
 * Controller Class Unit Test
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/8/13
 */

require_once ("CoreAPI/common.ini.php");

class ControllerTest extends Controller{
	public function render($options){
	 	return $this->_render($options);
	}
}

class ControllerClassTest extends PHPUnit_Framework_TestCase {
//http://dev.spe.org/sitemap/search.php?q=jpt&client=google-csbe&cx=009616206375539138862:_7f3pu6glfg&output=xml_no_dtd&ie=UTF-8&prmd=ivns&ei=g58DUrTDHcG8yAGKwoFw&start=20&sa=natcasesort
	
	public function	testRender(){
	 	$optionObject = json_decode('{
    "string": "This is a string",
    "number": 5,
    "object": {
        "key": "value",
        "key1": "value1"
    },
    "array": [
        "value",
        "value2"
    ]
}');
	 	
	 	$controller = new ControllerTest;
	 	
	 	$results = $controller->render($optionObject);
	 	$resultsObject = json_decode($results);
	 	$this->assertJsonStringEqualsJsonString( json_encode($optionObject),  json_encode($resultsObject->options));
 	}	
}