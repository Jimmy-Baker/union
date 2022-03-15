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

$page_title = 'User: ' . h($user->full_name());
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>User Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $user->full_name() ?></li>
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
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>">View User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Edit User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Delete User</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4"><?= h($user->user_type()); ?></div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($user->full_name()); ?><span class="card-subtitle text-muted"> (#<?= h($user->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="<?= h($user->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $user->preferred_name ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">First Name</dt>
              <dd class="col-sm-8"><?= d($user->first_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Middle Name</dt>
              <dd class="col-sm-8"><?= d($user->middle_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Last Name</dt>
              <dd class="col-sm-8"><?= d($user->last_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Preferred Name</dt>
              <dd class="col-sm-8"><?= d($user->preferred_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Birth Date</dt>
              <dd class="col-sm-8"><?= d(format_date($user->birth_date, "-")); ?></dd>
              <dt class="col-sm-4 text-sm-end">Group ID</dt>
              <dd class="col-sm-8"><?= d($user->group_id); ?></dd>
              <dt class="col-sm-4 text-sm-end">Address</dt>
              <dd class="col-sm-8"><?= d(format_address($user->street_address, $user->city, $user->state_abv, $user->zip, $user->country_abv)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Email</dt>
              <dd class="col-sm-8"><?= d($user->email); ?></dd>
              <dt class="col-sm-4 text-sm-end">Primary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($user->phone_p_country, $user->phone_primary)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Secondary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($user->phone_s_country, $user->phone_secondary)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Emergency Contact</dt>
              <dd class="col-sm-8"><?= d($user->first_name_emergency) . ' ' . d($user->last_name_emergency); ?></dd>
              <dt class="col-sm-4 text-sm-end">Emergency Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($user->phone_e_country, $user->phone_emergency)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Created On</dt>
              <dd class="col-sm-8"><?= d($user->created_at); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/users/edit.php?id='. h(u($user->id))); ?>">Edit This User</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/users/delete.php?id='. h(u($user->id))); ?>">Delete This User</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>