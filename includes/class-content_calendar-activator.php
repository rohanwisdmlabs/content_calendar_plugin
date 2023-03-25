<?php

/**
 * Fired during plugin activation
 *
 * @link       https://content_calendar.com
 * @since      1.0.0
 *
 * @package    Content_calendar
 * @subpackage Content_calendar/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Content_calendar
 * @subpackage Content_calendar/includes
 * @author     Rohan Ray <rohan.ray@wisdmlabs.com>
 */
class Content_calendar_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	}

	public static function cont_c_create_table()
 {
	global $wpdb;
	$table_name = $wpdb->prefix . 'cont_c_data';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id mediumint(9) AUTO_INCREMENT,
	  date date NOT NULL,
	  occasion varchar(255) NOT NULL,
	  post_title varchar(255) NOT NULL,
	  author int(11) NOT NULL,
	  reviewer varchar(255) NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
 }

}
