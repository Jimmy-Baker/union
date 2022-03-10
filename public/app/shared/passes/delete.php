<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/users/users.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
  redirect_to(url_for('/app/shared/users/users.php'));
}

$page_title = 'Delete User: ' . h($user->full_name());
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {

  // Delete user
  $result = $user->delete();
  $session->message('The user was deleted successfully.');
  redirect_to(url_for('/app/shared/users/users.php'));

} else {
  // Display form
}

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['user'];
  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $session->message('The user was updated successfully.');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <h1>Delete User</h1>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>"><?= $user->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Delete User</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          User Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="userMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/search.php'); ?>">Find Users</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">User ID: <?= $user->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>">View User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Edit User</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Delete User</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/users/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card col-md-10 mx-auto mb-4">
      <legend class="card-header">Profile Information</legend>
      <div class="card-body">
        <div class="card-text">
          <dl class="row">
            <dt class="col-sm-3">First Name</dt>
            <dd class="col-sm-9"><?= h($user->first_name); ?></dd>
            <dt class="col-sm-3">Middle Name</dt>
            <dd class="col-sm-9"><?= h($user->middle_name); ?></dd>
            <dt class="col-sm-3">Last Name</dt>
            <dd class="col-sm-9"><?= h($user->last_name); ?></dd>
            <dt class="col-sm-3">Preferred Name</dt>
            <dd class="col-sm-9"><?= h($user->preferred_name); ?></dd>
            <dt class="col-sm-3">Birth Date</dt>
            <dd class="col-sm-9"><?= h(format_date($user->birth_date, "-")); ?></dd>
            <dt class="col-sm-3">Group ID</dt>
            <dd class="col-sm-9"><?= h($user->group_id); ?></dd>
            <dt class="col-sm-3">Address</dt>
            <dd class="col-sm-9"><?= h(format_address($user->street_address, $user->city, $user->state_abv, $user->zip, $user->country_abv)); ?></dd>
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><?= h($user->email); ?></dd>
            <dt class="col-sm-3">Primary Phone</dt>
            <dd class="col-sm-9"><?= h(format_phone($user->phone_p_country, $user->phone_primary)); ?></dd>
        </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn btn-outline-primary" href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
