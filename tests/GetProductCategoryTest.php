<?php
use PHPUnit\Framework\TestCase;

require_once './class-category.php';
require_once './class-product.php';
require_once './class-productlookup.php';

final class GetProductCategoryTest extends TestCase {
	protected function setUp(): void {
		$this->categories = array(
			new Category(
				'Clothing',
				array(
					new Product( 'Olive Shirt' ),
				)
			),
			new Category(
				'Entertainment',
				array(
					new Product( 'Toy' ),
				)
			),
		);

		$this->expected = array(
			new Category(
				'Clothing',
				array(
					new Product( 'Olive Shirt' ),
				)
			),
		);

		$this->product_lookup = new ProductLookup();
	}

	/**
	 * Test for product in a cateogry that does exist.
	 */
	public function testGetProductsInCategory(): void {
		$actual = $this->product_lookup->get_products_in_category( 'Clothing', $this->categories );
		$this->assertEquals( $this->expected, $actual, 'The category contains products' );
	}

	/**
	 * Test for producuts in a category that doesn't exist.
	 */
	public function testGetProductsNotInCategory(): void {
		$this->assertSame( array(), $this->product_lookup->get_products_in_category( 'Non-existent Category', $this->categories ), 'The category contains NO products' );
	}
}
