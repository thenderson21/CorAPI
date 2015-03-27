Benchmark
===============

Class for running benchmarks in PHP.

**Basic usage:**
<code>
Benchmark::run();

//OutPuts

<pre>
--------------------------------------
|    PHP BENCHMARK SCRIPT            |
--------------------------------------
Start : 2012-2013-11-28 14:00:27
Server : localhost@::1
PHP version : 5.3.13
Platform : Darwin
--------------------------------------
__testMath         : 2.225 sec.
__testStringManipulation  : 2.108 sec.
__testLoops        : 1.267 sec.
__testIfElse        : 1.076 sec.
--------------------------------------
Total time:        : 6.676 sec.
</pre>
</code>


* Class name: Benchmark







Methods
-------


### \Benchmark::run()

```
void Benchmark::\Benchmark::run()(bool $echo)
```

run function.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $echo **bool**



### \Benchmark::__testMath()

```
float Benchmark::\Benchmark::__testMath()(int $count)
```

Runs math intensive functions and returns the microtime.



* Visibility: **private**
* This method is **static**.

#### Arguments

* $count **int** - &lt;p&gt;Loop iterations (default: 140000)&lt;/p&gt;




### \Benchmark::__testStringManipulation()

```
float Benchmark::\Benchmark::__testStringManipulation()(int $count)
```

Runs string intensive functions and returns the microtime.



* Visibility: **private**
* This method is **static**.

#### Arguments

* $count **int** - &lt;p&gt;Loop iterations (default: 140000)&lt;/p&gt;




### \Benchmark::__testLoops()

```
void Benchmark::\Benchmark::__testLoops()($count)
```

Simple timed loop benchmark.



* Visibility: **private**
* This method is **static**.

#### Arguments

* $count **mixed**



### \Benchmark::__testIfElse()

```
void Benchmark::\Benchmark::__testIfElse()($count)
```

Simple timed loop benchmark with an if/else statement.



* Visibility: **private**
* This method is **static**.

#### Arguments

* $count **mixed**


