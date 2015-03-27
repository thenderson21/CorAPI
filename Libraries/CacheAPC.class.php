<?php
/**
 *	The file that contains the CacheAPC class
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 11/21/12
 * @package CoreAPI/Libraries/Cacheing
 */
 
/**
 * A class for working with memory using APC caching system
 *
 * @package CoreAPI/Libraries/Cacheing
 */
class CacheAPC {
	private $timeToLive = 600; // Time To Live
	private $enabled = false; // APC enabled?

	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

/**
 * __construct function.
 *
 * @access public
 * @param mixed $username
 * @param mixed $password
 * @return void
 */
	function __construct() {
		$this->enabled = extension_loaded('apc');
	}

	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//------------------------------------------------------------------------------

/**
 * Checks if one or more APC keys exist.
 * 
 * @access public
 * @param string|array A string, or an array of strings, that contain keys.
 * @return bool|array TRUE if the key exists, otherwise FALSE Or if an array was passed to keys, then an array is returned that contains all existing keys, or an empty array if none exist.
 */
	public function exists($key){
		return apc_exists($key);
	}

	
/**
 * Returns the value of a key if no `$data` is passed, or if so set the value. 
 * 
 * @access public
 * @param mixed The name of the key.
 * @param mixed Value
 * @return mixed Returns the value of the key or a boolean if value is set.
 */
	public function data($key, $value = null) {
		switch (func_num_args()) {
			case 1:
				$res = false;
				$value = apc_fetch($key, $res);
				return ($res) ? $value : $res;
			
			case 2:
				return apc_store($key, $value, $this->timeToLive);
			
			default:
				return false;
		}
	}
	 
/**
 * Returns an APCIterator object of keys matching the search string.
 * 
 * @access public
 * @param string 'user' or 'file'
 * @param string Search string or regular expression.
 * @return APCIterator Returns an APCIterator object of keys matching the search string.
 */
	 public function find($cache, $search) {
	  return new APCIterator($cache, $search);
  }

/**
 * Delete data from memory.
 * 
 * @access public
 * @param mixed Key of stored item to be deleated from memory.
 * @return boolean Returns `true` on successfully deletion or `false` on faliure.
 */
	public function info($key) {
		$cacheInfo = apc_cache_info('user');
		Debug::dump($cacheInfo);		
		//return $dataInfo;
	}

/**
 * Return the time a key was created.
 *
 * @param mixed The name of the key.
 * @return boolean|int Returns `false` when no keys are cached or when the key does not 
 * exist an integer (unix timestamp) otherwise.
 */
	public function createdTime($key) {
		$cache = apc_cache_info('user');
		if (empty($cache['cache_list'])) {
			return false;
		}
		foreach ($cache['cache_list'] as $entry) {
			if ($entry['info'] != $key) {
				continue;
			}
			return $entry['creation_time'];
		}
		return false;
	}

/**
 * Return the last time a key was modified.
 *
 * @param mixed The name of the key.
 * @return boolean|int Returns `false` when no keys are cached or when the key does not 
 * exist an integer (unix timestamp) otherwise.
 */
	public function modifiedTime($key) {
		$cache = apc_cache_info('user');
		if (empty($cache['cache_list'])) {
			return false;
		}
		foreach ($cache['cache_list'] as $entry) {
			if ($entry['info'] != $key) {
				continue;
			}
			return $entry['mtime'];
		}
		return false;
	}

/**
 * Return the last time a key was modified.
 *
 * @param mixed The name of the key.
 * @return boolean|int Returns `false` when no keys are cached or when the key does not 
 * exist an integer (unix timestamp) otherwise.
 */
	public function accessTime($key) {
		$cache = apc_cache_info('user');
		if (empty($cache['cache_list'])) {
			return false;
		}
		foreach ($cache['cache_list'] as $entry) {
			if ($entry['info'] != $key) {
				continue;
			}
			return $entry['access_time'];
		}
		return false;
	}

/**
 * Return a key's expiration time.
 *
 * @param mixed The name of the key.
 * @return boolean|int Returns `false` when no keys are cached or when the key does not 
 * exist. Returns `int 0` when the key never expires (ttl = 0) or an integer (unix 
 * timestamp) otherwise.
 */
	public function expires($key) {
		$cache = apc_cache_info('user');
		if (empty($cache['cache_list'])) {
			return false;
		}
		foreach ($cache['cache_list'] as $entry) {
			if ($entry['info'] != $key) {
				continue;
			}
			if ($entry['ttl'] == 0) {
				return 0;
			}
			$expire = $entry['creation_time']+$entry['ttl'];
			return $expire;
		}
		return false;
	}	

/**
 * Delete data from memory.
 * 
 * @access public
 * @param mixed Key of stored item to be deleated from memory.
 * @return boolean Returns `true` on successfully deletion or `false` on faliure.
 */
	public function delete($key) {
		return (apc_exists($key)) ? apc_delete($key) : true;
	}
	
	//------------------------------------------------------------------------------
	//!**** Getter/Setters Methods ****
	// Note: Getter/Setters were generated by a plugin script.
	//------------------------------------------------------------------------------

/**
 * Getter/Setter for CacheAPC::$timeToLive.
 * 
 * @access public
 * @param mixed Value for CacheAPC::$timeToLive to be set to.
 * @return mixed If no parameter are passed it returns the current value for CacheAPC::$timeToLive.
 */
	public function timeToLive($value = null) {
		if (func_num_args() > 0) {
			$this->timeToLive = $value;
		} else {
			return $this->timeToLive;
		}
	}

/**
 * Getter/Setter for CacheAPC::$enabled.
 * 
 * @access public
 * @param mixed Value for CacheAPC::$enabled to be set to.
 * @return mixed If no parameter are passed it returns the current value for CacheAPC::$enabled.
 */
	public function enabled($value = null) {
		if (func_num_args() > 0) {
			$this->enabled = $value;
		} else {
			return $this->enabled;
		}
	}


}
