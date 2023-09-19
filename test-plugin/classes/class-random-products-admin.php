<?php

class Random_Products_Admin
{
    /**
     * @var Random_Products
     */
	private Random_Products $random_products;

    /**
     * @param Random_Products $random_products
     */
	public function __construct(Random_Products $random_products)
    {
		$this->random_products = $random_products;
		add_action('admin_menu', [$this, 'register_admin_menu']);
		add_shortcode('random_products', [$this, 'display_random_products']);
	}

    /**
     * We need to register admin menu
     *
     * @return void
     */
	public function register_admin_menu() {
		add_menu_page('Random Products', 'Random Products', 'manage_options', 'random_products', array($this, 'admin_page'), 'dashicons-products', 6);
	}

    /**
     * Admin page for our plugin
     *
     * @return void
     */
	public function admin_page() {
		if (isset($_POST['product_count'])) {
			update_option('random_product_count', intval($_POST['product_count']));
			echo '<div class="updated"><p>Product count updated!</p></div>';
		}

		$count = get_option('random_product_count', Random_Products::RANDOM_PRODUCTS);

		?>
		<div class="wrap">
			<h2>Random Products Settings</h2>
			<form method="post" action="">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Number of Random Products</th>
						<td><input type="number" name="product_count" value="<?php echo $count; ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

    /**
     * @return string
     */
	public function display_random_products(): string
    {
		$products = $this->random_products->get_random_products(get_option('random_product_count', Random_Products::RANDOM_PRODUCTS ));

		$output = '<ul>';
		foreach ($products as $product) {
			$output .= '<li><a href="' . esc_url($product['link']) . '">' . esc_html($product['title']) . '</a></li>';
		}
		$output .= '</ul>';

		return $output;
	}
}
