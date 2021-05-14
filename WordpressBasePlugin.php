<?php
/**
 * @package WordpressBasePlugin
 */
/*
Plugin Name: Wordpress Base Plugin
Plugin URI: https://appdetails.net
Description: Plugin For Use https://appdetails.net
Version: 1.0.0
Author: Wordpress Siroos
License: GPLv2 Or later
 */
 ///plugin class Start


define( 'WordpressBasePlugin_VERSION', '1.0.0' );

define( 'WordpressBasePlugin_REQUIRED_WP_VERSION', '5.4');

define( 'WordpressBasePlugin', __FILE__ );

define( 'WordpressBasePlugin_BASENAME', plugin_basename(WordpressBasePlugin) );

define( 'WordpressBasePlugin_DIR', untrailingslashit( dirname( WordpressBasePlugin) ) );

require_once WordpressBasePlugin_DIR . '/settings.php';

 class WordpressBasePlugin{
		
		function register(){
			//Custom Admin Menu Add
            add_action('admin_menu', array($this,'add_admin_pages'));

            //Plugin Setting in Plugin List
        //   add_filter( "plugin_action_links_".$this->plugin, array( $this, 'settings_link' ));
		}
				
		function deactivate() {
			// flush rewrite rules
			flush_rewrite_rules();
		}
		function enqueue (){
        //enqueue all our script
			//wp_enqueue_style('mypluginstyle', plugins_url('/assets/style.css', __file__));
			//wp_enqueue_script('mypluginscript', plugins_url('/assets/jquery.js', __file__),'','',true);
		}
		static function activate() {
			// flush rewrite rules
			flush_rewrite_rules();
			require_once plugin_dir_path( __FILE__ ) . 'inc/Wordpress-Base-activate.php';
			Wordpress_baseActivate::activate();
		}
		
		//Plugin Setting Link
        public function settings_link( $links ) {
            $settings_link = '<a href="admin.php?Wordpress_base_Setting">Settings</a>';
            array_push( $links, $settings_link );
            return $links;
        }
		public function add_admin_pages(){
            add_menu_page('Base_Plugin', 'Base_Plugin_Menu', 'moderate_comments', 'Wordpress_base_Setting', array($this,'admin_index'), 'dashicons-carrot', null);
            add_submenu_page('Wordpress_base_Setting', 'Base_Plugin_Setting', 'system Configuration', 'moderate_comments', 'api_configuration', array($this,'Wordpress_base_Setting_configuration'));        
        }
		public function admin_index(){
            //requered template
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }
		public function Wordpress_base_Setting_configuration(){
            //requered template
            require_once plugin_dir_path( __FILE__ ) . 'templates/api_configuration.php';
            if(isset($_POST['submit-mp'])){
                echo "..............................Test .............................";
            }
        }
 }
///plugin Class End


//Create Instance And Register Start 
$WordpressBasePlugin = new WordpressBasePlugin();
$WordpressBasePlugin->register();
register_activation_hook(__file__, array($WordpressBasePlugin,'activate') );
register_deactivation_hook( __FILE__, array( 'WordpressBasePlugin', 'deactivate' ) );
//Create Instance And Register End
