Debug
===============

Debug class contains usefule debugging methods and varriables.




* Class name: Debug





Properties
----------


### $startTime

```
public int $startTime
```





* Visibility: **public**
* This property is **static**.


### $pauseTime

```
public int $pauseTime
```





* Visibility: **public**
* This property is **static**.


### $marks

```
public array $marks
```





* Visibility: **public**
* This property is **static**.


Methods
-------


### \Debug::dump()

```
mixed Debug::\Debug::dump()($var, $label, $print, $exit)
```

Debug helper function. This is a wrapper for var_dump() that adds
the <pre /> tags, cleans up newlines and indents, and runs
htmlentities() before output.

**Example:**
````
$arr = array('One' = 1);

Debug::dump($var);
````

* Visibility: **public**
* This method is **static**.

#### Arguments

* $var **mixed**
* $label **mixed**
* $print **mixed**
* $exit **mixed**



### \Debug::printR()

```
mixed Debug::\Debug::printR()($var, $label, $print, $exit)
```

Debug helper function. This is a wrapper for print_r() that adds
the <pre /> tags, cleans up newlines and indents, and runs
htmlentities() before output.

**Example:**
````
$arr = array('One' = 1);

Debug::printR($var);
````

* Visibility: **public**
* This method is **static**.

#### Arguments

* $var **mixed**
* $label **mixed**
* $print **mixed**
* $exit **mixed**



### \Debug::start()

```
mixed Debug::\Debug::start()($method)
```

Starts the timer.

**Example:**
````
Debug::start(__METHOD__); //Starts the timer.
````

* Visibility: **public**
* This method is **static**.

#### Arguments

* $method **mixed**



### \Debug::pause()

```
void Debug::\Debug::pause()()
```

Pauses the timer.

**Example:**
````
Debug::start(); //Starts the timer.

Debug::pause(); //Pauses the timer.
````

* Visibility: **public**
* This method is **static**.



### \Debug::unpause()

```
void Debug::\Debug::unpause()()
```

Un-pauses the timer.

**Example:**
````
Debug::start(); //Starts the timer.

Debug::pause(); //Pauses the timer.

Debug::unpause(); //Restarts the timer.
````

* Visibility: **public**
* This method is **static**.



### \Debug::getTimer()

```
int Debug::\Debug::getTimer()($decimals)
```

Get the current timer value in miliseconds rounded to a specified decimal point.

**Example:**
````
Debug::start(); //Starts the timer.

echo Debug::get(); //Prints 1.311E-5.
````

* Visibility: **public**
* This method is **static**.

#### Arguments

* $decimals **mixed**



### \Debug::getTime()

```
float Debug::\Debug::getTime()()
```

Get the current timer value in seconds.

**Example:**
````
Debug::start(); //Starts the timer.

echo Debug::getTime(); //Prints 1353085737.6486
````

* Visibility: **public**
* This method is **static**.



### \Debug::mark()

```
mixed Debug::\Debug::mark()($method)
```

Records debuging information at given location;



* Visibility: **public**
* This method is **static**.

#### Arguments

* $method **mixed**



### \Debug::dumpMarks()

```
void Debug::\Debug::dumpMarks()()
```

Outputs the all markes in human readabe format (kinda).



* Visibility: **public**
* This method is **static**.



### \Debug::dumpTimes()

```
void Debug::\Debug::dumpTimes()()
```

Outputs the all times in human readable format (kinda).



* Visibility: **public**
* This method is **static**.


