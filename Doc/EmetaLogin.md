EmetaLogin
===============






* Class name: EmetaLogin





Properties
----------


### $__loginWebServiceUrl

```
private mixed $__loginWebServiceUrl = 'https://www.spe.org/jws/rs/x/login'
```





* Visibility: **private**


### $__postVarUsername

```
private mixed $__postVarUsername = 'se_Username'
```





* Visibility: **private**


### $__postVarPasswords

```
private mixed $__postVarPasswords = 's_Password'
```





* Visibility: **private**


### $__accepts

```
private mixed $__accepts = array('Accept: application/json')
```





* Visibility: **private**


### $__cookies

```
private mixed $__cookies = array()
```





* Visibility: **private**


### $__response

```
private mixed $__response
```





* Visibility: **private**


### $__message

```
private mixed $__message
```





* Visibility: **private**


### $__action

```
private mixed $__action
```





* Visibility: **private**


### $__result

```
private mixed $__result
```





* Visibility: **private**


### $__actionCode

```
private mixed $__actionCode
```





* Visibility: **private**


### $__actionTimestamp

```
private mixed $__actionTimestamp
```





* Visibility: **private**


### $__actionStatus

```
private mixed $__actionStatus
```





* Visibility: **private**


Methods
-------


### \EmetaLogin::__construct()

```
void EmetaLogin::\EmetaLogin::__construct()(mixed $username, mixed $password, $serverUrl)
```

__construct function.



* Visibility: **public**

#### Arguments

* $username **mixed**
* $password **mixed**
* $serverUrl **mixed**



### \EmetaLogin::__setCookies()

```
void EmetaLogin::\EmetaLogin::__setCookies()(array|object $cookieArray)
```

Sets cookies for value pairs passed as array or simple object.



* Visibility: **private**

#### Arguments

* $cookieArray **array|object**



### \EmetaLogin::logout()

```
void EmetaLogin::\EmetaLogin::logout()()
```

Logs the user out by resetting the appropiate cookies to expire in the past and
setting their content to nothing.



* Visibility: **public**
* This method is **static**.



### \EmetaLogin::loginWebServiceUrl()

```
mixed EmetaLogin::\EmetaLogin::loginWebServiceUrl()($value)
```

Getter/Setter for EmetaLogin::$__loginWebServiceUrl.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::postVarUsername()

```
mixed EmetaLogin::\EmetaLogin::postVarUsername()($value)
```

Getter/Setter for EmetaLogin::$__postVarUsername.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::postVarPasswords()

```
mixed EmetaLogin::\EmetaLogin::postVarPasswords()($value)
```

Getter/Setter for EmetaLogin::$__postVarPasswords.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::accepts()

```
mixed EmetaLogin::\EmetaLogin::accepts()($value)
```

Getter/Setter for EmetaLogin::$__accepts.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::cookies()

```
mixed EmetaLogin::\EmetaLogin::cookies()($value)
```

Getter/Setter for EmetaLogin::$__cookies.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::response()

```
mixed EmetaLogin::\EmetaLogin::response()($value)
```

Getter/Setter for EmetaLogin::$__response.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::message()

```
mixed EmetaLogin::\EmetaLogin::message()($value)
```

Getter/Setter for EmetaLogin::$__message.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::action()

```
mixed EmetaLogin::\EmetaLogin::action()($value)
```

Getter/Setter for EmetaLogin::$__action.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::result()

```
mixed EmetaLogin::\EmetaLogin::result()($value)
```

Getter/Setter for EmetaLogin::$__result.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::actionCode()

```
mixed EmetaLogin::\EmetaLogin::actionCode()($value)
```

Getter/Setter for EmetaLogin::$__actionCode.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::actionTimestamp()

```
mixed EmetaLogin::\EmetaLogin::actionTimestamp()($value)
```

Getter/Setter for EmetaLogin::$__actionTimestamp.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \EmetaLogin::actionStatus()

```
mixed EmetaLogin::\EmetaLogin::actionStatus()($value)
```

Getter/Setter for EmetaLogin::$__actionStatus.



* Visibility: **public**

#### Arguments

* $value **mixed**


