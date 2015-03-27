LocationTools
===============

Class for obtaining location information and coordianates.

The LocationTools class contains methods useful for finding locations given different information.


* Class name: LocationTools







Methods
-------


### \LocationTools::fetchCoordinates()

```
object LocationTools::\LocationTools::fetchCoordinates()($city)
```

Fetches the latitude and longitude coordinates for a given location from geo location services such
as google maps.  If unable to determin coordinates it returns false and sets a new Message or throws
a new exception if invalid arguments are passed.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $city **mixed**


