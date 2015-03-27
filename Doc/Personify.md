Personify
===============

Personify integration class.




* Class name: Personify





Properties
----------


### $__userID

```
private mixed $__userID
```





* Visibility: **private**


### $__disciplines

```
private mixed $__disciplines = null
```





* Visibility: **private**


### $__userServiceUrl

```
private mixed $__userServiceUrl = 'http://insideqa.spe.org/jws/rs/x/login/customer/'
```





* Visibility: **private**


### $__userServiceUrlDisciplin

```
private mixed $__userServiceUrlDisciplin = '/disciplines'
```





* Visibility: **private**


### $__defaultCurlOptions

```
private mixed $__defaultCurlOptions = array(CURLOPT_HTTPHEADER => array('Accept: application/json'))
```





* Visibility: **private**


Methods
-------


### \Personify::__construct()

```
void Personify::\Personify::__construct()($userID)
```

Class Constructor.



* Visibility: **public**

#### Arguments

* $userID **mixed**



### \Personify::getDisciplines()

```
object Personify::\Personify::getDisciplines()()
```

Gets the diciplins by user id.



* Visibility: **public**



### \Personify::userID()

```
mixed Personify::\Personify::userID()($value)
```

Getter/Setter for Personify::$__userID.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Personify::disciplines()

```
mixed Personify::\Personify::disciplines()($value)
```

Getter/Setter for Personify::$__disciplines.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Personify::userServiceUrl()

```
mixed Personify::\Personify::userServiceUrl()($value)
```

Getter/Setter for Personify::$__userServiceUrl.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Personify::userServiceUrlDisciplin()

```
mixed Personify::\Personify::userServiceUrlDisciplin()($value)
```

Getter/Setter for Personify::$__userServiceUrlDisciplin.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Personify::defaultCurlOptions()

```
mixed Personify::\Personify::defaultCurlOptions()($value)
```

Getter/Setter for Personify::$__defaultCurlOptions.



* Visibility: **public**

#### Arguments

* $value **mixed**


