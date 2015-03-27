ExceptionHandler
===============

Class for handeling exceptions.

The ExceptionHandler class contains standardised methods for processing caught exceptions.


* Class name: ExceptionHandler



Constants
----------


### ERROR_EMAIL

```
const ERROR_EMAIL = 'webprod@spe.org'
```







Methods
-------


### \ExceptionHandler::handle()

```
void ExceptionHandler::\ExceptionHandler::handle()(object $exception, string $action)
```

ExceptionHandler::exception(object $exception, string $action).

The ExceptioHandler class provides a standardised way for handeling exception. Exceptions
are handled by puting them in the php log 'log', emailing then to the email address stored
in ERROR_EMAIL 'email', or by printing them to the screen 'echo'.

<b>Example:</b><br>
<code>{.php}
try{
 if(false){
 throw new Exception('False is still false.');
}
}catch( Exception $someException ){
 ExceptionHandler::handle($someException, 'log');
}
</code>

* Visibility: **public**
* This method is **static**.

#### Arguments

* $exception **object**
* $action **string** - &lt;p&gt;(default: &#039;log&#039;)&lt;/p&gt;



