<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No location was identified.', 'warning');
  redirect_to(url_for('/app/shared/locations/locations.php'));
}
$id = $_GET['id'];
$location = Location::find_expanded_by_id($id);
if($location == false) {
  $session->message('No location was identified.', 'warning');
  redirect_to(url_for('/app/shared/locations/locations.php'));
}

if(!test_access('MM') && ($session->location!=$id)) {
  $session->message('You do not have permission to view this location.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

$page_title = 'Location: ' . h($location->gym_name) . ' ' . h($location->location_name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?=  h($location->gym_name) . ' ' . h($location->location_name) ?></li>
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
    <div class="card-header fs-4"><?=  h($location->gym_name) . ' ' . h($location->location_name) ?></div>
    <div class="card-body">
      <div class="row mt-4">
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Gym Name</dt>
              <dd class="col-sm-8"><?= d($location->gym_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Location Name</dt>
              <dd class="col-sm-8"><?= d($location->location_name); ?></dd>
              <dt class="col-sm-4 text-sm-end">Address</dt>
              <dd class="col-sm-8"><?= d(format_address($location->street_address, $location->city, $location->state_abv, $location->zip, $location->country_abv)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Primary Phone</dt>
              <dd class="col-sm-8"><?= d(format_phone($location->phone_p_country, $location->phone_primary)); ?></dd>
              <dt class="col-sm-4 text-sm-end">Gym Website</dt>
              <dd class="col-sm-8"><a href="<?= h($location->website) ?>"><?= h($location->website); ?></a></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if(test_access('AA') || Permission::test_location_user_permission($id, $session->user_id, 'XI')){ ?>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/edit.php?id='. u($location->id)); ?>">Edit This Location</a>
    </div>
    <?php if(test_access('AA')) { ?>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/locations/delete.php?id='. u($location->id)); ?>">Delete This Location</a>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>