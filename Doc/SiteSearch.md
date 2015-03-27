SiteSearch
===============

This class is the controller for domain scopped search results.




* Class name: SiteSearch
* Parent class: [Controller](Controller.md)





Properties
----------


### $__cx

```
private \cx $__cx = GSS_CX
```





* Visibility: **private**


### $__q

```
private string $__q
```





* Visibility: **private**


### $__qScoped

```
private string $__qScoped
```





* Visibility: **private**


### $__search

```
private object $__search
```





* Visibility: **private**


### $__scope

```
private string $__scope
```





* Visibility: **private**


### $__scopeSelectorArray

```
private mixed $__scopeSelectorArray = array('jpt' => array('name' => 'JPT', 'value' => GSS_SCOPE_JPT), 'spe' => array('name' => 'SPEorg', 'value' => GSS_SCOPE_SPE), 'onepetro' => array('name' => 'OnePetro', 'value' => GSS_SCOPE_ONEPETRO), 'petrowiki' => array('name' => 'PetroWiki', 'value' => GSS_SCOPE_PETROWIKI), 'energy4me' => array('name' => 'Energy4me', 'value' => GSS_SCOPE_ENERGY4ME))
```





* Visibility: **private**


### $__scopeSelector

```
private string $__scopeSelector
```





* Visibility: **private**


### $__results

```
private object $__results
```





* Visibility: **private**


### $_viewDirectory

```
protected mixed $_viewDirectory
```





* Visibility: **protected**
* This property is defined by [Controller](Controller.md)


Methods
-------


### \SiteSearch::__construct()

```
mixed SiteSearch::\SiteSearch::__construct()($formOnly)
```

Class constructor method.



* Visibility: **public**

#### Arguments

* $formOnly **mixed**



### \SiteSearch::render()

```
void SiteSearch::\SiteSearch::render()($variables)
```

Renders the view.



* Visibility: **public**

#### Arguments

* $variables **mixed**



### \SiteSearch::paginationMenu()

```
void SiteSearch::\SiteSearch::paginationMenu()()
```

Renders Pagination Menu.



* Visibility: **public**



### \SiteSearch::next()

```
string|boolean SiteSearch::\SiteSearch::next()()
```

Returns the url hash for the next page of search results or `false` if on last page.



* Visibility: **public**



### \SiteSearch::prev()

```
string|boolean SiteSearch::\SiteSearch::prev()()
```

Returns the url hash for the previous page of search results or `false` if on first page.



* Visibility: **public**



### \SiteSearch::cx()

```
mixed SiteSearch::\SiteSearch::cx()($value)
```

Getter/Setter for SiteSearch::$__cx.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \SiteSearch::search()

```
mixed SiteSearch::\SiteSearch::search()($value)
```

Getter/Setter for SiteSearch::$__search.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \SiteSearch::results()

```
mixed SiteSearch::\SiteSearch::results()($value)
```

Getter/Setter for SiteSearch::$__results.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \Controller::__construct()

```
void Controller::\Controller::__construct()()
```

Constructor



* Visibility: **public**
* This method is defined by [Controller](Controller.md)



### \Controller::_render()

```
void Controller::\Controller::_render()($variables, $file)
```

Renders view.



* Visibility: **protected**
* This method is defined by [Controller](Controller.md)

#### Arguments

* $variables **mixed**
* $file **mixed**


