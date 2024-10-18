<?php
/**
 * Theme guttenberg block init
 * 
 * @package Bluey Shop WC
 */
namespace Bluey\BlockStyles;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

class BlockInit {
    public function __construct(){
        add_filter( 'block_categories_all', array($this, 'register_block_categories'), 10, 1 );
    }

    /**
     * Register block categories
     * 
     * @param array $categories Array of default block categories
     * 
     * @return array
     */
    public function register_block_categories( $categories ){
        /**
         * @var array $category_args Category identification
         */
        $category_args = array(
            'slug' => 'bluey-shop',
            'title' => __('Bluey Shop', THEME_TEXT_DOMAIN)
        );

        array_unshift( $categories, $category_args );

        return $categories;
    }
}