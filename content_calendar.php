<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://content_calendar.com
 * @since             1.0.0
 * @package           Content_calendar
 *
 * @wordpress-plugin
 * Plugin Name:       Content Calendar
 * Plugin URI:        https://content_calendar
 * Description:       It is a plugin that allows the admin to create a content calendar for content publishing 

 * Version:           1.0.0
 * Author:            Rohan Ray
 * Author URI:        https://content_calendar.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       content_calendar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CONTENT_CALENDAR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-content_calendar-activator.php
 */
function activate_content_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-content_calendar-activator.php';
	Content_calendar_Activator::activate();
	Content_calendar_Activator::cont_c_create_table();//database creation

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-content_calendar-deactivator.php
 */
function deactivate_content_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-content_calendar-deactivator.php';
	Content_calendar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_content_calendar' );
register_deactivation_hook( __FILE__, 'deactivate_content_calendar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-content_calendar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 * 
 */

//css
require plugin_dir_path(__FILE__) . 'content_css.php';

 //form submission
require plugin_dir_path(__FILE__).'form_handling.php';


require plugin_dir_path(__FILE__) . 'admin/partials/content_calendar-admin-display.php';






function run_content_calendar() {

	$plugin = new Content_calendar();
	$plugin->run();

}
run_content_calendar();
