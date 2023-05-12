<?php
use PHPUnit\Framework\TestCase;

require_once './class-category.php';
require_once './class-product.php';
require_once './class-productlookup.php';

final class ProductInCategoryTest extends TestCase {
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

	public function testProductExistsInCategory(): void {

		$this->assertTrue( $this->product_lookup->does_product_exist_in_category( 'Blue Shirt', 'Mens', $this->categories ) );

	}

	public function testProductDoesntExistsInCategory(): void {
		$product_lookup = new ProductLookup();

		$this->assertFalse( $this->product_lookup->does_product_exist_in_category( 'Green Shirt', 'Mens', $this->categories ) );

	}


}
