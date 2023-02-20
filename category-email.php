<?php
/**
 * Plugin Name: Category Email
 * Description: Adds a contact form to the end of each post.
 * Version: 1.0.0
 * Author: Muhammed Dilshad
 */

require_once  __DIR__ .'/frontend/ce-contactform.php';
require_once  __DIR__ .'/admin/ce-addformfield.php';


// Save custom meta field value
function save_category_meta_field($term_id)
{
  if (isset($_POST['category_meta_field'])) {
    update_term_meta($term_id, 'category_meta_field', sanitize_text_field($_POST['category_meta_field']));
  }
}
add_action('edited_category', 'save_category_meta_field');
add_action('create_category', 'save_category_meta_field');