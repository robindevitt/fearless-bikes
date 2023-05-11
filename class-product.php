<?php
/**
 * Product Class.
 */
class Product {
	public string $name;

	/**
	 * Construct
	 *
	 * @param string $name Product name.
	 */
	public function __construct( string $name ) {
		$this->name = $name;
	}
}
