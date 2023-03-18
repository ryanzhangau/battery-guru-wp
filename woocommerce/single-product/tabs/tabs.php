<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$tabs_style = get_theme_mod('product_display', 'tabs');

// Get sections instead of tabs if set.
if ($tabs_style == 'sections') {
	wc_get_template_part('single-product/tabs/sections');

	return;
}

// Get accordion instead of tabs if set.
if ($tabs_style == 'accordian' || $tabs_style == 'accordian-collapsed') {
	wc_get_template_part('single-product/tabs/accordian');

	return;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());
?>

<?php foreach ($product_tabs as $key => $product_tab) : ?>
	<?php
	if (esc_attr($key) === "description") {
		echo "<hr />";
		echo "<h2>Product Description</h2>";
		if (isset($product_tab['callback'])) {
			call_user_func($product_tab['callback'], $key, $product_tab);
			echo "<br/>";
			break;
		}
	} ?>
<?php endforeach; ?>

