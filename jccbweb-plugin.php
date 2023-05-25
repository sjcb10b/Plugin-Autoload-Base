<?php
/** * Plugin Name: JCCB Web Plugin
 * Plugin URI: https://jccbweb.com/
 * Description: Custom plugin name JCCB Web Plugin
 * Version: 0.1
 * Author: JCC
 * Author URI: https://jccbweb.com/
 **/


//2nd option
defined('ABSPATH')OR die('you cannot access the file');

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
// name space
use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Admin\AdminPages;


if (! class_exists('JccbPlugin')) {
    class JccbPlugin
    {
        // public variable
        public $plugin;
        function __construct()
        {     // find the directory plugin name
              // use in the variable plugin
              $this->plugin = plugin_basename(__FILE__);

        }

        // function to register
        function register()
        {  // calling in action the scripts in the method enqueue
           add_action('admin_enqueue_scripts', array($this, 'enqueue'));
           // calling add_admin_pages method
            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

        }
        public function add_admin_pages() {
            // calling the admin index method
            add_menu_page( 'JCCB Web Plugin', 'JccbWeb', 'manage_options', 'jccbweb_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );

        }
        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }
        function custom_post_type()
        {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue()
        {
            // registering the css and jquery scripts
            wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));

        }

        function activate()
        {   // static method in the activate class
            Activate::activate();
        }

        function deactivate()
        {
            // Calling static funtion in the Deactivate calss
              Deactivate::deactivate();

        }





    }

    if (class_exists('JccbPlugin')) {
        $jccbplugin = new JccbPlugin(); // initialise the class
        $jccbplugin->register();
    }

// activation Hooks
    register_activation_hook(__FILE__, array($jccbplugin, 'activate'));

// deactivation
    register_deactivation_hook(__FILE__, array($jccbplugin, 'deactivate'));

}// end of the if statement