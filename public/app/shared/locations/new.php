<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'New Location';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['location'];
  $location = new Location($args);
  $result = $location->save();

  if($result === true) {
    $new_id = $location->id;
    $session->message('The location was created successfully.', 'success');
    redirect_to(url_for('/app/shared/locations/view.php?id=' . $new_id));
  } else {

  }
} else {
  $location = new Location;
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>New Location Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item active" aria-current="page">New Location</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Location Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($location->error_array); ?>
  <form action="<?= url_for('/app/shared/locations/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create Location</button>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
