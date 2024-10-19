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

use Bluey\BlockStyles\BlockInit;

class ThemeInit {
    /**
     * Class variable
     * 
     * @var ThemeInit public $instance ThemeInit instance everytime get called
     * @var array public $services All theme services after instantiated
	 * @var array public $scripts_to_defer Collection of script that need defer attribute
     * @var array protected $template_pages All theme template pages after switching theme 
     * @var array protected $unregistered_services All theme services before instantiated
     */
    public static $instance = null;
    public $services = array();
	public $scripts_to_defer = array('bs-main-script');

    protected $template_pages = array(
		'about-us',
		'home',
		'contact',
		'f.a.q'
	);
    protected $unregistered_services = array(

	);

    private function __construct(){
        /**
         * Call function on class instantiated
         */
        $this->bs_init();
    }

    /**
     * Return itself when called
     * 
     * @return ThemeInit $instance
     */
    public static function get_instance(){
        if( self::$instance === null ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Init wp hook and filter
     * 
     * @return void
     */
    private function bs_init(){
        // Init theme setup

		/**
		 * Only call action hook under this comment
		 */
		add_action( 'init', array( $this, 'bs_set_static_front_page' ) );
        add_action( 'after_setup_theme', array( $this, 'bs_theme_setup' ), 10 );
		add_action( 'after_switch_theme', array( $this, 'bs_init_template_page_registration' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'bs_enqueue_main_theme_scripts' ), 10 );

		/**
		 * only call filter hook under this comment
		 */
		// add_filter( 'script_loader_tag', array( $this, 'bs_assign_defer_attr' ), 10, 2 );

		/**
		 *
		 */

    }

    /**
     * Theme main setup
     * 
     * @return void
     */
    public function bs_theme_setup(){
        /**
	     * Add default posts and comments RSS feed links to head.
	     */
	    add_theme_support( 'automatic-feed-links' );

	    /*
	     * Enable support for Post Thumbnails on posts and pages.
	     *
	     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
	     */
	    add_theme_support( 'post-thumbnails' );

        /**
         * Enable menu creation support
         */
        add_theme_support( 'menus' );

	    /**
	     * Enable support for site logo.
	     */
	    add_theme_support(
	    	'custom-logo',
	    	apply_filters(
	    		'bluey_custom_logo_args',
	    		array(
	    			'height'      => 110,
	    			'width'       => 470,
	    			'flex-width'  => true,
	    			'flex-height' => true,
	    		)
	    	)
        );

	    /**
	     * Register menu locations.
	     */
	    register_nav_menus(
	    	apply_filters(
	    		'bluey_register_nav_menus',
	    		array(
	    			'primary'   => __( 'Primary Menu', THEME_TEXT_DOMAIN ),
	    			'secondary' => __( 'Secondary Menu', THEME_TEXT_DOMAIN ),
	    			'responsive'  => __( 'Responsive Menu', THEME_TEXT_DOMAIN ),
	    		)
	    	)
        );

	    /*
	     * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
	     * to output valid HTML5.
	     */
	    add_theme_support(
	    	'html5',
	    	apply_filters(
	    		'bluey_html5_args',
	    		array(
	    			'search-form',
	    			'comment-form',
	    			'comment-list',
	    			'gallery',
	    			'caption',
	    			'widgets',
	    			'style',
	    			'script',
	    		)
	    	)
        );

	    /**
	     * Setup the WordPress core custom background feature.
	     */
	    add_theme_support(
	    	'custom-background',
	    	apply_filters(
	    		'bluey_custom_background_args',
	    		array(
	    			'default-color' => apply_filters( 'bluey_default_background_color', 'ffffff' ),
	    			'default-image' => '',
	    		)
	    	)
        );

	    /**
	     * Setup the WordPress core custom header feature.
	     */
	    add_theme_support(
	    	'custom-header',
	    	apply_filters(
	    		'bluey_custom_header_args',
	    		array(
	    			'default-image' => '',
	    			'header-text'   => false,
	    			'width'         => 1950,
	    			'height'        => 500,
	    			'flex-width'    => true,
	    			'flex-height'   => true,
	    		)
	    	)
        );

	    /**
	     * Declare support for title theme feature.
	     */
	    add_theme_support( 'title-tag' );
	    
        /**
	     * Declare support for selective refreshing of widgets.
	     */
	    add_theme_support( 'customize-selective-refresh-widgets' );
	    
        /**
	     * Add support for full and wide align images.
	     */
	    add_theme_support( 'align-wide' );
	    
        /**
	     * Add support for editor styles.
	     */
	    add_theme_support( 'editor-styles' );
	    
        /**
	     * Add support for editor font sizes.
	     */
	    add_theme_support(
	    	'editor-font-sizes',
	    	array(
	    		array(
	    			'name' => __( 'Small', THEME_TEXT_DOMAIN ),
	    			'size' => 14,
	    			'slug' => 'small',
	    		),
	    		array(
	    			'name' => __( 'Normal', THEME_TEXT_DOMAIN ),
	    			'size' => 16,
	    			'slug' => 'normal',
	    		),
	    		array(
	    			'name' => __( 'Medium', THEME_TEXT_DOMAIN ),
	    			'size' => 23,
	    			'slug' => 'medium',
	    		),
	    		array(
	    			'name' => __( 'Large', THEME_TEXT_DOMAIN ),
	    			'size' => 26,
	    			'slug' => 'large',
	    		),
	    		array(
	    			'name' => __( 'Huge', THEME_TEXT_DOMAIN ),
	    			'size' => 37,
	    			'slug' => 'huge',
	    		),
	    	)
        );
	    
        /**
	     * Add support for responsive embedded content.
	     */
	    add_theme_support( 'responsive-embeds' );
        
        /**
         * Woocommerce theme support 
         */
        add_theme_support( 'woocommerce' );
    }

    /**
     * Register theme services
     * 
     * @return void
     */
    public function bs_register_services(){
		//Check if service already registered
		foreach ($this->unregistered_services as $service_name => $service) {
			$this->services[$service_name] = $this->bs_instantiated( $service );
		}
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
     * @param Class $service Service that need to be instantiated
     * 
     * @return void
     */
    private function bs_instantiated( $service ){
		return new $service();
    }

    /**
     * Enqueue main theme script and style
     * 
     * @return void
     */
    public function bs_enqueue_main_theme_scripts(){
		/**
		 * Enqueue script only under this comment
		 */
		wp_enqueue_script( 
			'bs-main-script', 
			get_template_directory_uri(  ) . '/src/assets/scripts/bs-main-script.js', 
			array('jquery'), 
			THEME_VERSION,
			true
		);

		/**
		 * Enqueue style only under this comment
		 */
		wp_enqueue_style( 
			'bs-main-theme', 
			get_template_directory_uri(  ) . '/src/assets/styles/bs-main-style.css', 
			array(), 
			THEME_VERSION
		);
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
	 * @param array $handle All script handle that need defer attribute
	 * @param string $tag Script format generated by Wordpress 
     * 
	 * @return string
     */
    public function bs_assign_defer_attr($handle, $tag){
		if( in_array( $handle, $this->scripts_to_defer ) ){
			return str_replace( ' src', 'defer="defer" src', $tag );
		}
		return $tag;
    }

    /**
     * Assign module type to block script
     * 
     * @return void
     */
    private function bs_assign_module_type(){
        
    }

	/**
	 * Register Template pages
	 * 
	 * @param string $page_slug Page slug that will be register
	 * 
	 * @return void
	 */
	public function bs_register_template_pages($page_slug){
		/**
		 * Format page slug into page name
		 * 
		 * @var string $page_name Formatted page name
		 */
		if( str_contains( $page_slug, '-' ) ){
			$page_name = ucwords( str_replace( '-', ' ', $page_slug ) );
		} else if( str_contains( $page_slug, '.' ) ){
			$page_name = strtoupper( $page_slug );
		} else {
			$page_name = ucfirst( $page_slug );
		}
		
		/**
		 * Check if page already exists
		 * 
		 * @var WP_Post $page_exist Page object by path
		 */
		$page_exist = get_page_by_path( $page_name );

		/**
		 * @var array $page_args Page args for register
		 */
		$page_args = array(
			'post_type' => 'page',
			'post_title' => __($page_name, THEME_TEXT_DOMAIN),
			'post_content' => '',
			'post_status' => 'publish',
			'post_slug' => $page_slug
		);

		// Create page if page didn't exist
		if( ! isset( $page_exist->ID ) ){
			wp_insert_post( $page_args );
		} else {
			return;
		}
	}

	/**
	 * Init Template page registration
	 * 
	 * @return void
	 */
	public function bs_init_template_page_registration(){
		foreach ($this->template_pages as $page_slug) {
			$this->bs_register_template_pages($page_slug);
		}
	}

	/**
	 * Set static front page
	 * 
	 * @return void
	 */
	public function bs_set_static_front_page(){
		// check transient if front page already set
		if( get_transient( 'static_front_page_set' ) ){
			return;
		}

		$front_page = get_page_by_path( 'Home' );

		if($front_page){
			add_option( 
				'show_on_front', 
				'page', 
			);
			add_option( 
				'page_on_front', 
				$front_page->ID, 
			);
		}

		// Set transient to make sure this will running once
		set_transient( 'static_front_page_set', true, 60 * 60 * 24 ); // 24 hours expiration
	}
}