# Expose

Expose your classes through functions to speed up your development.

## Summary

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Examples of uses](#examples-of-uses)
- [Methods definitions](#methods-definitions)
- [MIT Licence](#mit-licence)

## Prerequisites

- PHP version >= 7.0.0

## Installation

In your project folder:

```bash
composer require khalyomede/expose:1.*
```

## Examples of uses

All the examples are available inside `/example` folder.

All the examples bellow assume the following classes exists:

```php
class Collection {
	protected $items;

	public function __construct($items) {
		$this->items = $items;
	}

	public function all() {
		return $this->items;
	}
}

class Log {
	protected $message;

	public function __construct($message) {
		$this->message = $message;
	}

	public function error() {
		echo sprintf('Error: %s', $this->message) . PHP_EOL;
	}
}
```

- [Example 1: exposing a simple class](#example-1-exposing-a-simple-class)
- [Example 2: exposing multiples classes at once](#example-2-exposing-multiple-classes-at-once)

### Example 1: exposing a simple class

```php
use Khalyomede\Expose;

Expose::make('Collection', 'collection');

// or 

Expose::make(Collection::class, 'collection');

$items = collection(['Thunderbird', 'Polaris', 'Eclipse'])->all();

print_($items);
```

Will display:

```
Array 
(
	[0] => Thunderbird
	[1] => Polaris
	[2] => Eclipse
)
```

### Example 2: exposing multiple classes at once

```php
use Khalyomede\Expose;

Expose::make([
	[Collection::class, 'collector'],
	[Log::class, 'logging'] // beware of existing functions!
]);

$items = collector(['Thunderbird', 'Polaris', 'Eclipse'])->all();

logging("duplicate entry 'Dreamer' on line 9")->error();
```

Will display:

```
Array
(
	[0] => Thunderbird
	[1] => Polaris
	[2] => Eclipse
)
duplicate entry 'Dreamer' on line 9
```

## Methods definition

- [make](#make)

### Make

Expose the class using its alias a shortcut, and create the related function.

```php
public static function make(string $class_name, string $function_name): void
```

**Exceptions**

`InvalidArgumentException`:

- If the first parameter is not a string when using 2 parameters
- If the second parameter is not a string when using 2 parameters
- If the function name already exists
- If the parameter is not an array when using a single parameter
- If the parameter is not an array of array when using a single parameter
- If the paramter is not an array of array containing string when using a single parameter
- If the parameter contains an empty row on its array of array when using a single parameter

**Note**

This function can exposes static classes as well.

## MIT Licence

Expose

Copyright © 2018 Khalyomede

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the oftware, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN CTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.