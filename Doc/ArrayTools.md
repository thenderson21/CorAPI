ArrayTools
===============

ArrayTools contains useful methods for working with php arrays that are not built into the core php code.




* Class name: ArrayTools







Methods
-------


### \ArrayTools::arrayKeysMulti()

```
array ArrayTools::\ArrayTools::arrayKeysMulti()(array $array)
```

Get list of all keys of a multidimentional array



* Visibility: **public**
* This method is **static**.

#### Arguments

* $array **array**



### \ArrayTools::swapValueByIndex()

```
array ArrayTools::\ArrayTools::swapValueByIndex()(array $array, $from, $to)
```

Swaps array element by index.  Only works with numerically, contiguously-indexed arrays.

**Example:**
````
$arr = array('red', 'green', 'blue', 'yellow');

echo implode(',', $arr); // red,green,blue,yellow

// Move 'blue' to the beginning
$arr = moveValueByIndex($arr, 2, 0);

echo implode(',', $arr); // blue,red,green,yellow
````

* Visibility: **public**
* This method is **static**.

#### Arguments

* $array **array**
* $from **mixed**
* $to **mixed**



### \ArrayTools::inArrayRecursive()

```
bool ArrayTools::\ArrayTools::inArrayRecursive()($needle, $haystack)
```

Checks if a value exists in an array recursivly.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $needle **mixed**
* $haystack **mixed**



### \ArrayTools::inArrayNoCase()

```
bool ArrayTools::\ArrayTools::inArrayNoCase()($needle, $haystack)
```

Checks if a case insensitive string value exists in an array.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $needle **mixed**
* $haystack **mixed**



### \ArrayTools::arraySearchNoCase()

```
mixed ArrayTools::\ArrayTools::arraySearchNoCase()($needle, $haystack)
```

Searches the array for a given case insensitive string and returns the corresponding key if successful



* Visibility: **public**
* This method is **static**.

#### Arguments

* $needle **mixed**
* $haystack **mixed**



### \ArrayTools::searchKeyValuePair()

```
array|boolean ArrayTools::\ArrayTools::searchKeyValuePair()(array $haystack, mixed $key, mixed $value)
```

Recursivly searches through and array for a key value pair and return an array of matched arrays.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $haystack **array** - &lt;p&gt;Array to be searched.&lt;/p&gt;
* $key **mixed** - &lt;p&gt;The array key to be matched.&lt;/p&gt;
* $value **mixed** - &lt;p&gt;The array value to be mateched.&lt;/p&gt;


