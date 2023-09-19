<?php

class Random_Products
{
    public const RANDOM_PRODUCTS = 2;

    /**
     * Retrieving the list of basic information about products
     *
     * @param $count
     * @return array
     */
	public function get_random_products($count = self::RANDOM_PRODUCTS): array
    {
		$args = array(
			'limit' => $count,
			'orderby' => 'rand',
			'return' => 'ids',
		);

		$products_ids = wc_get_products($args);

		$products = [];
		foreach ($products_ids as $product_id) {
			$product = wc_get_product($product_id);
			$products[] = array(
				'id' => $product_id,
				'title' => $product->get_name(),
				'link' => $product->get_permalink(),
			);
		}

		return $products;
	}
}
