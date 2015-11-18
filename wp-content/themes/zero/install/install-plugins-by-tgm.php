<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/install/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' => 'Zero Theme Core Plugin',
			'slug' => 'zero-core',
			'source' => get_template_directory() . '/install/zips/zero-core.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh Custom Code',
			'slug' => 'fresh-custom-code',
			'source' => dirname(__FILE__).'/zips/fresh-custom-code.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh Custom Loops',
			'slug' => 'fresh-custom-loops',
			'source' => dirname(__FILE__).'/zips/fresh-custom-loops.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh File Editor',
			'slug' => 'fresh-file-editor',
			'source' => dirname(__FILE__).'/zips/fresh-file-editor.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh Performance Cache',
			'slug' => 'fresh-performance-cache',
			'source' => dirname(__FILE__).'/zips/fresh-performance-cache.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh Scrollbar',
			'slug' => 'fresh-scrollbar',
			'source' => dirname(__FILE__).'/zips/fresh-scrollbar.zip',
			'required' => false,
		),
		array(
			'name' => 'Fresh Sidebar Manager',
			'slug' => 'fresh-sidebar-manager',
			'source' => dirname(__FILE__).'/zips/fresh-sidebar-manager.zip',
			'required' => false,
		),

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}