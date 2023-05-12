<?php
use PHPUnit\Framework\TestCase;

require_once './class-category.php';
require_once './class-product.php';
require_once './class-productlookup.php';

/**
 * Tests for products in categories.
 */
final class ProductInCategoryTest extends TestCase {
	/**
	 * Setup.
	 */
	protected function setUp(): void {
		$this->categories = array(
			new Category(
				'Mens',
				array(
					new Product( 'Blue Shirt' ),
					new Product( 'Red T-Shirt' ),
				)
			),
			new Category(
				'Kids',
				array(
					new Product( 'Sneakers' ),
					new Product( 'Toy car' ),
				)
			),
		);

		$this->product_lookup = new ProductLookup();
	}

	/**
	 * Test to confirm the product exsists in a specific cateogry.
	 */
	public function testProductExistsInCategory(): void {
		$this->assertTrue( $this->product_lookup->does_product_exist_in_category( 'Blue Shirt', 'Mens', $this->categories ) );
	}

	/**
	 * Test to see confimr the product doesn't exsists in a specific cateogry.
	 */
	public function testProductDoesntExistsInCategory(): void {
		$this->assertFalse( $this->product_lookup->does_product_exist_in_category( 'Green Shirt', 'Mens', $this->categories ) );
	}

}
