<?php
/**
 * Feel free to change any code.
 *
 * Please complete the following assessment.
 *
 * In the file below you will see an Object $data that has categories and products inside it.
 *
 * There are two functions we would like implemented:
 * getProductsInCategory() - This function needs to return a product inside a category that we can specify.
 * doesProductExistInCategory() - This function needs to let us know if a product exists in a category that we chose.
 *
 * Hints:
 * Please make sure that the Object is extendable and other products and categories can be added and the functions will work.
 * Big-O notation.
 * Using DRY and SOLID principles.
 * You can ask for help or more information at anytime.
 * You can use any resources you like.
 * The frontend is important.
 *
 * Bonus points:
 * - PHP Unit Testing.
 * - Frontend Display/Layout/Template to process data.
 * - Git repository to track the code changes.
 *
 * You will be evaluated on the following:
 * - Code structure, readability, understandably, maintainability and layout.
 * - Code standards used.
 * - Completion of the objective.
 * - Performance of the completed structure.
 * - Frontend Display/Layout/Template to process data using Javascript and CSS.
 */

echo '<style>';
	require_once 'assets/css/style.min.css';
echo '</style>';

require_once 'class-product.php';
require_once 'class-category.php';
require_once 'product-functions.php';

global $global_data;

/**
 * Create an advanced product class.
 */
class AdvancedProduct extends Product {
	public string $image;
	public string $price;
	public string $description;

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
	new Category( 'Mens', array( new AdvancedProduct( 'Blue Shirt', '', 'R150', '' ), new Product( 'Red T-Shirt' ) ) ),
	new Category( 'Kids', array( new Product( 'Sneakers', ), new Product( 'Toy car' ) ) ),
);

// Showcase adding extra data to the global data.
$extra_data = array(
	new Category( 'Women', array( new Product( 'White Skirt' ), new Product( 'Blue Blouse' ) ) ),
	new Category( 'Accessories', array( new Product( 'Wallet' ), new Product( 'Backpack' ) ) ),
);

$global_data = array_merge( $global_data, $extra_data );

echo render_products( '', $global_data );
