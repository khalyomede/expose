<?php
	require( __DIR__ . '/../vendor/autoload.php' );

	use Khalyomede\Expose;

	class Collection {
		protected $items;

		public function __construct($items = []) {
			$this->items = $items;
		}

		public function all() {
			return $this->items;
		}
	}

	Expose::make(Collection::class, 'collection');

	$items = collection(['php', 'python', 'nodejs'])->all();

	print_r($items);
?>