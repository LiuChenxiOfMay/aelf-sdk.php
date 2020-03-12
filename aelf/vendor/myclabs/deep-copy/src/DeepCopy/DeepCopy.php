t, $this->handler);
    }

}

if(extension_loaded('curl'))
{
    // 代理认证方式
    HttpRequest::$proxyAuths = array(
        'basic'        =>    CURLAUTH_BASIC,
        'ntlm'        =>    CURLAUTH_NTLM
    );

    // 代理类型
    HttpRequest::$proxyType = array(
        'http'        =>    CURLPROXY_HTTP,
        'socks4'    =>    CURLPROXY_SOCKS4,
        'socks4a'    =>    6,    // CURLPROXY_SOCKS4A
        'socks5'    =>    CURLPROXY_SOCKS5,
    );
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Webmozart Assert
================

[![Build Status](https://travis-ci.org/webmozart/assert.svg?branch=master)](https://travis-ci.org/webmozart/assert)
[![Build status](https://ci.appveyor.com/api/projects/status/lyg83bcsisrr94se/branch/master?svg=true)](https://ci.appveyor.com/project/webmozart/assert/branch/master)
[![Code Coverage](https://scrutinizer-ci.com/g/webmozart/assert/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/webmozart/assert/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/webmozart/assert/v/stable.svg)](https://packagist.org/packages/webmozart/assert)
[![Total Downloads](https://poser.pugx.org/webmozart/assert/downloads.svg)](https://packagist.org/packages/webmozart/assert)

This library contains efficient assertions to test the input and output of
your methods. With these assertions, you can greatly reduce the amount of coding
needed to write a safe implementation.

All assertions in the [`Assert`] class throw an `\InvalidArgumentException` if
they fail.

FAQ
---

**What's the difference to [beberlei/assert]?**

This library is heavily inspired by Benjamin Eberlei's wonderful [assert package],
but fixes a usability issue with error messages that can't be fixed there without
breaking backwards compatibility.

This package features usable error messages by default. However, you can also
easily write custom error messages:

```
Assert::string($path, 'The path is expected to be a string. Got: %s');
```

In [beberlei/assert], the ordering of the `%s` placeholders is different for
every assertion. This package, on the contrary, provides consistent placeholder
ordering for all assertions:

* `%s`: The tested value as string, e.g. `"/foo/bar"`.
* `%2$s`, `%3$s`, ...: Additional assertion-specific values, e.g. the
  minimum/maximum length, allowed values, etc.

Check the source code of the assertions to find out details about the additional
available placeholders.

Installation
------------

Use [Composer] to install the package:

```
$ composer require webmozart/assert
```

Example
-------

```php
use Webmozart\Assert\Assert;

class Employee
{
    public function __construct($id)
    {
        Assert::integer($id, 'The employee ID must be an integer. Got: %s');
        Assert::greaterThan($id, 0, 'The employee ID must be a positive integer. Got: %s');
    }
}
```

If you create an employee with an invalid ID, an exception is thrown:

```php
new Employee('foobar');
// => InvalidArgumentException:
//    The employee ID must be an integer. Got: string

new Employee(-10);
// => InvalidArgumentException:
//    The employee ID must be a positive integer. Got: -10
```

Assertions
----------

The [`Assert`] class provides the following assertions:

### Type Assertions

Method                                                   | Description
-------------------------------------------------------- | --------------------------------------------------
`string($value, $message = '')`                          | Check that a value is a string
`stringNotEmpty($value, $message = '')`                  | Check that a value is a non-empty string
`integer($value, $message = '')`                         | Check that a value is an integer
`integerish($value, $message = '')`                      | Check that a value casts to an integer
`float($value, $message = '')`                           | Check that a value is a float
`numeric($value, $message = '')`                         | Check that a value is numeric
`natural($value, $message= ''')`                         | Check that a value is a non-negative integer
`boolean($value, $message = '')`                         | Check that a value is a boolean
`scalar($value, $message = '')`                          | Check that a value is a scalar
`object($value, $message = '')`  