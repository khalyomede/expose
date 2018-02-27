<?php
	require( __DIR__ . '/../vendor/autoload.php' );

	use Khalyomede\Expose;

	class Collection {
		protected $items;

		public function __construct($array) {
			$this->items = $array;
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

	Expose::make([
		[Collection::class, 'collection'],
		['Log', 'logging']
	]);

	$items = collection(['php', 'python', 'nodejs'])->all();

	print_r($items);

	logging("duplicate entry 'Stephen' on line 12")->error();
?>