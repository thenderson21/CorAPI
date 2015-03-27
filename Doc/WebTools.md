WebTools
===============

WebTools

WebTools class contains various tools for ussage in validating web content.


* Class name: WebTools







Methods
-------


### \WebTools::isValidURL()

```
bool WebTools::\WebTools::isValidURL()(string $url)
```

Checks to see if a url is valid.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $url **string** - &lt;p&gt;The url to be verified.&lt;/p&gt;



### \WebTools::sanitizeMSTxt()

```
string WebTools::\WebTools::sanitizeMSTxt()(string $text)
```

Removes smarts quotes and such added by Word.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $text **string**



### \WebTools::breadCrumbs()

```
string WebTools::\WebTools::breadCrumbs()(string $separator, string $home, string $homeDir)
```

This method will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path



* Visibility: **public**
* This method is **static**.

#### Arguments

* $separator **string** - &lt;p&gt;The string separating the items int the breadcrumb. (default: &#039; &amp;raquo; &#039;)&lt;/p&gt;

* $home **string** - &lt;p&gt;N(default: &#039;Home&#039;)&lt;/p&gt;

* $homeDir **string** - &lt;p&gt;(default: null)&lt;/p&gt;



