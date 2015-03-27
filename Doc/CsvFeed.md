CsvFeed
===============

Class for retrieving and processing csv feeds.




* Class name: CsvFeed
* This class implements: ArrayAccess, Iterator




Properties
----------


### $__container

```
private array $__container = array()
```





* Visibility: **private**


### $__position

```
private int $__position
```





* Visibility: **private**


Methods
-------


### \CsvFeed::__construct()

```
void CsvFeed::\CsvFeed::__construct()($url)
```

Retrieves a csv file from a url then processes it into an array.  Assuming the first line is the
column template.

**Example**
<code>
$csv_feed = new CsvFeed('http://example.com/test.txt');

foreach ($csv_feed as $key => $value){
  echo 'Key: ' + $key + "\n";
  var_dump($value);
}
</code>

* Visibility: **public**

#### Arguments

* $url **mixed**



### \CsvFeed::offsetSet()

```
void CsvFeed::\CsvFeed::offsetSet()($offset, $value)
```

Assigns a value to the specified offset.



* Visibility: **public**

#### Arguments

* $offset **mixed**
* $value **mixed**



### \CsvFeed::offsetExists()

```
void CsvFeed::\CsvFeed::offsetExists()($offset)
```

Whether or not an offset exists.

This method is executed when using isset() or empty() on objects implementing ArrayAccess.

* Visibility: **public**

#### Arguments

* $offset **mixed**



### \CsvFeed::offsetUnset()

```
void CsvFeed::\CsvFeed::offsetUnset()($offset)
```

Unsets an offset.



* Visibility: **public**

#### Arguments

* $offset **mixed**



### \CsvFeed::offsetGet()

```
void CsvFeed::\CsvFeed::offsetGet()($offset)
```

Returns the value at specified offset.

This method is executed when checking if offset is empty().

* Visibility: **public**

#### Arguments

* $offset **mixed**



### \CsvFeed::rewind()

```
void CsvFeed::\CsvFeed::rewind()()
```

Rewinds back to the first element of the Iterator



* Visibility: **public**



### \CsvFeed::current()

```
mixed CsvFeed::\CsvFeed::current()()
```

Returns the current element.



* Visibility: **public**



### \CsvFeed::key()

```
scalar CsvFeed::\CsvFeed::key()()
```

Returns the key of the current element.



* Visibility: **public**



### \CsvFeed::next()

```
void CsvFeed::\CsvFeed::next()()
```

Moves the current position to the next element.



* Visibility: **public**



### \CsvFeed::valid()

```
boolean CsvFeed::\CsvFeed::valid()()
```

Checks if current position is valid.



* Visibility: **public**



### \CsvFeed::_newlineType()

```
mixed CsvFeed::\CsvFeed::_newlineType()($string)
```

Detects the newline character of a given string.



* Visibility: **protected**

#### Arguments

* $string **mixed**



### \CsvFeed::_curl()

```
string CsvFeed::\CsvFeed::_curl()($url)
```

Send a web requst using curl



* Visibility: **protected**

#### Arguments

* $url **mixed**


