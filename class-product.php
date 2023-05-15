<?php
/**
 * Product Class.
 */
class Product {
	/**
	 * Construct
	 *
	 * @param string $name Product name.
	 * @param string $image Product image.
	 */
	public function __construct( string $name, string $image ) {
		$this->name  = $name;
		$this->image = $image;
	}
}
