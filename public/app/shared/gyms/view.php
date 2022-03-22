<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}
$id = $_GET['id'];
$gym = Gym::find_by_id($id);
if($gym == false) {
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}

$page_title = 'Gym: ' . h($gym->gym_name);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Gym Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/gyms/gyms.php'); ?>">Gyms</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $gym->gym_name ?></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="gymMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Gym Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="gymMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">All Gyms</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/new.php'); ?>">New Gym</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Gym ID: <?= $gym->id ?></h4>
          </li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>">View Gym</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/edit.php?id=' . $gym->id); ?>">Edit Gym</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/edit.php?id=' . $gym->id); ?>">Delete Gym</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Partner Gym</div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($gym->gym_name); ?><span class="card-subtitle text-muted"> (#<?= h($gym->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="<?= h($gym->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $gym->preferred_name ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Website</dt>
              <dd class="col-sm-8"><?= d($gym->website); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Gym toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/gyms/edit.php?id='. h(u($gym->id))); ?>">Edit This Gym</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/gyms/delete.php?id='. h(u($gym->id))); ?>">Delete This Gym</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
