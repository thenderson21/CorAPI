GeoLocation
===============

GeoLocation class attempts to locate the user&#039;s location from their ip address.




* Class name: GeoLocation





Properties
----------


### $doc

```
public mixed $doc = null
```

GeoLocation::$doc

XML document.

* Visibility: **public**


### $host

```
public mixed $host = "http://api.hostip.info/?ip=<IP>"
```

GeoLocation::$host

Url of the host of the geo location service.

* Visibility: **public**


### $city

```
public mixed $city = 'unknown'
```

GeoLocation::$city

The city returned from geo location service.

* Visibility: **public**


### $country

```
public mixed $country = 'unknown'
```

GeoLocation::$country

The country returned from geo location service.

* Visibility: **public**


### $longitude

```
public mixed $longitude = '0'
```

GeoLocation::$longitude

The longitude returned from geo location service.

* Visibility: **public**


### $latitude

```
public mixed $latitude = '0'
```

GeoLocation::$latitude

The latitude returned from geo location service.

* Visibility: **public**


Methods
-------


### \GeoLocation::__construct()

```
void GeoLocation::\GeoLocation::__construct()(string $ip)
```

GeoLocation::__construct

Creates a new GeoLocation object.

* Visibility: **public**

#### Arguments

* $ip **string** - &lt;p&gt;An ip address.&lt;/p&gt;



### \GeoLocation::GeoLocation()

```
void GeoLocation::\GeoLocation::GeoLocation()(string $ip)
```

GeoLocation::GeoLocation

Old Style constructor function. Creates a new GeoLocation object.

* Visibility: **public**

#### Arguments

* $ip **string** - &lt;p&gt;An ip address.&lt;/p&gt;



### \GeoLocation::fetch()

```
string GeoLocation::\GeoLocation::fetch()(string $host)
```

GeoLocation::fetch



* Visibility: **public**

#### Arguments

* $host **string**



### \GeoLocation::decode()

```
void GeoLocation::\GeoLocation::decode()(string $text)
```

GeoLocation::decode



* Visibility: **public**

#### Arguments

* $text **string**


