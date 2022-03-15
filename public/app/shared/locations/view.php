<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/locations/locations.php'));
}
$id = $_GET['id'];
$location = Location::find_by_id($id);
if($location == false) {
  redirect_to(url_for('/app/shared/locations/locations.php'));
}

$page_title = 'Location: ' . h($location->full_name());
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Location Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $location->full_name() ?></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Location Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Location ID: <?= $location->id ?></h4>
          </li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>">View Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Edit Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Delete Location</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4"><?= h($location->location_type()); ?></div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($location->full_name()); ?><span class="card-subtitle text-muted"> (#<?= h($location->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="<?= h($location->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $location->preferred_name ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Gym Name</dt>
              <dd class="col-sm-8"><?= d($location->gym_name()); ?></dd>
              <dt class="col-sm-4 text-sm-end">Location Name</dt>
              <dd class="col-sm-8"><?= d($location->location_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Address</dt>
              <dd class="col-sm-8"><?= d(format_address($location->street_address, $location->city, $location->state_abv, $location->zip, $location->country_abv)); ?></dd>

              <dt class="col-sm-4 text-sm-end">Primary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($location->phone_p_country, $location->phone_primary)); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/edit.php?id='. h(u($location->id))); ?>">Edit This Location</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/locations/delete.php?id='. h(u($location->id))); ?>">Delete This Location</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>