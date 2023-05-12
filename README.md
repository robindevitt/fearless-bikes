# Fearless Bikes
This is a repo with a showcase of some basic php functions to render some predetermined products and some unit tests.

## Available Functions

#### Check if a product exsists in a category
```php
$product_lookup = new ProductLookup();
$product_lookup->does_product_exist_in_category( string $product_name, string $category_name, array $categories );
```
Here we are checking in the "Blue Tee" exists in the "Mens" category. True or False is returned.

It's paramaters are:
- `string $product_name` The name of the product you are looking for.
- `string $category_name` The category name of the category you wish to look through.
- `array $categories` An array of categories to look through.


#### Return the products within a cateogry
```php
$product_lookup = new ProductLookup();
product_lookup->get_products_in_category( string $category_name, array $categories, string $product_name = '');
```
Show all the products in the defined cateogry. The data is returned as an array. The function takes a third parameter too, which is a `string` and it would be the product name. Should the product exist then it will be returned.

It's paramaters are:
- `string $category_name` The category name of the products you wish to return.
- `array $categories` An array of categories to look through.
- `string $product_name` An optional item should you wish to render a single product.


#### Render products
```php
$product_lookup = new ProductLookup();
$product_lookup->render_products();
```
This function makes use of the `get_products_in_category( array $categories, string $category = '', string $product_name = '')` function except that it renders all the products into a basic grid.

It's paramaters are:
- `array $categories` An array of categories to look through.
- `string $category_name` An optional item, if it's empty all catgories are shown.
- `string $product_name` An optional item should you wish to render a single product.




## Running Tests
Ensure the folder/ repo is setup on your machine. Using terminal navigate into the folder. To run tests, run the following command:

```bash
  composer install 
```

Once the `composer.lock` file is created you cna then run the following command:
```bash
  ./vendor/bin/phpunit tests
```

For a more detailed output run the following:
```bash
  ./vendor/bin/phpunit --testdox tests
```
