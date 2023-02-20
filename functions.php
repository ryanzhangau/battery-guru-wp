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
