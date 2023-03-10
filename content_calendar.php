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

//adding menu pages

function cont_c_menu_page()
{
	add_menu_page(__('Content Calendar','content_calendar'), 'Content Calendar','manage_options', 'content_calendar', 'content_calendar_callback', 'dashicons-callback-alt', 6);
	add_submenu_page('content_calendar', __('Schedule Content','content_calendar'), __('Schedule Content','content_calendar'), 'manage_options', 'schedule_content', 'schedule_cont_callback');
	add_submenu_page('content_calendar', __('View Schedule','content_calendar'), __('View Schedule','content_calendar'), 'manage_options', 'view_schedule', 'view_schedule_callback');

}

add_action('admin_menu', 'cont_c_menu_page');


function content_calendar_callback()
{
 ?>
 <h1><?php esc_html_e(get_admin_page_title());?></h1>
 <?php
	schedule_cont_callback();
	view_schedule_callback();
}


function schedule_cont_callback()
{
  ?>
  <h1 class="cont_title">Schedule</h1>
  <div class="wrap">

   <form action="options.php" method="post">

   <input type="hidden" name="action" value="cont_form">

   <label for="date">Date:</label>
   <input type="date" name="date" id="date" value="<?php echo esc_attr(get_option('date'));?>" require/> <br />

   <label for="occasion">Occasion:</label>
   <input type="text" name="ocasion" id="ocasion" value="<?php echo esc_attr(get_option('occasion'));?>" require/> <br />
   

   <label for="post_title">Post Title:</label>
   <input type="text" name="post_title" id="post_title" value="<?php echo esc_attr(get_option('post_title'));?>" require/> <br />
   

   <label for="author">Author:</label>
   <select name="author" id="author" require>
	<?php $users=get_users(array(
		'fields' => array('ID','display_name')
	));

	foreach($users as $user)
	{
		echo'<option value="'.$user->ID.'">' . $user->display_name . '</option>';
	}
	?>
	
   </select><br />

   <label for="reviewer">Reviewer:</label>
   <select name="reviewer" id="reviewer" require>
	<?php
	$admin= get_users(array('role' =>'administrator',
	'fields' => array('ID','display_name')));

	foreach($admins as $admin)
	{
		echo '<option value="'.$admin->ID.'">' . $admin->display_name . '</option>';
	}
	?>
   </select><br />

   <?php submit_button('Schedule Post');?>


   </form>

  </div>
  <?php
}

function view_schedule_callback()
{

}



function run_content_calendar() {

	$plugin = new Content_calendar();
	$plugin->run();

}
run_content_calendar();
