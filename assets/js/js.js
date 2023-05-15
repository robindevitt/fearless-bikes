// Sorting.
$('#sort_categories').change(function () {
	var value = $('#sort_categories option:selected').val();
	var container = $('#render_wrapper');
	var sortCategories;

	if (value == 'a-z') {
		sortCategories = sortCategoryWrapperByDataAttribute('category');
	} else if (value == 'z-a') {
		sortCategories = sortCategoryWrapperByDataAttribute('category', true);
	}

	container.detach().empty().append(sortCategories);
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
function sortCategoryWrapperByDataAttribute(attribute, reverse = false) {
	var sortFunction = function (a, b) {
		var aVal = $(a).data(attribute);
		var bVal = $(b).data(attribute);
		return String.prototype.localeCompare.call(aVal, bVal);
	};

	if (reverse) {
		sortFunction = function (a, b) {
			var aVal = $(a).data(attribute);
			var bVal = $(b).data(attribute);
			return String.prototype.localeCompare.call(bVal, aVal);
		};
	}

	return $('.category_wrapper').sort(sortFunction);
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
