<?php
/* FUNCTIONALITY COMING SOON */

if ( ! defined( 'APPIP_PLUGIN_URL' ) ) {
	define( 'APPIP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'APPIP_PLUGIN_DIR' ) ) {
	define( 'APPIP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

function appip_register_block_editor_assets() {
  $dependencies = array(
    'wp-blocks',    // Provides useful functions and components for extending the editor
    'wp-i18n',      // Provides localization functions
    'wp-element',   // Provides React.Component
    'wp-components' // Provides many prebuilt components and controls
  );	
}
add_action( 'admin_init', 'appip_register_block_editor_assets' );

function appip_register_block_assets() {
  wp_register_script( 'appip-block', plugins_url( 'inc/blocks/block.js', __FILE__ ), array( 'jquery' ), filemtime( APPIP_PLUGIN_DIR . 'inc/blocks/block.js' ));
  wp_register_style( 'appip-block', plugins_url( 'inc/blocks/css/style.css', __FILE__ ), null, filemtime( APPIP_PLUGIN_DIR . 'inc/blocks/css/style.css' ));
register_block_type('amazon-product-in-a-post-plugin/amazon-grid', array(
  'editor_script' => 'appip-block-editor',
  'editor_style'  => 'appip-block-editor',
  'script'        => 'appip-block',
  'style'         => 'appip-block'
));
}
add_action( 'init', 'appip_register_block_assets' );

/**
 * Define constants
 **/

/**
 * Enqueue the block's assets for the editor.
 *
 * `wp-blocks`: Includes block type registration and related functions.
 * `wp-element`: Includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function appip_block_enqueue_block_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'appip-block', // Handle.
		APPIP_PLUGIN_URL . 'inc/blocks/block.js', // File.
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ), // Dependencies.
		filemtime( APPIP_PLUGIN_DIR . 'inc/blocks/block.js' ) // filemtime — Gets file modification time.
	);

	// Styles.
	wp_enqueue_style(
		'appip-block-editor', // Handle.
		APPIP_PLUGIN_URL . 'inc/blocks/css/editor.css', // File.
		array( 'wp-edit-blocks' ), // Dependency.
		filemtime( APPIP_PLUGIN_DIR . 'inc/blocks/css/editor.css' ) // filemtime — Gets file modification time.
	);
}
//add_action( 'enqueue_block_editor_assets', 'appip_block_enqueue_block_editor_assets' );
