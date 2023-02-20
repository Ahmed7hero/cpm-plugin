
<?php
// Add custom meta field to category edit form
function add_category_meta_field()
{
  echo
    '<div class="form-field">
      <label for="category_meta_field"><?php _e( ' . 'E-mail' . ', ' . 'twentytwentyone' . ' ); ?></label>
      <input type="text" name="category_meta_field" id="category_meta_field">
  </div>';
}
add_action('category_add_form_fields', 'add_category_meta_field');

// Add custom meta field to category edit form
function edit_category_meta_field()
{
  // Get term meta for a specific term ID and meta key  
  $queried_category = get_term(get_query_var('cat'), 'category');
  
 /* This is getting the category ID from the URL. */
  $idObj = $_REQUEST['tag_ID'];
  $term_meta_value = get_term_meta($idObj, 'category_meta_field', true);

  echo
    '<div class="form-field">
        <label for="category_meta_field"><?php _e( ' . 'E-mail' . ', ' . 'twentytwentyone' . ' ); ?></label>
        <input type="text" name="category_meta_field" id="category_meta_field" value="' . $term_meta_value . '">
    </div>';
}
add_action('category_edit_form_fields', 'edit_category_meta_field');
