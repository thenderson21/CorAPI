<?php
/**
 * File for GoogleSiteSearch class.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 8/13/13
 * @package CoreAPI/Libraries/Search
 */

/**
 *
 * @package CoreAPI/Libraries/Search
 */
class GoogleSiteSearch {

	//------------------------------------------------------------------------------
	//!**** Private Variables ****
	//------------------------------------------------------------------------------

	/**@var string Default url to google's custom search REST service. */
	private $__url = GSS_URL;

/**
 * Enables or disables Simplified and Traditional Chinese Search.
 * The default value for this parameter is 0 (zero), meaning that the feature is enabled. Supported values are:
 * -`1:` Disabled
 * -`0:` Enabled (default)
 * @var int
 */
	private $__c2coff;

/**
 * **Required**. The client parameter must be set to google-csbe.
 *
 * @var string
 */
	private $__client = 'google-csbe';

/**
 * Country restrict(s).
 * The cr parameter restricts search results to documents originating in a particular country.
 * You may use [Boolean operators](https://developers.google.com/custom-search/docs/xml_results#booleanOperators)
 * in the cr parameter's value.
 * Google WebSearch determines the country of a document by analyzing:
 * -the top-level domain (TLD) of the document's URL.
 * -the geographic location of the Web server's IP address.
 * See the [Country (cr) Parameter Values](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#countryCollections)
 * section for a list of valid values for this parameter.
 *
 * @var string
 */
	private $__cr;

/**
 * **Required**. The cx parameter specifies a unique code that identifies a custom
 * search engine. You must specify a Custom Search Engine using the cx parameter
 * to retrieve search results from that CSE.
 * To find the value of the cx parameter, go to Control Panel > Codes tab of your
 * CSE and you will find it in the text area under 'Paste this code in the page
 * where you'd like your search box to appear. The search results will be shown on a
 * Google-hosted page.'
 *
 * @var string
 */
	private $__cx;

/**
 * The filter parameter activates or deactivates the automatic filtering of Google search results. See
 * [Automatic Filtering](https://developers.google.com/custom-search/docs/xml_results#automaticFiltering)
 * for more information about Google's search results filters. Note that host crowding filtering applies
 * only to multi-site searches.
 * Valid values for the parameter are:
 * -`filter=0` - Turns off the duplicate content filter
 * -`filter=1` - Turns on the duplicate content filter (default)
 * By default, Google applies filtering to all search results to improve the quality of those results.
 *
 * @var string
 */
	private $__filter = 0;

/**
 * API key. **REQUIRED** unless you provide an OAuth 2.0 token. Your API
 * key identifies your project and provides you with API access, quota, and reports.
 *
 * @var string
 */
	private $__key;

/**
 * @var string Returns the response in a human-readable format if `true`.
 * **NOTE:** MUST BE STRING
 */
	private $__prettyPrint = 'true';

/**
 * @var string Parameter that determines which of Google’s vertical search engines are suggested in the left
 * sidebar besides web, they can be combined, the most important ones are:
 * | Value	| Description			|
 * | prmd=a | only applications 	|
 * | prmd=b | only books 			|
 * | prmd=c | only places 			|
 * | prmd=d | only discussions 		|
 * | prmd=i | only images 			|
 * | prmd=n | only news 			|
 * | prmd=s | only shopping 		|
 * | prmd=p | only patents 			|
 * | prmd=u | none (only web) 		|
 * | prmd=v | only video   			|
 */
	private $__prmd;

/**
 * Alternative to userIp. Lets you enforce per-user quotas from a server-side
 * application even in cases when the user's IP address is unknown.This can occur,
 * for example, with applications that run cron jobs on App Engine on a user's
 * behalf. You can choose any arbitrary string that uniquely identifies a user,
 * but it is limited to 40 characters. Overrides `userIp` if both are provided.
 *
 * @var string
 */
	private $__quotaUser;

/**
 * IP address of the end user for whom the API call is being made. Lets you
 * enforce per-user quotas when calling the API from a server-side application.
 * @var string
 */
	private $__userIp;

/**
 * Geolocation of end user. The `gl` parameter value is a two-letter country code. The `gl` parameter boosts
 * search results whose country of origin matches the parameter value. See the
 * [Country Codes](https://developers.google.com/custom-search/docs/xml_results#countryCodes) page for a
 * list of valid values.
 * Specifying a `gl` parameter value should lead to more relevant results. This is particularly true for
 * international customers and, even more specifically, for customers in English- speaking countries other
 * than the United States.
 *
 * @var string
 */
	private $__gl;

/**
 * The interface language.	Explicitly setting this parameter improves the performance and the quality of
 * your search results. See the
 * [Interface Languages](https://developers.google.com/custom-search/docs/xml_results#wsInterfaceLanguages)
 * section of
 * [Internationalizing Queries and Results Presentation](https://developers.google.com/custom-search/docs/xml_results#wsInternationalizing)
 * for more information, and [Supported Interface Languages](https://developers.google.com/custom-search/docs/xml_results#interfaceLanguages)
 * for a list of supported languages.
 *
 * @var string
 */
	private $__hl;

/**
 * Appends terms to query. Appends the specified query terms to the query, as if they were combined
 * with a logical AND operator.
 *
 * @var string
 */
	private $__hq;

/**
 * The `ie` parameter sets the character encoding scheme that should be used to
 * interpret the query string. The default `ie` value is `latin1`.
 * See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#wsCharacterEncoding)
 * section for a discussion of when you might need to use this parameter.
 * See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#characterEncodings)
 * Schemes section for the list of possible ie values.
 *
 * @var string
 */
	private $__ie;

/**
 * You can restrict the search to documents written in a particular language (e.g., `lr=lang_ja`).
 * Google WebSearch determines the language of a document by analyzing:
 * -the top-level domain (TLD) of the document's URL
 * -language meta tags within the document
 * -the primary language used in the body text of the document
 * -secondary languages, if any, used in the body text of the document
 * See the [Language (lr) Collection Values](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#languageCollections)
 * section for a list of valid values for this parameter.
 *
 * @var string
 */
	private $__lr;

/**
 * Number of search results to return. You can specify the how many results to
 * return for the current search. The default num value is 10, and the maximum
 * value is 20. If you request more than 20 results, only 20 results will be returned.
 *
 * @var int
 */
	private $__num;

/**
 * The `oe` parameter sets the character encoding scheme that should be used to decode the
 * XML result. The default oe value is `latin1`.
 * See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#wsCharacterEncoding)
 * section for a discussion of when you might need to use this parameter.
 * See the [Character Encoding Schemes](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#characterEncodings)
 * section for the list of possible oe values.
 *
 * @var string
 */
	private $__oe;

/**
 * **Required** The `output` parameter specifies the format of the XML results.
 * The only valid values for this parameter are `xml` and `xml_no_dtd`.
 * The chart below explains how these parameter values differ.
 * | **Value**		| **Output Format**															|
 * | `xml_no_dtd` 	| The XML results will not include a !DOCTYPE statement. **(Recommended)**	|
 * | `xml`			| The XML results will contain a Google DTD reference. The second line of the result will identify the document definition type (DTD) that the results use: `<!DOCTYPE GSP SYSTEM "google.dtd">` |
 * @var string
 */
	private $__output = 'xml_no_dtd';

/**
 * Query. The search expression.
 *
 * @var string
 */
	private $__q;

/**
 * Search safety level. You can specify the
 * [search safety level](https://developers.google.com/custom-search/docs/xml_results#safeSearchLevels).
 * Possible values are:
 * -`high` - enables highest level of safe search filtering.
 * -`medium` - enables moderate safe search filtering.
 * -`off` - disables safe search filtering.
 * If `safe` is not specified, a value of `off` is assumed.
 *
 * @var string
 */
	private $__safe;

/**
 * The index of the first result to return. You can set the start index
 * of the first search result returned. Valid values are integers between
 * 1 and (101 - `num`). If start is not used, a value of 1 is assumed.
 *
 * @var int
 */
	private $__start;

/**
 * The `sort` parameter specifies that the results be sorted according to the
 * specified expression. For example, sort by date.
 *
 * @var string
 */
	private $__sort;

	/**@var The search results in SimpleXML object.  */
	private $__results;

/**
 *  The ud parameter indicates whether the XML response should include the I
 * DN-encoded URL for the search result. IDN (International Domain Name)
 * encoding allows domains to be displayed using local languages, for example:
 * <br><br>http://www.花井鮨.com<br><br>
 * Valid values for this parameter are `1` (default), meaning the XML result
 * should include IDN-encoded URLs, and 0, meaning the XML result should not
 *include IDN-encoded URLs. If the ud parameter is set to 1, the IDN-encoded
 * URL will appear in in the UD tag in your XML results. If the `ud` parameter
 * is set to `0`, the URL in the example above would be displayed as:<br>
 * <br>http://www.xn--elq438j.com <br> **Note:** This is a beta feature.
 *
 * @var string
 */
	private $__ud;

	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//------------------------------------------------------------------------------

/**
 * Searches for a given search string/
 *
 * @access public
 * @param string String to be queried.
 * @return object Returns SimpleXML object representing the results.
 * @throws Exception When an exception is encountered.
 */
	public function search($queryString = null) {
		
		if ($queryString !== null) {
			$this->__q = $queryString;
		}
		if ( empty($this->__q) || is_null($this->__q) || ! is_string($this->__q)) {
			throw new Exception('GoogleSiteSearch::q must be a string and cannot be empty or null.');
		}

		if ( empty($this->__cx) || is_null($this->__cx) || ! is_string($this->__cx)) {
			throw new Exception('GoogleSiteSearch::cx must be a string and cannot be empty or null.');
		}

		if ( empty($this->__client) || is_null($this->__client) || ! is_string($this->__client)) {
			throw new Exception('GoogleSiteSearch::client must be a string and cannot be empty or null.');
		}

		if ( empty($this->__output) || is_null($this->__output) || ! is_string($this->__output)) {
			throw new Exception('GoogleSiteSearch::output must be a string and cannot be empty or null.');
		}

		$this->__q = str_replace(' ', '+', $this->__q);
		
		$curlRequest = new Curl($this->__buildUrlString());
		$this->__results = new SimpleXMLElement($curlRequest->body());

		if ($curlRequest->errno()) {
			throw new Exception("Curl Error: " . $curlRequest->error());
		}
	
		return $this->__results;
	}

	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//------------------------------------------------------------------------------

/**
 * Generates a google site search string url from given paramenters
 *
 * @access private
 * @return string Returns the url for a search request.
 */
	private function __buildUrlString() {
		$objectVars = get_object_vars($this);

		//if parameter is the first one added to the url.
		$firstVar = true;
		$url = $this->__url;

		foreach ($objectVars as $key => $value) {
			if (isset($value) && !is_null($value) && $key !== '__url') {
				$key = preg_replace('/^(__|_)/', '', $key);

				if ($firstVar) {
					$url .= '?' . $key . '=' . $value;
				} else {
					$url .= '&' . $key . '=' . $value;
				}
				$firstVar = false;
			}
		}

		return $url;
	}

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for GoogleSiteSearch::$__url.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__url to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__url.
 */
	public function url($value = null) {
		if (func_num_args() > 0) {
			$this->__url = $value;
		} else {
			return $this->__url;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__c2coff.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__c2coff to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__c2coff.
 */
	public function c2coff($value = null) {
		if (func_num_args() > 0) {
			$this->__c2coff = $value;
		} else {
			return $this->__c2coff;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$_client.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$_client to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$_client.
 */
	public function client($value = null) {
		if (func_num_args() > 0) {
			$this->__client = $value;
		} else {
			return $this->__client;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__cr.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__cr to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__cr.
 */
	public function cr($value = null) {
		if (func_num_args() > 0) {
			$this->__cr = $value;
		} else {
			return $this->__cr;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__cx.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__cx to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__cx.
 */
	public function cx($value = null) {
		if (func_num_args() > 0) {
			$this->__cx = $value;
		} else {
			return $this->__cx;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__filter.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__filter to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__filter.
 */
	public function filter($value = null) {
		if (func_num_args() > 0) {
			$this->__filter = $value;
		} else {
			return $this->__filter;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__key.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__key to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__key.
 */
	public function key($value = null) {
		if (func_num_args() > 0) {
			$this->__key = $value;
		} else {
			return $this->__key;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__prettyPrint.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__prettyPrint to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__prettyPrint.
 */
	public function prettyPrint($value = null) {
		if (func_num_args() > 0) {
			$this->__prettyPrint = $value;
		} else {
			return $this->__prettyPrint;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__prmd.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__prmd to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__prmd.
 */
	public function prmd($value = null) {
		if (func_num_args() > 0) {
			$this->__prmd = $value;
		} else {
			return $this->__prmd;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__quotaUser.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__quotaUser to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__quotaUser.
 */
	public function quotaUser($value = null) {
		if (func_num_args() > 0) {
			$this->__quotaUser = $value;
		} else {
			return $this->__quotaUser;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__userIp.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__userIp to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__userIp.
 */
	public function userIp($value = null) {
		if (func_num_args() > 0) {
			$this->__userIp = $value;
		} else {
			return $this->__userIp;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__gl.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__gl to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__gl.
 */
	public function gl($value = null) {
		if (func_num_args() > 0) {
			$this->__gl = $value;
		} else {
			return $this->__gl;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__hl.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__hl to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__hl.
 */
	public function hl($value = null) {
		if (func_num_args() > 0) {
			$this->__hl = $value;
		} else {
			return $this->__hl;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__hq.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__hq to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__hq.
 */
	public function hq($value = null) {
		if (func_num_args() > 0) {
			$this->__hq = $value;
		} else {
			return $this->__hq;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__ie.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__ie to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__ie.
 */
	public function ie($value = null) {
		if (func_num_args() > 0) {
			$this->__ie = $value;
		} else {
			return $this->__ie;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__lr.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__lr to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__lr.
 */
	public function lr($value = null) {
		if (func_num_args() > 0) {
			$this->__lr = $value;
		} else {
			return $this->__lr;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__num.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__num to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__num.
 */
	public function num($value = null) {
		if (func_num_args() > 0) {
			$this->__num = $value;
		} else {
			return $this->__num;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__oe.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__oe to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__oe.
 */
	public function oe($value = null) {
		if (func_num_args() > 0) {
			$this->__oe = $value;
		} else {
			return $this->__oe;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__output.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__output to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__output.
 */
	public function output($value = null) {
		if (func_num_args() > 0) {
			$this->__output = $value;
		} else {
			return $this->__output;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__q.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__q to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__q.
 */
	public function q($value = null) {
		if (func_num_args() > 0) {
			$this->__q = $value;
		} else {
			return $this->__q;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__safe.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__safe to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__safe.
 */
	public function safe($value = null) {
		if (func_num_args() > 0) {
			$this->__safe = $value;
		} else {
			return $this->__safe;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__start.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__start to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__start.
 */
	public function start($value = null) {
		if (func_num_args() > 0) {
			$this->__start = $value;
		} else {
			return $this->__start;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__sort.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__sort to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__sort.
 */
	public function sort($value = null) {
		if (func_num_args() > 0) {
			$this->__sort = $value;
		} else {
			return $this->__sort;
		}
	}

/**
 * Getter/Setter for GoogleSiteSearch::$__ud.
 *
 * @access public
 * @param mixed Value for GoogleSiteSearch::$__ud to be set to.
 * @return mixed If no parameter are passed it returns the current value for GoogleSiteSearch::$__ud.
 */
	public function ud($value = null) {
		if (func_num_args() > 0) {
			$this->__ud = $value;
		} else {
			return $this->__ud;
		}
	}

} //end Class