<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
$id = $_GET['id'];
$pass = Pass::find_by_id($id);
if($pass == false) {
  redirect_to(url_for('/app/shared/passes/passes.php'));
}

$page_title = 'Pass: ' . h($pass->id);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Pass Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/passes/passes.php'); ?>">Passes</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $pass->id ?></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="passMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Pass Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="passMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/passes.php'); ?>">All Passes</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/new.php'); ?>">New Pass</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/search.php'); ?>">Find Passes</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Pass ID: <?= $pass->id ?></h4>
          </li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>">View Pass</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/edit.php?id=' . $pass->id); ?>">Edit Pass</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/edit.php?id=' . $pass->id); ?>">Delete Pass</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4"><?= h($pass->pass_type()); ?></div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($pass->id); ?><span class="card-subtitle text-muted"> (#<?= h($pass->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="<?= h($pass->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $pass->preferred_name ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">First Name</dt>
              <dd class="col-sm-8"><?= d($pass->first_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Middle Name</dt>
              <dd class="col-sm-8"><?= d($pass->middle_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Last Name</dt>
              <dd class="col-sm-8"><?= d($pass->last_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Preferred Name</dt>
              <dd class="col-sm-8"><?= d($pass->preferred_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Birth Date</dt>
              <dd class="col-sm-8"><?= d(format_date($pass->birth_date, "-")); ?></dd>
              <dt class="col-sm-4 text-sm-end">Group ID</dt>
              <dd class="col-sm-8"><?= d($pass->group_id); ?></dd>
              <dt class="col-sm-4 text-sm-end">Address</dt>
              <dd class="col-sm-8"><?= d(format_address($pass->street_address, $pass->city, $pass->state_abv, $pass->zip, $pass->country_abv)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Email</dt>
              <dd class="col-sm-8"><?= d($pass->email); ?></dd>
              <dt class="col-sm-4 text-sm-end">Primary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($pass->phone_p_country, $pass->phone_primary)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Secondary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($pass->phone_s_country, $pass->phone_secondary)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Emergency Contact</dt>
              <dd class="col-sm-8"><?= d($pass->first_name_emergency) . ' ' . d($pass->last_name_emergency); ?></dd>
              <dt class="col-sm-4 text-sm-end">Emergency Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($pass->phone_e_country, $pass->phone_emergency)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Created On</dt>
              <dd class="col-sm-8"><?= d($pass->created_at); ?></dd>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Pass toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/passes/edit.php?id='. h(u($pass->id))); ?>">Edit This Pass</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/passes/delete.php?id='. h(u($pass->id))); ?>">Delete This Pass</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
