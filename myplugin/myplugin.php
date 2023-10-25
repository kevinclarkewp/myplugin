<?php
/*
Plugin Name:  MyPlugin
Description:  Example plugin for the video tutorial series, "WordPress: Plugin Development", available at LinkedIn Learning.
Plugin URI:   https://profiles.wordpress.org/specialk
Author:       Kevin Clarke
Version:      1.0
Text Domain:  myplugin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

// exit if file is called directly from outside WordPress
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

// if admin area
if(is_admin()) {

  // include dependencies
  require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';

}

// include dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';

// default plugin options
function myplugin_options_default() {

	return array(
		'custom_url'     => 'https://wordpress.org/',
		'custom_title'   => esc_html__( 'Powered by WordPress', 'myplugin' ),
		'custom_style'   => 'disable',
		'custom_message' => '<p class="custom-message">' . esc_html__( 'My custom message', 'myplugin' ) . '</p>',
		'custom_footer'  => esc_html__( 'Special message for users', 'myplugin' ),
		'custom_toolbar' => false,
		'custom_scheme'  => 'default',
	);

}


// load text domain
function myplugin_load_textdomain() {

	load_plugin_textdomain( 'myplugin', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );


// remove options on uninstall
function myplugin_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_option( 'myplugin_options' );

}
register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );



?>
