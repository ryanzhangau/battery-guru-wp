<?php

/* Function to enqueue stylesheet from parent theme */
add_action("wp_enqueue_scripts", "child_enqueue__parent_scripts");

function child_enqueue__parent_scripts()
{
    wp_enqueue_style("parent", get_stylesheet_directory_uri() . "/style.css");
    wp_enqueue_script("test", get_stylesheet_directory_uri() . "/js/custom.js", array(), null, true);
}

/**
 * Move WooCommerce subcategory list items into their own <ul> separate from the product <ul>.
 */
add_action('init', 'flatsome_move_subcat_list');
function flatsome_move_subcat_list()
{
    // Remove the subcat <li>s from the old location.
    remove_filter('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');
    add_action('woocommerce_before_shop_loop', 'flatsome_product_loop_start', 1);
    add_action('woocommerce_before_shop_loop', 'flatsome_maybe_show_product_subcategories', 2);
    add_action('woocommerce_before_shop_loop', 'flatsome_product_loop_end', 3);

    remove_filter('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail');
}

/**
 * Conditonally start the product loop with a <ul> contaner if subcats exist.
 */
function flatsome_product_loop_start()
{
    $subcategories = woocommerce_maybe_show_product_subcategories();
    if ($subcategories) {
        woocommerce_product_loop_start();
    }
}

/**
 * Print the subcat <li>s in our new location.
 */
function flatsome_maybe_show_product_subcategories()
{
    echo woocommerce_maybe_show_product_subcategories();
}

/**
 * Conditonally end the product loop with a </ul> if subcats exist.
 */
function flatsome_product_loop_end()
{
    $subcategories = woocommerce_maybe_show_product_subcategories();
    if ($subcategories) {
        woocommerce_product_loop_end();
    }
}

/**
*   Change Proceed To Checkout Text in WooCommerce
*   Add this code in your active theme functions.php file
**/
function woocommerce_button_proceed_to_checkout() {
    $isNoShipping = WC()->session->get('shipping_method_counts')[0] === 0;
    $new_checkout_url = WC()->cart->get_checkout_url();
    if ($isNoShipping):
    ?>
        <a class="checkout-button button alt wc-forward disabled">
    <?php else: ?>
        <a href="<?php echo $new_checkout_url; ?>" class="checkout-button button alt wc-forward">
    <?php endif;?>
    <?php _e( 'Proceed to checkout', 'woocommerce' ); ?></a>
<?php
}

/* Hide Woocommerce shipping method for a specific shipping class (for free shipping) */
add_filter( 'woocommerce_package_rates', 'exclude_shipping_for_shipping_classes', 10, 2 );
function exclude_shipping_for_shipping_classes( $rates, $package ) {
    // Get the shipping class ID(s) to be excluded from shipping
    $excluded_shipping_classes = array(463);
    $excluded_method_Ids = array('auspost');

    // Check if the package contains any products from the excluded category
    $exclude_package = false;
    foreach ( $package['contents'] as $item_id => $item ) {
        if ( has_term( $excluded_shipping_classes, 'product_shipping_class', $item['data']->get_id() ) ) {
            $exclude_package = true;
            break;
        }
    }
    // If the package contains any products from the excluded category, remove the shipping methods
    if ( $exclude_package ) {
        foreach ( $rates as $rate_key => $rate ) {
            if ( in_array($rate->method_id, $excluded_method_Ids) ) {
                unset( $rates[ $rate_key ] );
            }
            // Add more conditions for other shipping methods you want to remove
            // For example, to remove free shipping:
            // if ( 'free_shipping' === $rate->method_id ) {
            //     unset( $rates[ $rate_key ] );
            // }
        }
    }
    // Return the modified shipping rates
    return $rates;
}

