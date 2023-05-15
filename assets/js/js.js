// Sorting options for re-use if neeeded.
const sortingOptions = {
	'categories-az': { attribute: 'category', reverse: false, sortCategories: true, sortProducts: false },
	'categories-za': { attribute: 'category', reverse: true, sortCategories: true, sortProducts: false },
	'products-az': { attribute: 'category', reverse: false, sortCategories: false, sortProducts: true },
	'products-za': { attribute: 'category', reverse: true, sortCategories: false, sortProducts: true },
	'all-az': { attribute: 'category', reverse: false, sortCategories: true, sortProducts: true },
	'all-za': { attribute: 'category', reverse: true, sortCategories: true, sortProducts: true },
};
// Setup the sorting based on selection.
$('#sort').change(function () {
	var value = $('#sort option:selected').val();
	var container = $('#render_wrapper');
	var sortingParams = sortingOptions[value];
	var sortedCategories = sortCategoryWrapperByDataAttribute(sortingParams.attribute, sortingParams.reverse, sortingParams.sortCategories, sortingParams.sortProducts);
	container.detach().empty().append(sortedCategories);
	$('body').append(container);
});

// Search.
$('#search').keyup(user_input_dealy(function (e) {
	var value = $(this).val().toLowerCase(); // Get the value and convert to lowercase.
	$('.no_results').remove();
	$('.category_wrapper').show();
	// Loop through all products.
	$('.product_title').each(function () {
		var text = $(this).text().toLowerCase(); // Get the text content and convert to lowercase.

		// If the text content does not include the search value, hide the div.
		if (text.indexOf(value) === -1) {
			$(this).parent().hide();
		} else {
			$(this).parent().show(); // Otherwise, show the div.
		}
	});

	// Check if any parent div has no visible children and hide it if necessary.
	$('.category_wrapper').each(function () {
		if ($(this).find('.product_wrapper:visible').length === 0) {
			$(this).hide();
		} else {
			$(this).show();
		}
	});

	// Add the error message if no products match the search query.
	if ($('.product_wrapper:visible').length === 0) {
		$('#render_wrapper').append('<p class="no_results">No results match your search, please try searching something else.</p>');
	} else {
		$('.no_results').remove();
	}
}, 400));

// Function to sort the categories alphabetically.
function sortCategoryWrapperByDataAttribute(attribute, reverse = false, sortCategories = false, sortProducts = false) {
	// Sort categories
	if (sortCategories){
		var sortFunction = function (a, b) {
			var aVal = $(a).data(attribute);
			var bVal = $(b).data(attribute);
			if (reverse) {
				return String.prototype.localeCompare.call(bVal, aVal);
			} else {
				return String.prototype.localeCompare.call(aVal, bVal);
			}
		};

		var sortedCategories = $('.category_wrapper').sort(sortFunction);

	}

	// Sort products.
	if (sortProducts) {
		var sortedCategories = $('.category_wrapper').sort(sortFunction);

		sortedCategories.each(function () {
			var productsWrapper = $(this).find('.all_products_wrapper');
			var sortedProducts = productsWrapper.children('.product_wrapper').sort(function (a, b) {
				var aVal = $(a).find('.product_title').text();
				var bVal = $(b).find('.product_title').text();

				if (reverse) {
					return String.prototype.localeCompare.call(bVal, aVal);
				} else {
					return String.prototype.localeCompare.call(aVal, bVal);
				}
				
			});
			productsWrapper.append(sortedProducts);
		});
	}

	return sortedCategories;
}

// setup the delay of the search.
function user_input_dealy(callback, ms) {
	var timer = 0;
	return function () {
		var context = this, args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			callback.apply(context, args);
		}, ms || 0);
	};
}
