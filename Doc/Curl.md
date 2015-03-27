Curl
===============

Class for performing curl requests.




* Class name: Curl





Properties
----------


### $__defaults

```
private mixed $__defaults = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_CONNECTTIMEOUT => 2000, CURLOPT_HEADER => true, CURLOPT_FOLLOWLOCATION => true)
```





* Visibility: **private**


### $__sesson

```
private mixed $__sesson
```





* Visibility: **private**


### $__options

```
private mixed $__options
```





* Visibility: **private**


### $__response

```
private mixed $__response
```





* Visibility: **private**


### $__header

```
private mixed $__header = null
```





* Visibility: **private**


### $__body

```
private mixed $__body
```





* Visibility: **private**


### $__cookies

```
private mixed $__cookies
```





* Visibility: **private**


### $__errno

```
private mixed $__errno = null
```





* Visibility: **private**


### $__error

```
private mixed $__error = null
```





* Visibility: **private**


Methods
-------


### \Curl::__construct()

```
void Curl::\Curl::__construct()(mixed $url, array $options)
```

Constructor method or the Curl class.

Example:
````
 $request = new Curl('http://example.com', array(CURLOPT_CONNECTTIMEOUT => 2000));
````

* Visibility: **public**

#### Arguments

* $url **mixed**
* $options **array** - &lt;p&gt;An array of curl options with the key the curl option and the value the curl option value.&lt;/p&gt;



### \Curl::__destruct()

```
void Curl::\Curl::__destruct()()
```

Descructor method or the Curl class.



* Visibility: **public**



### \Curl::__get()

```
void Curl::\Curl::__get()($name)
```

__get function.



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Curl::__set()

```
mixed Curl::\Curl::__set()($name, $value)
```

__set function.



* Visibility: **public**

#### Arguments

* $name **mixed**
* $value **mixed**



### \Curl::__curl()

```
mixed Curl::\Curl::__curl()($url)
```

Performs a curl request.



* Visibility: **private**

#### Arguments

* $url **mixed**



### \Curl::__explodeHeader()

```
void Curl::\Curl::__explodeHeader()($data)
```

Separates the http header from the results of a curl request.



* Visibility: **private**

#### Arguments

* $data **mixed**



### \Curl::defaults()

```
mixed Curl::\Curl::defaults()($value)
```

Getter/Setter for Curl::$__defaults.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::options()

```
mixed Curl::\Curl::options()($value)
```

Getter/Setter for Curl::$__options.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::response()

```
mixed Curl::\Curl::response()($value)
```

Getter/Setter for Curl::$__response.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::header()

```
mixed Curl::\Curl::header()($value)
```

Getter/Setter for Curl::$__header.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::body()

```
mixed Curl::\Curl::body()($value)
```

Getter/Setter for Curl::$__body.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::cookies()

```
mixed Curl::\Curl::cookies()($value)
```

Getter/Setter for Curl::$__cookies.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::errno()

```
mixed Curl::\Curl::errno()($value)
```

Getter/Setter for Curl::$__errno.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Curl::error()

```
mixed Curl::\Curl::error()($value)
```

Getter/Setter for Curl::$__error.



* Visibility: **public**

#### Arguments

* $value **mixed**


