<?php

/**
 * Single product short description
 *
 * @author  Automattic
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;

$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) :
?>
	<div class="flatsome-product-data">
		<h4>Product Information</h4>
		<?php foreach ($product_tabs as $key => $product_tab) : ?>
			<?php
			if (esc_attr($key) === "additional_information") : ?>
				<?php
				if (isset($product_tab['callback'])) {
					call_user_func($product_tab['callback'], $key, $product_tab);
				}
				?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>