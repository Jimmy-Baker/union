<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No gym was identified.', 'warning');
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}
$id = $_GET['id'];
$gym = Gym::find_by_id($id);
if($gym == false) {
  $session->message('No gym was identified.', 'warning');
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}

$locations = Location::find_all_by_param('gym_id', $gym->id);

$page_title = 'Gym: ' . h($gym->gym_name);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">Gyms</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?= h($gym->gym_name) ?></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
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
          <img src="<?= h($gym->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2 avatar" alt="<?= h($gym->gym_name) ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Website</dt>
              <dd class="col-sm-8"><?= d($gym->website); ?></dd>
              <dt class="col-sm-4 text-sm-end">Locations</dt>
              <dd class="col-sm-8"><?= d(count($locations)); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Locations</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of this gym's locations</caption>
          <?php include_once('../locations/table_contents.php'); ?>
        </table>
      </div>
    </div>
  </div>

  <div class="row justify-content-evenly" role="toolbar" aria-label="Gym toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/gyms/edit.php?id='. u($gym->id)); ?>">Edit This Gym</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/gyms/delete.php?id='. u($gym->id)); ?>">Delete This Gym</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>