<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'New Pass';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $pass = new Pass($args);
  $result = $pass->save();

  if($result === true) {
    $new_id = $pass->id;
    $session->message('The pass was created successfully.', 'success');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $new_id));
  } else {
    $session->message('Pass creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $pass = new Pass;
}
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>New User Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">New User</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($user->error_array); ?>
  <form action="<?= url_for('/app/shared/users/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create User</button>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>