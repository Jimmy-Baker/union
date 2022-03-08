<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'New User';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message('The user was created successfully.');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $new_id));
  } else {

  }
} else {
  $user = new User;
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <h1>New User Information</h1>
  </div>
  <div class="container-md p-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">New User</li>
      </ol>
    </nav>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($user->error_array); ?>
  <form action="<?= url_for('/app/shared/users/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn btn-primary">Create User</button>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>