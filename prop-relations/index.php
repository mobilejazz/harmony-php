<?php

$categoryA = new Category(1, 'category a');
$categoryB = new Category(2, 'category b');

// GetProductWithCategoriesQuery
$productWithCategories = new Product(
  1,
  'product a',
  new Collection([$categoryA, $categoryB]),
);

// Works
$productCategories = $productWithCategories->categories->getItems();

// GetProductQuery
$productWithoutCategories = new Product(
  1,
  'product a',
  new Collection(),
);

// Throw Exception
$productCategories = $productWithoutCategories->categories->getItems();

// -------------------------------------------------------

// how to differentiate if Brand was filled or is null

// Oriol suggestion
$productWithBrand = new Product(
  id: 2,
  name: 'product b',
  categories: new Collection(),
  brandId: 1,
  brand: null, //new Brand(1, 'brand a'),
);

// Miguel Angel suggestion
$productWithoutBrand = new Product(
  id: 2,
  name: 'product b',
  categories: new Collection(),
  brand: null, //new Brand(1, 'brand a'),
);

// Àlex Suggestion
// GetProductWithBrandQuery
$productWithOptionalBrand = new Product(
  id: 2,
  name: 'product b',
  categories: new Collection(),
  brand_: new Relation(new Brand(1, 'brand a')),
);

// Works
$productBrand = $productWithOptionalBrand->brand_->getValue();

// GetProductQuery
$productWithoutOptionalBrand = new Product(
  id: 2,
  name: 'product b',
  categories: new Collection(),
  brand_: new Relation(),
);

// Throw Exception
$productBrand = $productWithoutOptionalBrand->brand_->getValue();
