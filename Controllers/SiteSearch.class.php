<?php
/**
 * The class file for the SiteSearch class.
 *
 * @link http://www.spe.org
 * @copyright Copyright © Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <thenderson@spe.org>
 * @version $Id$
 * @since 8/13/13
 * @package CoreAPI/Controllers/Search
 */

/**
 * This class is the controller for domain scopped search results.
 *
 * @package CoreAPI/Controllers/Search
 */
class SiteSearch extends Controller {

	/** @var cx code for google site search. */
	private $__cx = GSS_CX;

	/** @var string The search string. */
	private $__q;

	/** @var string The scoped search string. */
	private $__qScoped;

	/** @var object The search object. */
	private $__search;

	/** @var string Limits the scope of the search to specific parts of the websites. */
	private $__scope;

	private $__scopeSelectorArray = array(
		'jpt' => array( 'name' => 'JPT', 'value' => GSS_SCOPE_JPT),
		'spe' => array( 'name' => 'SPEorg', 'value' => GSS_SCOPE_SPE),
		'onepetro' => array( 'name' => 'OnePetro', 'value' => GSS_SCOPE_ONEPETRO),
		'petrowiki' => array( 'name' => 'PetroWiki', 'value' => GSS_SCOPE_PETROWIKI),
		'energy4me' => array( 'name' => 'Energy4me', 'value' => GSS_SCOPE_ENERGY4ME)
	);

	/** @var string Scope selector string. */
	private $__scopeSelector;

	/** @var object The search results as a sumple xml object */
	private $__results;

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * Class constructor method.
 */
	public function __construct($formOnly = false) {
		parent::__construct();
		$options = array(
			'scopeOptions' => $this->__scopeSelectorArray,
			'formOnly' => $formOnly
		);

		if ( isset($_REQUEST['q']) && ! empty($_REQUEST['q'])) {
			$this->__q = html_entity_decode(strip_tags(trim($_REQUEST['q'])), ENT_QUOTES, 'utf-8');;

			if (empty($this->__q)) {
				$this->render($options);
				return;
			}

			foreach ($this->__scopeSelectorArray as $value) {
				$this->__q = trim(str_replace($value, '', $this->__q));
			}

			if (StringTools::startsWith($this->__q, '+')) {
				trim(str_replace('+', ' ', $this->__q));
			}

			if ( isset($_REQUEST['scope']) && ! empty($_REQUEST['scope']) && isset($this->__scopeSelectorArray[$_REQUEST['scope']])) {
				$this->__scope = $this->__scopeSelectorArray[$_REQUEST['scope']]['value'];
				$this->__scopeSelector = strip_tags(trim($_REQUEST['scope']));
			}

			if (! empty($this->__scope)) {
				$this->__qScoped = trim($this->__scope . '+' . $this->__q);
			} else {
				$this->__qScoped = $this->__q;
			}

			//Create new GoogleSiteSearch Object
			$this->__search = new GoogleSiteSearch();

			//Set the options.
			$this->__search->cx($this->__cx);
			$classMethods = get_class_methods('GoogleSiteSearch');

			foreach ($classMethods as $method) {
				if ( isset($_REQUEST[$method]) && ! is_null($_REQUEST[$method])) {
					$this->__search->$method($_REQUEST[$method]);
				}
			}
			try {
			//Perform the search, unless $formOnly is true;
			if ($formOnly !== true) {
				$this->__results = $this->__search->search($this->__qScoped);
			} else {
				$this->__results = null;
			}
			} catch (Exception $e) {
			    echo '<div class="error-box"><p>Search temporarily unavailable.</p></div> ' . "\n";
			}
			$options = array_merge($options, array(
				'q' => $this->__q,
				'qScoped' => $this->__qScoped,
				'results' => $this->__results,
				'scope' => $this->__scope,
				'scopeSelector' => $this->__scopeSelector,
				'scopeOptions' => $this->__scopeSelectorArray,
				'next' => $this->next(),
				'pageMenu' => $this->paginationMenu(),
				'prev' => $this->prev()
			));
		}
		$this->render($options);
	}

	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//------------------------------------------------------------------------------

/**
 * Renders the view.
 *
 * @access public
 * @return void
 */
	public function render($variables = null) {
		echo $this->_render($variables);
	}

/**
 * Renders Pagination Menu.
 * 
 * @access public
 * @return void
 */
	public function paginationMenu() {
		if (isset($this->__results->RES->M)) {
			$resultsPerPage = 10;
			$numResultsPages = 10;

			$param;

			if ( ! empty($this->__scopeSelector)) {
				$scope = 'scope=' . $this->__scopeSelector . '&';
			} else {
				$scope = '';
			}

			foreach ($this->__results->PARAM as $value) {
				$param[] = (array)$value;
			}

			$cx = ArrayTools::searchKeyValuePair($param, 'name', 'cx');
			$start = ArrayTools::searchKeyValuePair($param, 'name', 'start');

			$menu = '';

			if (($this->__results->RES->M / $resultsPerPage) <= $numResultsPages ) {
				$pages = ceil($this->__results->RES->M / $resultsPerPage);
				$startPage = 0;
			} else {
				$pages = $numResultsPages;
				if (($start[0]['value'] / $numResultsPages ) > 5 ) {
					$startPage = ($start[0]['value'] / $numResultsPages ) - 5;
				} else {
					$startPage = 0;
				}
			}

			if ($pages > 1) {
				for ($i = $startPage; ($i < ($pages + $startPage) || ($i == ($this->__results->RES->M / $resultsPerPage))); $i++) {
					if (($i) * $resultsPerPage == $start[0]['value']) {
						$menu .= "\t" . '<span class="pagenum current">' . ($i + 1) . '</span>' . "\n";
					} else {
						$menu .= "\t" . '<a href="?' . $scope . 'q=' . urlencode($this->__qScoped) . '&cx=' . $cx[0]['value'] . '&start=' . ($i * $resultsPerPage) . '&sa=N" class="pagenum"><strong>' . ($i + 1) . '</strong></a>' . "\n";
					}
				}
			}
			return $menu;

		} else {
			return false;
		}
	}

/**
 * Returns the url hash for the next page of search results or `false` if on last page.
 *
 * @access public
 * @return string|boolean Returns url hash for the next search page or `false`.
 */
	public function next() {
		if ( isset($this->__results->RES->NB->NU) && ! is_null($this->__results->RES->NB->NU) ) {
			$tempURL = explode('?', $this->__results->RES->NB->NU);
			$hash = '?' . $tempURL[1];

			if ( ! empty($this->__scopeSelector)) {
				$hash .= '&scope=' . urlencode($this->__scopeSelector);
			}
			return $hash;
		} else {
			return false;
		}
	}

/**
 * Returns the url hash for the previous page of search results or `false` if on first page.
 *
 * @access public
 * @return string|boolean Returns url hash for the previous search page or `false`.
 */
	public function prev() {
		if ( isset($this->__results->RES->NB->PU) && ! is_null($this->__results->RES->NB->PU) ) {
			$tempURL = explode('?', $this->__results->RES->NB->PU);
			$hash = '?' . $tempURL[1];

			if ( ! empty($this->__scopeSelector)) {
				$hash .= '&scope=' . urlencode($this->__scopeSelector);
			}
			return $hash;
		} else {
			return false;
		}
	}

	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for SiteSearch::$__cx.
 *
 * @access public
 * @param mixed Value for SiteSearch::$__cx to be set to.
 * @return mixed If no parameter are passed it returns the current value for SiteSearch::$__cx.
 */
	public function cx($value = null) {
		if (func_num_args() > 0) {
			$this->__cx = $value;
		} else {
			return $this->__cx;
		}
	}

/**
 * Getter/Setter for SiteSearch::$__search.
 *
 * @access public
 * @param mixed Value for SiteSearch::$__search to be set to.
 * @return mixed If no parameter are passed it returns the current value for SiteSearch::$__search.
 */
	public function search($value = null) {
		if (func_num_args() > 0) {
			$this->__search = $value;
		} else {
			return $this->__search;
		}
	}

/**
 * Getter/Setter for SiteSearch::$__results.
 *
 * @access public
 * @param mixed Value for SiteSearch::$__results to be set to.
 * @return mixed If no parameter are passed it returns the current value for SiteSearch::$__results.
 */
	public function results($value = null) {
		if (func_num_args() > 0) {
			$this->__results = $value;
		} else {
			return $this->__results;
		}
	}

}//end class

