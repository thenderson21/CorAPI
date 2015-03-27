WebService
===============

WebService

WebServices Class file. The WebService class gets, process and returns an object file for the requested service.


* Class name: WebService





Properties
----------


### $__serviceURL

```
private mixed $__serviceURL
```





* Visibility: **private**


### $__serviceType

```
private mixed $__serviceType
```





* Visibility: **private**


### $__serviceData

```
private mixed $__serviceData
```





* Visibility: **private**


### $__serviceDataArray

```
private mixed $__serviceDataArray
```





* Visibility: **private**


### $__service

```
private mixed $__service
```





* Visibility: **private**


Methods
-------


### \WebService::__construct()

```
mixed WebService::\WebService::__construct()()
```

Class Constructor



* Visibility: **public**



### \WebService::__getData()

```
\objec WebService::\WebService::__getData()()
```

Returns string of requested data. Json or XML.



* Visibility: **private**



### \WebService::__processData()

```
object WebService::\WebService::__processData()($data, $encoding)
```

Prosseses data and returns object of the inputed webservice.



* Visibility: **private**

#### Arguments

* $data **mixed**
* $encoding **mixed**



### \WebService::serviceURL()

```
mixed WebService::\WebService::serviceURL()($value)
```

Getter/Setter for WebService::$__serviceURL.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \WebService::serviceType()

```
mixed WebService::\WebService::serviceType()($value)
```

Getter/Setter for WebService::$__serviceType.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \WebService::serviceData()

```
mixed WebService::\WebService::serviceData()($value)
```

Getter/Setter for WebService::$__serviceData.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \WebService::serviceDataArray()

```
mixed WebService::\WebService::serviceDataArray()($value)
```

Getter/Setter for WebService::$__serviceDataArray.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \WebService::service()

```
mixed WebService::\WebService::service()($value)
```

Getter/Setter for WebService::$__service.



* Visibility: **public**

#### Arguments

* $value **mixed**


