Cache
===============

The Cache class creates a cached copy of the finished script, writes it to a file and the
compaires the fressness of the cache to the cache time. The cache directory needs to be
writable by apache and php.

**Example:**
<code>
// Make a unique filename for the cache file.
$cache_file = getcwd().'/cached/'.md5($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']).'_'.basename(__FILE__);

// Start caching the page.
$cache = new Cache( $cache_file, 18000 );

<!--PHP\Html Stuff Here -->

$cache->end();
</code>


* Class name: Cache





Properties
----------


### $cacheFile

```
private mixed $cacheFile = NULL
```

The location of the cache file.



* Visibility: **private**


Methods
-------


### \Cache::__construct()

```
void Cache::\Cache::__construct()($cachefile, $cachetime, $overide)
```

Creates a Cache object and begins the caching of the page.  If a fresh cached page exhiste it loads it.

**Overide Options**
|------------------------------------------------------------------------|
| Option		| Description 												|
|------------------------------------------------------------------------|
| cache 		| Forces the us of exhisting cached file if one exists. 	|
| refresh	| Forces a refresh of the cashe even if a fresh file exists.|

* Visibility: **public**

#### Arguments

* $cachefile **mixed**
* $cachetime **mixed**
* $overide **mixed**



### \Cache::cacheFile()

```
bool|string Cache::\Cache::cacheFile()(string $file)
```

If no parameters are passed it returns the current value for Cache::$cacheFile, or set the it to the passed param.



* Visibility: **public**

#### Arguments

* $file **string** - &lt;p&gt;The full filename and location. Ex: /webroot/Cache/cachefile.php&lt;/p&gt;




### \Cache::end()

```
void Cache::\Cache::end()()
```

Writes the cache file and prints the outputs the finished script results.

**REQUIRED** for page to load correctly!!

* Visibility: **public**


