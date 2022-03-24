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

$page_title = 'Delete Location: ' . h($location->full_name());
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {

  // Delete location
  $result = $location->delete();
  $session->message('The location was deleted successfully.', 'success');
  redirect_to(url_for('/app/shared/locations/locations.php'));

} else {
  // Display form
}

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['location'];
  $location->merge_attributes($args);
  $result = $location->save();

  if($result === true) {
    $session->message('The location was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/locations/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Delete Location</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= $location->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Delete Location</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Location Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Location ID: <?= $location->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>">View Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Edit Location</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Delete Location</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/locations/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Profile Information</legend>
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
