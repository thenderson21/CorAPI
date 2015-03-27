MySQL
===============






* Class name: MySQL





Properties
----------


### $__lastError

```
private mixed $__lastError
```





* Visibility: **private**


### $__lastQuery

```
private mixed $__lastQuery
```





* Visibility: **private**


### $__result

```
private mixed $__result
```





* Visibility: **private**


### $__records

```
private mixed $__records
```





* Visibility: **private**


### $__affected

```
private mixed $__affected
```





* Visibility: **private**


### $__rawResults

```
private mixed $__rawResults
```





* Visibility: **private**


### $__arrayedResult

```
private mixed $__arrayedResult
```





* Visibility: **private**


### $__hostname

```
private mixed $__hostname
```





* Visibility: **private**


### $__username

```
private mixed $__username
```





* Visibility: **private**


### $__password

```
private mixed $__password
```





* Visibility: **private**


### $__database

```
private mixed $__database
```





* Visibility: **private**


### $__databaseLink

```
private mixed $__databaseLink
```





* Visibility: **private**


Methods
-------


### \MySQL::__construct()

```
mixed MySQL::\MySQL::__construct()($username, $password, $hostname, $database)
```

Class constructor method.



* Visibility: **public**

#### Arguments

* $username **mixed**
* $password **mixed**
* $hostname **mixed**
* $database **mixed**



### \MySQL::__destruct()

```
mixed MySQL::\MySQL::__destruct()()
```

Class destructor method.



* Visibility: **public**



### \MySQL::executeSQL()

```
mixed MySQL::\MySQL::executeSQL()($query)
```

Executes MySQL query



* Visibility: **public**

#### Arguments

* $query **mixed**



### \MySQL::insert()

```
boolean MySQL::\MySQL::insert()(array $privates, string $table, string $exclude)
```

Adds a record to the database based on the array key names



* Visibility: **public**

#### Arguments

* $privates **array**
* $table **string**
* $exclude **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;




### \MySQL::delete()

```
void MySQL::\MySQL::delete()(mixed $table, string $where, string $limit, bool $like)
```

Deletes a record from the database



* Visibility: **public**

#### Arguments

* $table **mixed**
* $where **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;

* $limit **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;

* $like **bool** - &lt;p&gt;(default: false)&lt;/p&gt;




### \MySQL::select()

```
array|boolean MySQL::\MySQL::select()(string $from, array|string $where, string $orderBy, string $limit, bool $like, string $operand, string $cols)
```

Gets a single row from $from where $where is true.



* Visibility: **public**

#### Arguments

* $from **string**
* $where **array|string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;

* $orderBy **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;

* $limit **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;

* $like **bool** - &lt;p&gt;(default: false)&lt;/p&gt;

* $operand **string** - &lt;p&gt;(default: &#039;AND&#039;)&lt;/p&gt;

* $cols **string** - &lt;p&gt;(default: &#039;*&#039;)&lt;/p&gt;




### \MySQL::update()

```
\bolean MySQL::\MySQL::update()(mixed $table, mixed $set, mixed $where, string $exclude)
```

Updates a record in the database based on WHERE.



* Visibility: **public**

#### Arguments

* $table **mixed**
* $set **mixed**
* $where **mixed**
* $exclude **string** - &lt;p&gt;(default: &#039;&#039;)&lt;/p&gt;




### \MySQL::arrayResult()

```
array MySQL::\MySQL::arrayResult()()
```

'Arrays' a single result



* Visibility: **public**



### \MySQL::arrayResults()

```
array MySQL::\MySQL::arrayResults()()
```

'Arrays' multiple result



* Visibility: **public**



### \MySQL::arrayResultsWithKey()

```
array MySQL::\MySQL::arrayResultsWithKey()(string $key)
```

'Arrays' multiple results with a key.



* Visibility: **public**

#### Arguments

* $key **string** - &lt;p&gt;(default: &#039;id&#039;)&lt;/p&gt;




### \MySQL::lastInsertID()

```
mixed MySQL::\MySQL::lastInsertID()()
```

Returns ID of the last `insert`.



* Visibility: **public**



### \MySQL::countRows()

```
int MySQL::\MySQL::countRows()($from, $where)
```

Return number of rows



* Visibility: **public**

#### Arguments

* $from **mixed**
* $where **mixed**



### \MySQL::closeConnection()

```
void MySQL::\MySQL::closeConnection()()
```

Closes the connections.



* Visibility: **public**



### \MySQL::__connect()

```
boolean MySQL::\MySQL::__connect()($persistant)
```

Connects class to database



* Visibility: **private**

#### Arguments

* $persistant **mixed**



### \MySQL::__useDB()

```
boolean MySQL::\MySQL::__useDB()()
```

Select database to use



* Visibility: **private**



### \MySQL::__secureData()

```
array|string MySQL::\MySQL::__secureData()($data)
```

Performs a 'mysql_real_escape_string' on the entire array/string



* Visibility: **private**

#### Arguments

* $data **mixed**



### \MySQL::lastError()

```
mixed MySQL::\MySQL::lastError()($value)
```

Getter/Setter for MySQL::$__lastError.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::lastQuery()

```
mixed MySQL::\MySQL::lastQuery()($value)
```

Getter/Setter for MySQL::$__lastQuery.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::result()

```
mixed MySQL::\MySQL::result()($value)
```

Getter/Setter for MySQL::$__result.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::records()

```
mixed MySQL::\MySQL::records()($value)
```

Getter/Setter for MySQL::$__records.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::affected()

```
mixed MySQL::\MySQL::affected()($value)
```

Getter/Setter for MySQL::$__affected.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::rawResults()

```
mixed MySQL::\MySQL::rawResults()($value)
```

Getter/Setter for MySQL::$__rawResults.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::arrayedResult()

```
mixed MySQL::\MySQL::arrayedResult()($value)
```

Getter/Setter for MySQL::$__arrayedResult.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::hostname()

```
mixed MySQL::\MySQL::hostname()($value)
```

Getter/Setter for MySQL::$__hostname.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::username()

```
mixed MySQL::\MySQL::username()($value)
```

Getter/Setter for MySQL::$__username.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::password()

```
mixed MySQL::\MySQL::password()($value)
```

Getter/Setter for MySQL::$__password.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::database()

```
mixed MySQL::\MySQL::database()($value)
```

Getter/Setter for MySQL::$__database.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \MySQL::databaseLink()

```
mixed MySQL::\MySQL::databaseLink()($value)
```

Getter/Setter for MySQL::$__databaseLink.



* Visibility: **public**

#### Arguments

* $value **mixed**


