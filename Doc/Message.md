Message
===============

Class for handeling non-crucial messages.

This is the class file for the Message class.  The message class
is intended as a tool for gathering and refrencing message to the site adminPage.class.php
without throwing and exception and stoping the code. Messages would be used when
some action need to be taked but, the public user does not need to see the message.


* Class name: Message



Constants
----------


### DEFAULT_TYPE

```
const DEFAULT_TYPE = 'warning'
```





Properties
----------


### $warnings

```
public array $warnings
```

Message::$warnings

The $warnings varriable is an array that contains each warning. Warnings
are objects that contains a 'message' property and may contain other useful
information attached.

* Visibility: **public**
* This property is **static**.


### $notices

```
public array $notices
```

Message::$notices

The $notices varriable is an array that contains each notice. Notices
are objects that contains a 'message' property and may contain other useful
information attached.

* Visibility: **public**
* This property is **static**.


### $listTypes

```
private array $listTypes = array('warning', 'notice')
```

Message::listTypes

Contains an array of acceptable types: array( 'warning', 'notice' ).

* Visibility: **private**


Methods
-------


### \Message::__construct()

```
bool Message::\Message::__construct()(string $message, string $type)
```

Message::__construct

Constructs a Message object.

* Visibility: **public**

#### Arguments

* $message **string**
* $type **string** - &lt;p&gt;(default: DEFAULT_TYPE)&lt;/p&gt;




### \Message::printWarnings()

```
void Message::\Message::printWarnings()()
```

Message::printWarnings

Prints all warnings in an individual <i>div</i> blocks.

* Visibility: **public**



### \Message::logWarnings()

```
void Message::\Message::logWarnings()()
```

Message::logWarnings

Sends all warnings to the php log via ExceptionHandler.

* Visibility: **public**



### \Message::emailWarnings()

```
void Message::\Message::emailWarnings()()
```

Message::emailWarnings

Sends all warnings to the admin via an email through ExceptionHandler.

* Visibility: **public**



### \Message::printNotices()

```
void Message::\Message::printNotices()()
```

Message::printNotices

Prints all notices in an individual <i>div</i> block.

* Visibility: **public**



### \Message::logNotices()

```
void Message::\Message::logNotices()()
```

Message::logNotices

Sends all notices to the php log via ExceptionHandler.

* Visibility: **public**



### \Message::emailNotices()

```
void Message::\Message::emailNotices()()
```

Message::emailNotices

Sends all notices to the admin via an email through ExceptionHandler.

* Visibility: **public**



### \Message::getLastWarningId()

```
int|string Message::\Message::getLastWarningId()()
```

Message::getLastWarningId

Returns the index of the last warning that was created.

* Visibility: **public**



### \Message::getLastNoticeId()

```
int|string Message::\Message::getLastNoticeId()()
```

Message::getLastNoticeId

Returns the index of the last notice that was created.

* Visibility: **public**


