<?php

function cont_c_handle_form()
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

add_action('init','cont_c_submission_handle');

function cont_c_submission_handle()
{
   if(isset($_POST['submit'])){
       cont_c_handle_form();
   }
}