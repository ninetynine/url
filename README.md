# :link: URL

_URL_ is a package which offers a helper to build URLs. It is currently standalone with no third party dependencies. It can be used for building URLs or parsing them.

## Get Started

### Installation

You can install URL through composer. Just run the following command in your composer project.

```
composer require ninetynine/url
```

More information about how to use composer head over to their [website](composers). Once you have installed the package, and `vendor/autoload.php` is [required](http://php.net/manual/en/function.require-once.php) within your script you'll be able to use URL.

### Usage

#### Parsing

To parse a URL statically call `parse` and pass in the first parameter as the URL you want to parse, such as `http://google.co.uk`. 

A second parameter is required which is used to count how many bits the TLD is taking up. For example `http://google.co.uk`'s TLD segment count would be `2` whereas `http://google.com`'s segment count would be `1`. Providing a TLD segment count becomes useful when breaking up a URL's subdoamins.

There's an optional third parameter for the version segment. This would be used to capture the version of an API url. For example `/api/v1/users` would be `2`, whereas `/api/dev/v1/users` would be `3`.

`URL::parse` will return an instance of URL which can then be used to interrogate or rebuild the URL.

##### Basic example
```
// Input
$url = URL::parse('http://google.co.uk', 2);

print_r($url);

// Output
NinetyNine\Url\Url Object
(
    [host:protected] => google.co.uk
    [path:protected] => 
    [secure:protected] => 
    [protocol:protected] => http
    [subdomains:protected] => Array
        (
        )

    [query_params:protected] => Array
        (
        )

    [port:protected] => 
    [version:protected] => 
)
```

##### Complex example
```
// Input
$url = URL::parse('http://euw.op.gg:80/ranking/ladder/', 1);

print_r($url);

// Output
NinetyNine\Url\Url Object
(
    [host:protected] => op.gg
    [path:protected] => ranking/ladder/
    [secure:protected] => 
    [protocol:protected] => http
    [subdomains:protected] => Array
        (
            [0] => euw
        )

    [query_params:protected] => Array
        (
        )

    [port:protected] => 80
    [version:protected] => 
)
```

#### Making

Making a URL can be as easy or complex as you want. To initalize the URL class statically call `make` with an optional base URI and query params. Query params is expected to be an associative array. `make` will return an instance of URL that can be used to build the rest of the URL. All methods other than those starting with `get` or `has` (without `volatile`) will return an instance of URL.

```
$url = URL::make('github.com');
```

##### Managing subdomains

URL has a number of different methods to help add, remove and retrieve subdomains to help make managing subdomains easy and flexible.

###### Adding subdomains

To set the URL to only have a subdomain call `subdomain` which accepts a string. **This will overwrite any previous subdomains.**
```
$url->subdomain('foobar');
```

To prepend a single subdomain infront of already existing subdomains call `prependSubdomain` which accepts a string. This will prepend the list of subdomains with a new subdomain.
```
$url->prependSubdomain('foo');
```

To append a single subdomain at the end of already existing subdomains call `appendSubdomain` which accepts a string. This will append the list of subdomains with a new subdomain.
```
$url->appendSubdomain('bar');
```

To set the URL to have multiple subdomains call `subdomains` which excepts an infinite amount of strings, or an array of strings. **This will overwrite any previous subdomains.**
```
$url->subdomains('foo', 'bar');

// or
$url->subdomains(['foo', 'bar']);
```

To prepend mutliple subdomains infront of already existing subdomains call `prependSubdomains` which excepts an infinite amount of strings, or an array of strings. This will prepend the list of subdomains with new subdomains.
```
$url->prependSubdomains('foo1', 'foo2');

// or
$url->prependSubdomains(['foo1', 'foo2']);
```

To append mutliple subdomains at the end of already existing subdomains call `appendSubdomains` which excepts an infinite amount of strings, or an array of strings. This will append the list of subdomains with new subdomains.
```
$url->appendSubdomains('bar1', 'bar2');

// or
$url->appendSubdomains(['bar1', 'bar2']);
```

###### Removing subdomains

To reset/remove all subdomains call `resetSubdomains`.
```
$url->resetSubdomains();
```

When removing subdomains, if unable to find the subdomain an `InvalidArrayElementException` will be thrown. All instances of a subdomain will be removed, not just the first instance. If the subdomain is not found an `InvalidArrayElementException` will be thrown.

To remove a single subdomain call `removeSubdomain` which excepts a string. 
```
$url->removeSubdomain('foo');
```

To remove a multiple subdomains call `removeSubdomains` which excepts an infinite amount of strings, or an array of strings. If a subdomain is not found an `InvalidArrayElementException` will be thrown.
```
$url->removeSubdomains('foo', 'bar');

// or
$url->removeSubdomains(['foo', 'bar']);
```

###### Misc

To get all subdomains as an array call `getSubdomains`.
```
$url->getSubdomains();

// [ 'foo', 'bar' ]
```

To get all subdomains as a string, joined by `.`, call `getSubdomainString`.
```
$url->getSubdomainString();

// foo.bar
```

To check if a URL has a given subdomain call `hasSubdomain` which excepts a string and will return a bool. Although calling `hasSubdomainVolatile` will throw an `InvalidArrayElementException` if not found rather than a bool and will return an instance of URL.
```
$url->hasSubdomain('foo');
$url->hasSubdomainVolatile('bar');
```

To check if a URL has all given subdomains call `hasSubdomains` which excepts an infinite amount of strings, or an array of strings, and will return a bool. Although calling `hasSubdomainVolatile` will throw an `InvalidArrayElementException` if not found rather than a bool and will return an instance of URL.
```
$url->hasSubdomains('foo1', 'foo2');
$url->hasSubdomainVolatiles('bar1', 'bar2');

// or
$url->hasSubdomains(['foo1', 'foo2']);
$url->hasSubdomainVolatiles(['bar1', 'bar2']);
```
