<?php
	/*
	* Expose
	*
	* Copyright © 2018 Khalyomede
	*
	* Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
	*
	* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
	* 
	* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	*/

	namespace Khalyomede;

	use InvalidArgumentException;

	class Expose {

		/**
		 * @throws InvalidArgumentException
		 */
		public static function make() {
			$arguments = func_get_args();
			$count = count($arguments);

			if( $count === 2 ) {
				$class_name = $arguments[0];
				$function_name = $arguments[1];

				if( is_string($class_name) === false ) {
					throw new InvalidArgumentException(sprintf('Expose::make expect parameter 1 to be string, %s given', gettype($class_name)));
				}

				if( is_string($function_name) === false ) {
					throw new InvalidArgumentException(sprintf('Expose::make expect parameter 2 to be string, %s given', gettype($function_name)));
				}

				if( function_exists($function_name) === true ) {
					throw new InvalidArgumentException(sprintf('Expose::make expect parameter 2 to be a non-existing function, but "%s" function name is already declared', $function_name));
				}

				if( method_exists($class_name, '__construct') === true ) {
					$php = "
						function $function_name() {
							return (new ReflectionClass('$class_name'))->newInstanceArgs(func_get_args());
						}
					";	
				}
				else {
					$php = "
						function $function_name() {
							return (new ReflectionClass('$class_name'))->newInstanceWithoutConstructor();
						}
					";
				}

				eval($php);
			}
			else if( $count === 1 ) {
				$array = $arguments[0];

				if( is_array($array) === false ) {
					throw new InvalidArgumentException(sprintf('Expose::make expect parameter 1 to be array, %s given', gettype($array)));
				}

				foreach( $array as $index => $row ) {
					if( is_array($row) === false ) {
						throw new InvalidArgumentException(sprintf('Expose::make expect parameter 1 to be array of array, but element at index %i was of type %s', ($index + 1), gettype($row)));
					}

					if( ! isset($row[0]) ) {
						throw new InvalidArgumentException(sprintf('Expose::make expect parameter 1 to be array of array containing 2 items, empty row found at index %i', ($index + 1)));
					}

					if( ! isset($row[1]) ) {
						throw new InvalidArgumentException(sprintf('Expose::make expect parameter 1 to be array of array containing 2 items, but item n.2 was empty at row', ($index + 1)));
					}

					$class_name = $row[0];
					$function_name = $row[1];

					self::make($class_name, $function_name);
 				}
			}
		}
	}
?>