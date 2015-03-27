User
===============

The User class contains varriable and methods about the status of the current user.




* Class name: User





Properties
----------


### $__isLoggedIn

```
private bool $__isLoggedIn = false
```





* Visibility: **private**


### $__email

```
private string $__email
```





* Visibility: **private**


### $__emetaId

```
private string $__emetaId
```





* Visibility: **private**


### $__ERights

```
private string $__ERights
```





* Visibility: **private**


### $__firstName

```
private string $__firstName
```





* Visibility: **private**


### $__isOrg

```
private string $__isOrg
```





* Visibility: **private**


### $__lastName

```
private string $__lastName
```





* Visibility: **private**


### $__smConstitid

```
private string $__smConstitid
```





* Visibility: **private**


### $__status

```
private string $__status
```





* Visibility: **private**


### $__JSessionId

```
private string $__JSessionId
```





* Visibility: **private**


### $__WTFPC

```
private string $__WTFPC
```





* Visibility: **private**


### $__eva

```
private string $__eva
```





* Visibility: **private**


### $__staffOverrides

```
private array $__staffOverrides = array(array('email' => 'todd@todd-henderson.me', 'status' => 'developer'), array('email' => 'bfountain@spe.org', 'status' => 'developer'), array('email' => 'khiggins@spe.org', 'status' => 'developer'))
```





* Visibility: **private**


Methods
-------


### \User::__construct()

```
void User::\User::__construct()()
```

Users class constructor sets the status of variable depending on coockie parameters.



* Visibility: **public**



### \User::isMember()

```
bool User::\User::isMember()($value)
```

Checks to see if the user is a current member



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::isLoggedIn()

```
mixed User::\User::isLoggedIn()($value)
```

Getter/Setter for User::$__isLoggedIn.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::email()

```
mixed User::\User::email()($value)
```

Getter/Setter for User::$__email.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::emetaId()

```
mixed User::\User::emetaId()($value)
```

Getter/Setter for User::$__emetaId.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::ERights()

```
mixed User::\User::ERights()($value)
```

Getter/Setter for User::$__ERights.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::firstName()

```
mixed User::\User::firstName()($value)
```

Getter/Setter for User::$__firstName.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::isOrg()

```
mixed User::\User::isOrg()($value)
```

Getter/Setter for User::$__isOrg.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::lastName()

```
mixed User::\User::lastName()($value)
```

Getter/Setter for User::$__lastName.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::smConstitid()

```
mixed User::\User::smConstitid()($value)
```

Getter/Setter for User::$__smConstitid.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::status()

```
mixed User::\User::status()($value)
```

Getter/Setter for User::$__status.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::JSessionId()

```
mixed User::\User::JSessionId()($value)
```

Getter/Setter for User::$__JSessionId.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::WTFPC()

```
mixed User::\User::WTFPC()($value)
```

Getter/Setter for User::$__WTFPC.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::eva()

```
mixed User::\User::eva()($value)
```

Getter/Setter for User::$__eva.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \User::staffOverrides()

```
mixed User::\User::staffOverrides()($value)
```

Getter/Setter for User::$__staffOverrides.



* Visibility: **public**

#### Arguments

* $value **mixed**


