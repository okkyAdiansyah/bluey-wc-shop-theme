<?php
/**
 * Main theme singleton for initialization
 * 
 * @package Bluey Shop WC
 */
namespace Bluey;

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeInit {
    /**
     * Class variable
     * 
     * @var ThemeInit public $instance ThemeInit instance everytime get called
     * @var array public $services All theme services after instantiated
     * @var array protected $template_pages All theme template pages after switching theme 
     * @var array protected $theme_services All theme services before instantiated
     */
    public $instance = null;
    public $services = array();
    protected $template_pages = array();
    protected $theme_services = array();

    /**
     * Return itself when called
     * 
     * @return ThemeInit $instance
     */
    public static function get_instance(){

    }

    /**
     * Init wp hook and filter
     * 
     * @return void
     */
    public function bs_init(){
        
    }

    /**
     * Theme main setup
     * 
     * @return void
     */
    private function bs_theme_setup(){

     }

    /**
     * Register theme services into $services
     * 
     * @return void
     */
    public function bs_register_services(){

    }

    /**
     * Access theme services function
     * 
     * @return array $services
     */
    public function bs_get_services(){

    }
    
    /**
     * Instantiated theme services
     * 
     * @param Class $theme_service Service that need to be instantiated
     * 
     * @return void
     */
    private function bs_instantiated(){

    }

    /**
     * Enqueue main theme script and style
     * 
     * @return void
     */
    private function bs_enqueue_main_theme_scripts(){

    }

    /**
     * Enqueue block scripts and style
     * 
     * @return void
     */
    private function bs_enqueue_theme_block_scripts(){

    }

    /**
     * Assign defer attribute to main script
     * 
     * @return void
     */
    private function bs_assign_defer_att(){

    }

    /**
     * Assign module type to block script
     * 
     * @return void
     */
    private function bs_assign_module_type(){
        
    }

}