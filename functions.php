<?php
require __DIR__ . '/inc/author.php';
require __DIR__ . '/inc/category.php';

// Initialization of parts
$authorExtras = GW\Theme\Author::instance();
$categoryExtras = GW\Theme\Category::instance();

// Add this theme's styles
add_action('wp_enqueue_scripts', 'gw_enqueue_scripts');
function gw_enqueue_scripts() {
  // styles
  wp_enqueue_style('google-font-css', 'https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic');
  wp_enqueue_style('guahanweb-css', get_template_directory_uri() . '/css/guahanweb.css');

  // scripts
  wp_enqueue_script('guahanweb-js', get_template_directory_uri() . '/js/guahanweb.js', ['jquery'], null, true);
}

// Add admin styles
add_action('admin_enqueue_scripts', 'gw_admin_enqueue_scripts');
function gw_admin_enqueue_scripts() {
    wp_register_style('gw-admin-css', get_template_directory_uri() . '/css/admin.css');
    wp_enqueue_style('gw-admin-css');
}

// Remove the admin top bar from pages
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
