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
 * @param string $category_name Category name to look though.
 * @param array  $categories All categories.
 *
 * @return bool
 */
function does_product_exsist_in_category( string $product_name, string $category_name, array $categories ): bool {
	foreach ( $categories as $category ) {
		if ( $category->name === $category_name ) {
			foreach ( $category->products as $product ) {
				if ( $product->name === $product_name ) {
					return true;
				}
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

			// Category Title.
			$html .= '<h2 class="category_title">' . $category->name . '</h2>';

			$html .= '<div class="all_products_wrapper">';
				if ( isset( $category->products ) && ! empty( $category->products ) ) { // Check there are products before trying to render them.
					foreach ( $category->products as $product ) { // Loop through each of the products.
						$html .= '<div class="product_wrapper">';

							// Show the image if it's set.
							$img   = ( isset( $product->image ) && ! empty( $product->image ) ? 'media/' . $product->image : 'assets/images/default.png' );
							$html .= '<img width="240" height="240" alt="' . $product->name . '" src="' . $img . '" />';

							// Product name.
							$html .= '<h3 class="product_title">' . $product->name . '</h3>';

							// Show Pricing if it's set.
							if ( isset( $product->price ) ) {
								$html .= '<div class="product_price">' . $product->price . '</div>';
							}

						$html .= '</div>';
					} // End of foreach loop.
				} else { // Else show this message when there are no products.
					$html .= 'No products to show in this category.';
				}
			$html .= '</div>';

		$html .= '</section>';
	}
	$html .= '</div>';

	return $html;
}
