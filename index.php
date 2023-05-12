<?php
/**
 * Index.php file for local rendering.
 */

echo '<style>';
	require_once 'assets/css/style.min.css';
echo '</style>';

require_once 'class-product.php';
require_once 'class-category.php';
require_once 'class-productlookup.php';

global $global_data;

/**
 * Create an advanced product class.
 */
class AdvancedProduct extends Product {
	/**
	 * Construct
	 *
	 * @param string $name Product name.
	 * @param string $image Product image.
	 * @param string $price Product price.
	 * @param string $description Product description.
	 */
	public function __construct( string $name, string $image, string $price, string $description ) {
		parent::__construct( $name );
		$this->image       = $image;
		$this->price       = $price;
		$this->description = $description;
	}
}

$global_data = array(
	new Category( 'Mens', array( new AdvancedProduct( 'Blue Tee', 'blue-tee.jpeg', 'R150', '' ), new AdvancedProduct( 'Olive Tee', 'olive-tee.jpeg', 'R150', '' ) ) ),
	new Category( 'Kids', array( new AdvancedProduct( 'Sneaker', 'sneaker.jpeg', 'R1250', '' ), new Product( 'Toy car' ) ) ),
	new Category( 'Sports', array() ),
);

// Showcase adding extra data to the global data.
$extra_data = array(
	new Category( 'Women', array( new Product( 'White Skirt' ), new Product( 'Blue Blouse' ) ) ),
	new Category( 'Accessories', array( new AdvancedProduct( 'Hat', 'olive-hat.jpeg', 'R199', '' ), new Product( 'Backpack' ) ) ),
);

$global_data = array_merge( $global_data, $extra_data );

$product_lookup = new ProductLookup();

/**
 * Check if a product exsists in a specific cateogry.
 * You can deine the product name and the category.
 * Returns true if the product is in the category and false if it doesn't.
 */
// var_dump( $product_lookup->does_product_exist_in_category( 'Blue Tee', 'Mens', $global_data ) );

/**
 * Get the products in a specific category.
 * You can define a particular product or get all
 * returns an array.
 */
// var_dump( $product_lookup->get_products_in_category( 'Mens', $global_data ) );

/**
 * Render the products of a specific category.
 * This one has "Mens" category specified and a specific product
 * removing the categoy and product name it or leaving the, blank shows all categories and all products.
 */
echo $product_lookup->render_products( $global_data );
