<?php

// Die if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
   _e( 'Hello, i\'m just plugin, and i\'m called when wordpress call me!', 'simple-copy');
   die();
}

if ( ! class_exists( SimpleCopyright::class ) ) :


/**
 * The core plugin class.
   * 
   * This is used to define internationalization, admin-specific hooks, and
   * public-facing site hooks.
   * 
   * @since 1.0.0
   */
class SimpleCopyright
{  
   /**
    * If the class has been initialized.
    *
    * @var     bool
    * @since   1.0.0
    */
   private static $is_initialized = false;

   /**
    * Post Type Name
    * 
    * @since 1.0.0
    */
   public static $post_type = 'simplecopy';

   /**
    * The slug of the plugin.
    *
    * @since 1.0.0
    */
   public static $plugin_slug = 'simplecopy';

   /**
    * The version of the plugin.
    *
    * @since 1.0.0
    */
   public static $plugin_version = '1.0.0';

   /**
    * Constructor
    * Initialize the class.
    *
    * @since 1.0.0
    */
   public function __construct() {
      if ( ! self::$is_initialized ) {
         self::init_hooks();
         new SimpleCopyright_Page();
      }
   }

   /**
    * Initialize the hooks
    *
    * @since 1.0.0
    */
   private static function init_hooks() {
      self::$is_initialized = true;

      // hooks for admin/front styles and scripts
      add_action( 'admin_enqueue_scripts', array( __CLASS__ , 'sc_enqueue_admin' ) );
      add_action( 'wp_enqueue_scripts', array( __CLASS__ , 'sc_enqueue_front' ) );

      // hooks for loading text domain
      add_action( 'plugins_loaded', array( __CLASS__ , 'sc_load_text_domain' ) );
   }

   /**
    * Loads the text domain for the plugin.
    *
    * @since 1.0.0
    */
   public static function sc_load_text_domain() {
      load_plugin_textdomain( 'simple-copy', false, SIMPLECOPYRIGHT__LANGUAGE_DIR );
   }

   /**
    * Enqueue admin styles and scripts
    *
    * @since 1.0.0
    */
   public static function sc_enqueue_admin()
   {
      wp_enqueue_style( 'sc-admin-style',  plugins_url( 'assets/css/admin/style.css', __FILE__ ) );
      wp_enqueue_script( 'sc-admin-script', plugins_url( 'assets/js/admin/script.js', __FILE__ ), array( 'jquery' ), 1.0, true );
   }

   /**
    * Enqueue front styles and scripts
    *
    * @since 1.0.0
    */
   public static function sc_enqueue_front()
   {
      wp_enqueue_style( 'sc-front-style',  plugins_url( 'assets/css/admin/style.css', __FILE__ ) );
      wp_enqueue_script( 'sc-front-script', plugins_url( 'assets/js/admin/script.js', __FILE__ ), array( 'jquery' ), 1.0, true);
   }

}
   
endif;
   