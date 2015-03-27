GoogleSiteSearch
===============






* Class name: GoogleSiteSearch





Properties
----------


### $__url

```
private mixed $__url = GSS_URL
```





* Visibility: **private**


### $__c2coff

```
private int $__c2coff
```

Enables or disables Simplified and Traditional Chinese Search.

The default value for this parameter is 0 (zero), meaning that the feature is enabled. Supported values are:
-`1:` Disabled
-`0:` Enabled (default)

* Visibility: **private**


### $__client

```
private string $__client = 'google-csbe'
```

**Required**. The client parameter must be set to google-csbe.



* Visibility: **private**


### $__cr

```
private string $__cr
```

Country restrict(s).

The cr parameter restricts search results to documents originating in a particular country.
You may use [Boolean operators](https://developers.google.com/custom-search/docs/xml_results#booleanOperators)
in the cr parameter's value.
Google WebSearch determines the country of a document by analyzing:
-the top-level domain (TLD) of the document's URL.
-the geographic location of the Web server's IP address.
See the [Country (cr) Parameter Values](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#countryCollections)
section for a list of valid values for this parameter.

* Visibility: **private**


### $__cx

```
private string $__cx
```

**Required**. The cx parameter specifies a unique code that identifies a custom
search engine. You must specify a Custom Search Engine using the cx parameter
to retrieve search results from that CSE.

To find the value of the cx parameter, go to Control Panel > Codes tab of your
CSE and you will find it in the text area under 'Paste this code in the page
where you'd like your search box to appear. The search results will be shown on a
Google-hosted page.'

* Visibility: **private**


### $__filter

```
private string $__filter
```

The filter parameter activates or deactivates the automatic filtering of Google search results. See
[Automatic Filtering](https://developers.google.com/custom-search/docs/xml_results#automaticFiltering)
for more information about Google's search results filters. Note that host crowding filtering applies
only to multi-site searches.

Valid values for the parameter are:
-`filter=0` - Turns off the duplicate content filter
-`filter=1` - Turns on the duplicate content filter (default)
By default, Google applies filtering to all search results to improve the quality of those results.

* Visibility: **private**


### $__key

```
private string $__key
```

API key. **REQUIRED** unless you provide an OAuth 2.0 token. Your API
key identifies your project and provides you with API access, quota, and reports.



* Visibility: **private**


### $__prettyPrint

```
private string $__prettyPrint = 'true'
```





* Visibility: **private**


### $__prmd

```
private string $__prmd
```





* Visibility: **private**


### $__quotaUser

```
private string $__quotaUser
```

Alternative to userIp. Lets you enforce per-user quotas from a server-side
application even in cases when the user's IP address is unknown.This can occur,
for example, with applications that run cron jobs on App Engine on a user's
behalf. You can choose any arbitrary string that uniquely identifies a user,
but it is limited to 40 characters. Overrides `userIp` if both are provided.



* Visibility: **private**


### $__userIp

```
private string $__userIp
```

IP address of the end user for whom the API call is being made. Lets you
enforce per-user quotas when calling the API from a server-side application.



* Visibility: **private**


### $__gl

```
private string $__gl
```

Geolocation of end user. The `gl` parameter value is a two-letter country code. The `gl` parameter boosts
search results whose country of origin matches the parameter value. See the
[Country Codes](https://developers.google.com/custom-search/docs/xml_results#countryCodes) page for a
list of valid values.

Specifying a `gl` parameter value should lead to more relevant results. This is particularly true for
international customers and, even more specifically, for customers in English- speaking countries other
than the United States.

* Visibility: **private**


### $__hl

```
private string $__hl
```

The interface language.	Explicitly setting this parameter improves the performance and the quality of
your search results. See the
[Interface Languages](https://developers.google.com/custom-search/docs/xml_results#wsInterfaceLanguages)
section of
[Internationalizing Queries and Results Presentation](https://developers.google.com/custom-search/docs/xml_results#wsInternationalizing)
for more information, and [Supported Interface Languages](https://developers.google.com/custom-search/docs/xml_results#interfaceLanguages)
for a list of supported languages.



* Visibility: **private**


### $__hq

```
private string $__hq
```

Appends terms to query. Appends the specified query terms to the query, as if they were combined
with a logical AND operator.



* Visibility: **private**


### $__ie

```
private string $__ie
```

The `ie` parameter sets the character encoding scheme that should be used to
interpret the query string. The default `ie` value is `latin1`.

See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#wsCharacterEncoding)
section for a discussion of when you might need to use this parameter.
See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#characterEncodings)
Schemes section for the list of possible ie values.

* Visibility: **private**


### $__lr

```
private string $__lr
```

You can restrict the search to documents written in a particular language (e.g., `lr=lang_ja`).

Google WebSearch determines the language of a document by analyzing:
-the top-level domain (TLD) of the document's URL
-language meta tags within the document
-the primary language used in the body text of the document
-secondary languages, if any, used in the body text of the document
See the [Language (lr) Collection Values](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#languageCollections)
section for a list of valid values for this parameter.

* Visibility: **private**


### $__num

```
private int $__num
```

Number of search results to return. You can specify the how many results to
return for the current search. The default num value is 10, and the maximum
value is 20. If you request more than 20 results, only 20 results will be returned.



* Visibility: **private**


### $__oe

```
private string $__oe
```

The `oe` parameter sets the character encoding scheme that should be used to decode the
XML result. The default oe value is `latin1`.

See the [Character Encoding](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#wsCharacterEncoding)
section for a discussion of when you might need to use this parameter.
See the [Character Encoding Schemes](https://developers.google.com/custom-search/docs/xml_results?hl=en&csw=1#characterEncodings)
section for the list of possible oe values.

* Visibility: **private**


### $__output

```
private string $__output = 'xml_no_dtd'
```

**Required** The `output` parameter specifies the format of the XML results.

The only valid values for this parameter are `xml` and `xml_no_dtd`.
The chart below explains how these parameter values differ.
| **Value**		| **Output Format**															|
| `xml_no_dtd` 	| The XML results will not include a !DOCTYPE statement. **(Recommended)**	|
| `xml`			| The XML results will contain a Google DTD reference. The second line of the result will identify the document definition type (DTD) that the results use: `<!DOCTYPE GSP SYSTEM "google.dtd">` |

* Visibility: **private**


### $__q

```
private string $__q
```

Query. The search expression.



* Visibility: **private**


### $__safe

```
private string $__safe
```

Search safety level. You can specify the
[search safety level](https://developers.google.com/custom-search/docs/xml_results#safeSearchLevels).

Possible values are:
-`high` - enables highest level of safe search filtering.
-`medium` - enables moderate safe search filtering.
-`off` - disables safe search filtering.
If `safe` is not specified, a value of `off` is assumed.

* Visibility: **private**


### $__start

```
private int $__start
```

The index of the first result to return. You can set the start index
of the first search result returned. Valid values are integers between
1 and (101 - `num`). If start is not used, a value of 1 is assumed.



* Visibility: **private**


### $__sort

```
private string $__sort
```

The `sort` parameter specifies that the results be sorted according to the
specified expression. For example, sort by date.



* Visibility: **private**


### $__results

```
private mixed $__results
```





* Visibility: **private**


### $__ud

```
private string $__ud
```

The ud parameter indicates whether the XML response should include the I
DN-encoded URL for the search result. IDN (International Domain Name)
encoding allows domains to be displayed using local languages, for example:
<br><br>http://www.花井鮨.com<br><br>
Valid values for this parameter are `1` (default), meaning the XML result
should include IDN-encoded URLs, and 0, meaning the XML result should not
include IDN-encoded URLs. If the ud parameter is set to 1, the IDN-encoded
URL will appear in in the UD tag in your XML results. If the `ud` parameter
is set to `0`, the URL in the example above would be displayed as:<br>
<br>http://www.xn--elq438j.com <br> **Note:** This is a beta feature.



* Visibility: **private**


Methods
-------


### \GoogleSiteSearch::search()

```
object GoogleSiteSearch::\GoogleSiteSearch::search()($queryString)
```

Searches for a given search string/



* Visibility: **public**

#### Arguments

* $queryString **mixed**



### \GoogleSiteSearch::__buildUrlString()

```
string GoogleSiteSearch::\GoogleSiteSearch::__buildUrlString()()
```

Generates a google site search string url from given paramenters



* Visibility: **private**



### \GoogleSiteSearch::url()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::url()($value)
```

Getter/Setter for GoogleSiteSearch::$__url.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::c2coff()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::c2coff()($value)
```

Getter/Setter for GoogleSiteSearch::$__c2coff.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::client()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::client()($value)
```

Getter/Setter for GoogleSiteSearch::$_client.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::cr()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::cr()($value)
```

Getter/Setter for GoogleSiteSearch::$__cr.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::cx()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::cx()($value)
```

Getter/Setter for GoogleSiteSearch::$__cx.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::filter()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::filter()($value)
```

Getter/Setter for GoogleSiteSearch::$__filter.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::key()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::key()($value)
```

Getter/Setter for GoogleSiteSearch::$__key.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::prettyPrint()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::prettyPrint()($value)
```

Getter/Setter for GoogleSiteSearch::$__prettyPrint.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::prmd()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::prmd()($value)
```

Getter/Setter for GoogleSiteSearch::$__prmd.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::quotaUser()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::quotaUser()($value)
```

Getter/Setter for GoogleSiteSearch::$__quotaUser.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::userIp()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::userIp()($value)
```

Getter/Setter for GoogleSiteSearch::$__userIp.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::gl()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::gl()($value)
```

Getter/Setter for GoogleSiteSearch::$__gl.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::hl()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::hl()($value)
```

Getter/Setter for GoogleSiteSearch::$__hl.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::hq()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::hq()($value)
```

Getter/Setter for GoogleSiteSearch::$__hq.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::ie()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::ie()($value)
```

Getter/Setter for GoogleSiteSearch::$__ie.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::lr()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::lr()($value)
```

Getter/Setter for GoogleSiteSearch::$__lr.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::num()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::num()($value)
```

Getter/Setter for GoogleSiteSearch::$__num.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::oe()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::oe()($value)
```

Getter/Setter for GoogleSiteSearch::$__oe.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::output()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::output()($value)
```

Getter/Setter for GoogleSiteSearch::$__output.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::q()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::q()($value)
```

Getter/Setter for GoogleSiteSearch::$__q.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::safe()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::safe()($value)
```

Getter/Setter for GoogleSiteSearch::$__safe.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::start()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::start()($value)
```

Getter/Setter for GoogleSiteSearch::$__start.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::sort()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::sort()($value)
```

Getter/Setter for GoogleSiteSearch::$__sort.



* Visibility: **public**

#### Arguments

* $value **mixed**



### \GoogleSiteSearch::ud()

```
mixed GoogleSiteSearch::\GoogleSiteSearch::ud()($value)
```

Getter/Setter for GoogleSiteSearch::$__ud.



* Visibility: **public**

#### Arguments

* $value **mixed**


