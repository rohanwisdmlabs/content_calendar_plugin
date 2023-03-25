<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://content_calendar.com
 * @since      1.0.0
 *
 * @package    Content_calendar
 * @subpackage Content_calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Content_calendar
 * @subpackage Content_calendar/admin
 * @author     Rohan Ray <rohan.ray@wisdmlabs.com>
 */
class Content_calendar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/content_calendar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/content_calendar-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function cont_c_menu_page()
{
	add_menu_page(__('Content Calendar','content_calendar'), 'Content Calendar','manage_options', 'content_calendar', 'content_calendar_callback', 'dashicons-calendar', 6);
	add_submenu_page('content_calendar', __('Schedule Content','content_calendar'), __('Schedule Content','content_calendar'), 'manage_options', 'schedule_content', 'schedule_cont_callback');
	add_submenu_page('content_calendar', __('View Schedule','content_calendar'), __('View Schedule','content_calendar'), 'manage_options', 'view_schedule', 'view_schedule_callback');

}

public function cont_c_handle_form()
 {
	global $wpdb;

	if (isset($_POST['date']) && isset($_POST['occasion']) && isset($_POST['post_title']) && isset($_POST['author']) && isset($_POST['reviewer'])) {
		$table_name = $wpdb->prefix . 'cont_c_data';
		$date = sanitize_text_field($_POST['date']);
		$occasion = sanitize_text_field($_POST['occasion']);
		$post_title = sanitize_text_field($_POST['post_title']);
		$author = sanitize_text_field($_POST['author']);
		$reviewer = sanitize_text_field($_POST['reviewer']);
		$wpdb->insert(
			$table_name,
			array(
				'date' => $date,
				'occasion' => $occasion,
				'post_title' => $post_title,
				'author' => $author,
				'reviewer' => $reviewer
			)
		);
	}
 }


//  public function cont_c_submission_handle()
//  {
// 	if(isset($_POST['submit'])){
// 		cont_c_handle_form();
// 	}
//  }



}
