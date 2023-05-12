<?php
/**
 * Product related functions live here.
 */

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

				$img   = ( isset( $product->image ) && ! empty( $product->image ) ? 'media/' . $product->image : 'assets/images/default.png' );
				$html .= '<img width="240" height="240" alt="' . $product->name . '" src="' . $img . '" />';

				$html .= '<h3 class="product_title">' . $product->name . '</h3>';

			if ( isset( $product->price ) ) {
				$html .= '<div class="product_price">' . $product->price . '</div>';
			}

			$html .= '</div>';
		}
			$html .= '</div>';

		$html .= '</section>';
	}
	$html .= '</div>';

	return $html;
}
