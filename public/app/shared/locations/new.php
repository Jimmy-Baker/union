<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['location'];
  $location = new Location($args);
  $result = $location->save();

  if($result === true) {
    $new_id = $location->id;
    $session->message('The location was created successfully.', 'success');
    redirect_to(url_for('/app/shared/locations/view.php?id=' . u($new_id)));
  } else {
    $session->message('Location creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $location = new Location;
}

$page_title = 'New Location';
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
          <li class="breadcrumb-item active text-primary" aria-current="page">New Location</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
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