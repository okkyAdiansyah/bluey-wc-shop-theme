<?php
/**
 * Theme engine
 * 
 * @package Bluey Shop WC
 */

// Accessed directly
if( ! defined( 'ABSPATH' ) ){
    exit;
}

// include autoload
if( file_exists( __DIR__ . '/vendor/autoload.php' ) ){
    require_once __DIR__ . '/vendor/autoload.php';
}

$theme = wp_get_theme( 'bluey-shop-wc' );

// Global constant
define( 'THEME_VERSION', $theme['Version'] );
define( 'THEME_TEXT_DOMAIN', $theme['Text Domain'] );

use Bluey\ThemeInit;

$theme_init = ThemeInit::get_instance();