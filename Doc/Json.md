Json
===============

JsonHandler class contain methods parcing json statements.




* Class name: Json





Properties
----------


### $_messages

```
protected array $_messages = array(JSON_ERROR_NONE => 'No error has occurred', JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded', JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON', JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded', JSON_ERROR_SYNTAX => 'Syntax error', JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded')
```





* Visibility: **protected**
* This property is **static**.


Methods
-------


### \Json::encode()

```
string|boolean Json::\Json::encode()($value, int $options)
```

Returns a string containing the JSON representation of `$value`.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $value **mixed**
* $options **int** - &lt;p&gt;(default: 0)&lt;/p&gt;




### \Json::decode()

```
mixed Json::\Json::decode()(mixed $json, bool $assoc)
```

Takes a JSON encoded string and converts it into a PHP variable.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $json **mixed**
* $assoc **bool** - &lt;p&gt;(default: false)&lt;/p&gt;



