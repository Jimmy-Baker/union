<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Delete Location: ' . h($location->gym_name) . ' ' . h($location->location_name);
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

if(is_post_request()) {
  // Delete location
  $result = $location->delete();
  if($result === true) {
    $session->message('The location was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/locations/locations.php'));
  } else {
    $session->message('The location deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
}

include(SHARED_PATH . '/user-header.php');
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Delete Location</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= h($location->gym_name) . ' ' . h($location->location_name); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Delete Location</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/locations/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Location Information</legend>
      <div class="card-body">
        <div class="card-text">
          <dl class="row">
            <dt class="col-sm-3">Location ID</dt>
            <dd class="col-sm-9"><?= h($location->id); ?></dd>
            <dt class="col-sm-3">Gym ID</dt>
            <dd class="col-sm-9"><?= h($location->gym_id); ?></dd>
            <dt class="col-sm-3">Location Name</dt>
            <dd class="col-sm-9"><?= h($location->location_name); ?></dd>
            <dt class="col-sm-3">Address</dt>
            <dd class="col-sm-9"><?= h(format_address($location->street_address, $location->city, $location->state_abv, $location->zip, $location->country_abv)); ?></dd>
            <dt class="col-sm-3">Primary Phone</dt>
            <dd class="col-sm-9"><?= h(format_phone($location->phone_p_country, $location->phone_primary)); ?></dd>
          </dl>
        </div>
      </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
