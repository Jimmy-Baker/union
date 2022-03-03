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
    <h1>User Information</h1>
  </div>
  <div class="container-md p-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $user->full_name() ?></li>
      </ol>
    </nav>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="card">
    <div class="card-header"><?= h($user->user_type()); ?></div>
    <div class="card-body">
      <h1 class="card-title"><?= h($user->full_name()); ?></h1>
      <h2 class="card-subtitle text-muted"><?= h($user->id); ?></h2>
      <div class="row">
        <div class="col-md-2 order-md-last offset-md-1">
          <img src="..." class="img-fluid border border-primary rounded-circle" alt="...">
        </div>
        <div class="col-md-8 order-md-first">
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
              <dd class="col-sm-9"><?= h(format_date($user->birth_date)); ?></dd>
              <dt class="col-sm-3">Group ID</dt>
              <dd class="col-sm-9"><?= h($user->group_id); ?></dd>
              <dt class="col-sm-3">Address</dt>
              <dd class="col-sm-9"><?= h(format_address($user->street_address, $user->city, $user->state_abv, $user->zip, $user->country_abv)); ?></dd>
              <dt class="col-sm-3">Email</dt>
              <dd class="col-sm-9"><?= h($user->email); ?></dd>
              <dt class="col-sm-3">Primary Phone</dt>
              <dd class="col-sm-9"><?= h(format_phone($user->phone_p_country, $user->phone_primary)); ?></dd>
              <dt class="col-sm-3">Secondary Phone</dt>
              <dd class="col-sm-9"><?= h(format_phone($user->phone_s_country, $user->phone_secondary)); ?></dd>
              <dt class="col-sm-3">Emergency Contact</dt>
              <dd class="col-sm-9"><?= h($user->first_name_emergency) . ' ' . h($user->last_name_emergency); ?></dd>
              <dt class="col-sm-3">Emergency Phone</dt>
              <dd class="col-sm-9"><?= h(format_phone($user->phone_e_country, $user->phone_emergency)); ?></dd>
              <dt class="col-sm-3">Created On</dt>
              <dd class="col-sm-9"><?= h($user->created_at); ?></dd>
          </div>
          <a href="#" class="btn btn-primary">Do something</a>
        </div>

      </div>
    </div>
  </div>
</main>

<!-- <div class="attributes">
      <dl class="row">
        <dt class="two columns">First name</dt>
        <dd class="three columns"><?= h($user->first_name); ?></dd>
      </dl>
      <dl class="row">
        <dt class="two columns">Last name</dt>
        <dd class="three columns"><?= h($user->last_name); ?></dd>
      </dl>
      <dl class="row">
        <dt class="two columns">Email</dt>
        <dd class="three columns"><?= h($user->email); ?></dd>
      </dl>
      <dl class="row">
        <dt class="two columns">Username</dt>
        <dd class="three columns"><?= h($user->username); ?></dd>
      </dl>
      <dl class="row">
        <dt class="two columns">User Level</dt>
        <dd class="three columns"><?= h($user->user_level); ?></dd>
      </dl>
    </div> -->