<?php
/* This function is creating the form that will be displayed on the frontend. */
function category_email()
{
  /* Starting a buffer. */
  ob_start();

  //get category email
  $categories = get_the_category();
  $category_id = 0;
  $category_name = '';
  if (!empty($categories)) {
    $category_id = (int) ($categories[0]->term_id);
    $category_name = ($categories[0]->name);
  }
  $category_email_address = get_term_meta($category_id, 'category_meta_field', true);
  
  /* This is checking if the form has been submitted. If it has, it will sanitize the form data. */
  if (isset($_POST['submitMsg'])) {
    $name = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['useremail']);
    $message = sanitize_text_field($_POST['usermsg']);
    $cat_name = ($_POST['cat_name']);
    $cat_email = ($_POST['cat_email']);

    //send email to above email address
    wp_mail($cat_email, 'Message for - ' . $cat_name, "Name= $name  E-mail=$email Message= $message ");
  }
  ?>

  <form method="POST" action="">
    <input type="hidden" id="cat_name" name="cat_name" value="<?php echo $category_name ?>">
    <input type="hidden" id="cat_email" name="cat_email" value="<?php echo $category_email_address ?>">
    <div>
      <label for="username">Name:</label>
      <input type="text" name="username" id="username" required>
    </div>
    <div>
      <label for="useremail">Email:</label>
      <input type="email" name="useremail" id="useremail" required>
    </div>
    <div>
      <label for="usermsg">Message:</label>
      <textarea name="usermsg" id="usermsg" required></textarea>
    </div>
    <input type="submit" name="submitMsg" value="submit">
  </form>
  <?php

  
 /* Returning the buffer. */
  return ob_get_clean();
}


/* This is adding a filter to the content. This means that the function add_contact_form will be run on
the content. */
add_filter('the_content', 'add_contact_form');
function add_contact_form($content)
{
  return $content . category_email();
}
