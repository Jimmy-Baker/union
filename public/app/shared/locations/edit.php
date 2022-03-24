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

$page_title = 'Edit Location: ' . h($location->full_name());
include(SHARED_PATH . '/user-header.php'); 

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
      <h1>Edit Location Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= $location->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Location</li>
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
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Edit Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Delete Location</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($location->error_array); ?>
  <form action="<?= url_for('/app/shared/locations/edit.php?id=' . h(u($id))); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
