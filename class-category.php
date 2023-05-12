<?php
/**
 * Product Category.
 */
class Category {
	/**
	 * Construct.
	 *
	 * @param string $name Category name.
	 * @param array  $products Products in an array.
	 */
	public function __construct( string $name, array $products ) {
		$this->name     = $name;
		$this->products = $products;
	}
}
