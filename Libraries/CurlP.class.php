<?php
/**
 * File containing the CurlP class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 11/19/12
 * @package CoreAPI/WebTools
 */

/**
 * The CurlP class contains classes and methods for the parrallel retrieving of
 * multiple requests simultaneously.
 *
 * **GET Example:**
 * <code>
 * $urls = array('http://staging.spe.org/jpt/content/cat/f/feed/json/?s_Tag=2012-2013-11',
 *  'http://staging.spe.org/jpt/content/cat/tf/feed/json/?s_Tag=2012-2013-11',
 *  'http://staging.spe.org/jpt/content/cat/d/feed/json/?s_Tag=2012-2013-11');
 *
 * $feed =  new CurlP( $urls );
 *
 * echo '<pre>';
 * var_dump( $feed );
 * echo "</pre>";
 * </code>
 *
 * **POST Example:**
 * <code>
 * $data = array(array(),array());
 * 
 * $data[0]['url']  = 'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction';
 * $data[0]['post'] = array();
 * $data[0]['post']['appid']   = 'YahooDemo';
 * $data[0]['post']['output']  = 'php';
 * $data[0]['post']['context'] = 'Now I lay me down to sleep,
 *                                I pray the Lord my soul to keep;
 *                                And if I die before I wake,
 *                                I pray the Lord my soul to take.';
 * 
 * $data[1]['url']  = 'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction';
 * $data[1]['post'] = array();
 * $data[1]['post']['appid']   = 'YahooDemo';
 * $data[1]['post']['output']  = 'php';
 * $data[1]['post']['context'] = 'Now I lay me down to sleep,
 *                                I pray the funk will make me freak;
 *                                If I should die before I waked,
 *                                Allow me Lord to rock out naked.';
 * 
 * $r = multiRequest($data);
 * 
 * print_r($r);
 * </code>
 *
 * @package CoreAPI/WebTools
 * @todo Bring up to current coding standards. 
 */
class CurlP {

	/** @var mixed Data returned from curl requests. */
	private $data;

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $data
	 * @param array $options 
	 * @return void
	 */
	function __construct( $data, $options = array() ) {
		// Array of curl handles
		$curly = array();
		// data to be returned
		$result = array();

		// Parrallel processing multi handler.
		$multiHandler = curl_multi_init();

		// loop through $data and create curl handles
		// then add them to the multi-handle
		foreach ($data as $key=>$dataValue) {

			$curly[$key] = curl_init();

			$url = ( is_array( $dataValue ) && !empty( $dataValue['url'] ) ) ? $dataValue['url'] : $dataValue;

			curl_setopt($curly[$key], CURLOPT_URL,            $url);
			curl_setopt($curly[$key], CURLOPT_HEADER,         0);
			curl_setopt($curly[$key], CURLOPT_RETURNTRANSFER, 1);

			// post?
			if (is_array($dataValue)) {
				if (!empty($dataValue['post'])) {
					curl_setopt($curly[$key], CURLOPT_POST,       1);
					curl_setopt($curly[$key], CURLOPT_POSTFIELDS, $dataValue['post']);
				}
			}

			// extra options?
			if (!empty($options)) {
				curl_setopt_array($curly[$key], $options);
			}

			curl_multi_add_handle($multiHandler, $curly[$key]);
		}

		// execute the handles
		$running = null;
		do {
			curl_multi_exec($multiHandler, $running);
		} while ($running > 0);

		// get content and remove handles
		foreach ($curly as $key => $c) {
			$result[$key] = curl_multi_getcontent($c);
			curl_multi_remove_handle($multiHandler, $c);
		}

		// all done
		curl_multi_close($multiHandler);

		$this->data = $result;
		return $this->data;
	}

	/**
	 * Gets the current value for CurlP::$data.
	 * 
	 * @return string|array Returns data extracted by CurlP on construction. 
	 */
	public function getData() {
		return $this->data;
	}



}//end Class
