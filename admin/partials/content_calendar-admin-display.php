<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://content_calendar.com
 * @since      1.0.0
 *
 * @package    Content_calendar
 * @subpackage Content_calendar/admin/partials
 */


// <!-- This file should primarily consist of HTML with a little bit of PHP. -->

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

   <form method="post">

   <input type="hidden" name="action" value="cont_form">

   <label for="date">Date:</label>
   <input type="date" name="date" id="date" value="<?php echo esc_attr(get_option('date'));?>" required/> <br />

   <label for="occasion">Occasion:</label>
   <input type="text" name="occasion" id="occasion" value="<?php echo esc_attr(get_option('occasion'));?>" required/> <br />
   

   <label for="post_title">Post Title:</label>
   <input type="text" name="post_title" id="post_title" value="<?php echo esc_attr(get_option('post_title'));?>" required/> <br />
   

   <label for="author">Author:</label>
   <select name="author" id="author" required>
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
   <select name="reviewer" id="reviewer" required>
	<?php
	$admins= get_users(array('role' =>'administrator',
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

	?>
	<h1 class="cc-title">Scheduled</h1>

	<?php

	global $wpdb;
	$table_name = $wpdb->prefix . 'cont_c_data';

	$data = $wpdb->get_results("SELECT * FROM $table_name WHERE date >= DATE(NOW()) ORDER BY date");

	echo '<table id="cc-table">';
	echo '<thead><tr><th>ID</th><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
	foreach ($data as $row) {
		echo '<tr>';
		echo '<td>' . $row->id . '</td>';
		echo '<td>' . $row->date . '</td>';
		echo '<td>' . $row->occasion . '</td>';
		echo '<td>' . $row->post_title . '</td>';
		echo '<td>' . get_userdata($row->author)->user_login . '</td>';
		echo '<td>' . get_userdata($row->reviewer)->user_login . '</td>';
		echo '</tr>';
	}
	echo '</table>';


	?>
	<h1 class="cc-title">Deadline Closed Content</h1>

<?php

	global $wpdb;
	$table_name = $wpdb->prefix . 'cont_c_data';

	$data = $wpdb->get_results("SELECT * FROM $table_name WHERE date < DATE(NOW()) ORDER BY date DESC");

	echo '<table id="cc-table">';
	echo '<thead><tr><th>ID</th><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
	foreach ($data as $row) {
		echo '<tr>';
		echo '<td>' . $row->id . '</td>';
		echo '<td>' . $row->date . '</td>';
		echo '<td>' . $row->occasion . '</td>';
		echo '<td>' . $row->post_title . '</td>';
		echo '<td>' . get_userdata($row->author)->user_login . '</td>';
		echo '<td>' . get_userdata($row->reviewer)->user_login . '</td>';
		echo '</tr>';
	}
	echo '</table>';
}

