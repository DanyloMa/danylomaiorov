<?php
/**
 * Plugin Name: Random Products Plugin
 * Description: This plugin provides a shortcode to display random products from WooCommerce.
 * Version: 1.3.0
 * Author: Danyl M.
 */

require_once plugin_dir_path(__FILE__) . 'classes/class-random-products.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-random-products-admin.php';

// Instantiate our classes
$random_products = new Random_Products();
$random_products_admin = new Random_Products_Admin($random_products);
