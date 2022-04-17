<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'New Pass';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $pass = new Pass($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message('The user was created successfully.', 'success');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $new_id));
  } else {

  }
} else {
  $user = new User;
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
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          User Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="userMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/search.php'); ?>">Find Users</a></li>
        </ul>
      </div>
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
