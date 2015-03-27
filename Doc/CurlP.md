CurlP
===============

The CurlP class contains classes and methods for the parrallel retrieving of
multiple requests simultaneously.

**GET Example:**
<code>
$urls = array('http://staging.spe.org/jpt/content/cat/f/feed/json/?s_Tag=2012-2013-11',
 'http://staging.spe.org/jpt/content/cat/tf/feed/json/?s_Tag=2012-2013-11',
 'http://staging.spe.org/jpt/content/cat/d/feed/json/?s_Tag=2012-2013-11');

$feed =  new CurlP( $urls );

echo '<pre>';
var_dump( $feed );
echo "</pre>";
</code>

**POST Example:**
<code>
$data = array(array(),array());

$data[0]['url']  = 'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction';
$data[0]['post'] = array();
$data[0]['post']['appid']   = 'YahooDemo';
$data[0]['post']['output']  = 'php';
$data[0]['post']['context'] = 'Now I lay me down to sleep,
                               I pray the Lord my soul to keep;
                               And if I die before I wake,
                               I pray the Lord my soul to take.';

$data[1]['url']  = 'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction';
$data[1]['post'] = array();
$data[1]['post']['appid']   = 'YahooDemo';
$data[1]['post']['output']  = 'php';
$data[1]['post']['context'] = 'Now I lay me down to sleep,
                               I pray the funk will make me freak;
                               If I should die before I waked,
                               Allow me Lord to rock out naked.';

$r = multiRequest($data);

print_r($r);
</code>


* Class name: CurlP





Properties
----------


### $data

```
private mixed $data
```





* Visibility: **private**


Methods
-------


### \CurlP::__construct()

```
void CurlP::\CurlP::__construct()(mixed $data, array $options)
```

__construct function.



* Visibility: **public**

#### Arguments

* $data **mixed**
* $options **array**



### \CurlP::getData()

```
string|array CurlP::\CurlP::getData()()
```

Gets the current value for CurlP::$data.



* Visibility: **public**


