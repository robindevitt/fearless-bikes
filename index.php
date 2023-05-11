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

global $global_data;

$global_data = array(
	new Category( 'Mens', array( new Product( 'Blue Shirt' ), new Product( 'Red T-Shirt' ), new Product( 'Blue Shirt' ), new Product( 'Red T-Shirt' ), new Product( 'Blue Shirt' ), new Product( 'Red T-Shirt' ) ) ),
	new Category( 'Kids', array( new Product( 'Sneakers' ), new Product( 'Toy car' ) ) ),
);

// Showcase adding extra data to the global data.
$extra_data = array(
	new Category( 'Women', array( new Product( 'White Skirt' ), new Product( 'Blue Blouse' ) ) ),
	new Category( 'Accessories', array( new Product( 'Wallet' ), new Product( 'Backpack' ) ) ),
);

$global_data = array_merge( $global_data, $extra_data );

/**
 * Return a product inside a category.
 *
 * @param string $category_name Category name to look for.
 * @param array  $categories Catogries to check through.
 *
 * @return array
 */
function get_products_in_category( string $category_name, array $categories ) {
	$return_categories = array();
	foreach ( $categories as $category ) {
		if ( $category->name === $category_name ) {
			return array( $category );
		}
	}
	return null;
}

/**
 * Check if a product exsists in a category.
 *
 * @param string $product_name Product name to look for.
 * @param array  $categories Catogries to check through.
 *
 * @return bool
 */
function does_product_exsist_in_category( string $product_name, array $categories ): bool {
	foreach ( $categories as $category ) {
		foreach ( $category->products as $product ) {
			if ( $product->name === $product_name ) {
				return true;
			}
		}
	}
	return false;
}

/**
 * Function to render products.
 *
 * @param string $category Category to render, leaving it blank shows all categories.
 * @param array  $categories Catogries to loop through.
 */
function render_products( string $category, array $categories ) {

	if ( ! empty( $category ) ) {
		$categories = get_products_in_category( $category, $categories );
	}

	$html = '<div id="render_wrapper">';
	foreach ( $categories as $category ) {

		$html .= '<section class="category_wrapper">';

			$html .= '<h2 class="category_title">' . $category->name . '</h2>';

			$html .= '<div class="all_products_wrapper">';
				// Loop through each of the products.
		foreach ( $category->products as $product ) {
			$html .= '<div class="product_wrapper">';

				$img   = ( isset( $category->image ) ? $category->image : 'default.png' );
				$html .= '<img alt="' . $product->name . '" src="assets/images/' . $img . '" />';

				$html .= '<h3 class="product_title">' . $product->name . '</h3>';

			$html .= '</div>';
		}
			$html .= '</div>';

		$html .= '</section>';
	}
	$html .= '</div>';

	return $html;
}

echo render_products( '', $global_data );
