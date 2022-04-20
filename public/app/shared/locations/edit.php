<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No location was identified.', 'warning');
  redirect_to(url_for('/app/shared/locations/locations.php'));
}
$id = $_GET['id'];
$location = Location::find_by_id($id);
$gym = Gym::find_by_id($location->gym_id);
if($location == false) {
  $session->message('No location was identified.', 'warning');
  redirect_to(url_for('/app/shared/locations/locations.php'));
}

$page_title = 'Edit Location: ' . h($gym->gym_name) . ' ' . h($location->location_name);
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
  <div class="p-5 bg-primary text-light">
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
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= h($gym->gym_name) . ' ' . h($location->location_name); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Location</li>
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