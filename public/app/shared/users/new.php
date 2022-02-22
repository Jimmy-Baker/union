<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message('The user was created successfully.');
    redirect_to(url_for('/staff/users/show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $user = new User;
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/user-header.php'); ?>

<div id="main">

  <a class="back-link" href="<?= url_for('/staff/users/users.php'); ?>">&laquo; Back to List</a>

  <div class="user">
    <div class="row">
      <div class="six columns offset-by-three">
        <h1>Create User</h1>
      </div>
    </div>
    <div class="row">
      <div class="six columns offset-by-three">
        <?= display_errors($user->error_array); ?>
      </div>
    </div>

    <form action="<?= url_for('/staff/users/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations" class="row">
        <div class="six columns offset-by-three">
          <button class="button-primary" type="submit">Create User</button>
        </div>  
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
