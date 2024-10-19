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
        /**
		 * Only call action hook under this comment
		 */
        add_action( 'init', array($this, 'bs_register_blocks'), 0 );
        add_action( 'enqueue_block_assets', array($this, 'bs_enqueue_block_assets'), 10 );

        /**
		 * only call filter hook under this comment
		 */
        add_filter( 'block_categories_all', array($this, 'bs_register_block_categories'), 10, 1 );
        add_filter( 'script_loader_tag', array($this, 'bs_add_module_attr'), 10, 2 );
    }

    /**
     * Register block categories
     * 
     * @param array $categories Array of default block categories
     * 
     * @return array
     */
    public function bs_register_block_categories( $categories ){
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

    /**
     * Enqueue block assets
     * 
     * @return void
     */
    public function bs_enqueue_block_assets(){
        wp_enqueue_script( 
            'bluey-shop-block', 
            get_template_directory_uri(  ) . '/build/index.js', 
            array( 'wp-blocks', 'wp-element', 'wp-editor' ), 
            THEME_VERSION, 
            true 
        );

        wp_enqueue_style( 
            'bluey-block-editor-style', 
            get_template_directory_uri(  ) . '/build/index.css', 
            array(), 
            THEME_VERSION
        );

        wp_enqueue_style( 
            'bluey-block-editor-rtl-style', 
            get_template_directory_uri(  ) . '/build/index-rtl.css', 
            array(), 
            THEME_VERSION
        );

        wp_enqueue_style( 
            'bluey-block-style', 
            get_template_directory_uri(  ) . '/build/style-index.css', 
            array(), 
            THEME_VERSION
        );

        wp_enqueue_style( 
            'bluey-block-rtl-style', 
            get_template_directory_uri(  ) . '/build/style-index-rtl.css', 
            array(), 
            THEME_VERSION
        );
    }

    /**
     * Register block
     * 
     * @return void
     */
    public function bs_register_blocks(){
        foreach( glob( get_template_directory(  ) . '/blocks/*/block.json' ) as $file ){
            register_block_type( dirname( $file ) );
        }
    }

    /**
     * Add ES6 module support to block assets
     * 
     * @param string $handle Script handler identification
     * @param string $tag Replaced attribute
     * 
     * @return void
     */
    public function bs_add_module_attr( $tag, $handle ){
        if( 'bluey-shop-block' !== $handle ){
            return $tag;
        }

        return str_replace( ' src', ' type="module" src', $tag );
    }
}