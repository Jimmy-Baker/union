<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Change Location';

$user_id = $_SESSION['user_id'];
$redirect = url_for('/app/admin/change.php');

/** 
 * Change the user's session location upon request 
 */
if(is_post_request()) {
  $loc_id = $_POST['loc_id'];
  if($loc_id && $user_id){
    $test = Permission::test_location_user_permission($loc_id, $user_id, 'XC');
    if ($test) {
      $location = Location::find_expanded_by_id($loc_id);
      if ($location){
        $session->location = $_SESSION['location'] = $loc_id;
        $session->location_name = $_SESSION['location_name'] = $location->location_name;
        $session->gym_id = $_SESSION['gym_id'] = $location->gym_id;
        $session->gym_name = $_SESSION['gym_name'] = $location->gym_name;
        $session->message("Location successfully changed.", "success");
        redirect_to(url_for( $session->dashboard()));
      } else {
        $session->message("You do not have permission to join that location.", "warning");
        redirect_to($redirect);
      }
    } else {
      $session->message("You do not have permission to join that location.", "warning");
      redirect_to($redirect);
    }
  } else {
    $session->message("Your information could not be retrieved. Please try again.", "warning");
    redirect_to(url_for( $session->dashboard()));
  }
} else {
  $possibles = Permission::find_locations_by_user_permission($user_id, 'XC');
}

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
          <li class="breadcrumb-item active text-primary" aria-current="page">Change Location</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <form action="<?= url_for('/app/admin/change.php'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Location Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputLocation" class="col-form-label">Change To</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0">
              <select class="form-select" aria-label="Select role type." name="loc_id" id="inputLocation" required>
                <option value="" hidden>Select One</option>
                <?php foreach($possibles as $possible) { ?>
                <option value="<?= $possible->location_id ?>"><?= $possible->gym_name . ' - ' . $possible->location_name ?></option>

                <?php } ?>
              </select>
            </div>
          </div>
          <div id="helpLocation" class="form-text offset-md-3">Select One</div>
        </div>
      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Change My Location</button>
      </div>
    </div>
  </form>
</main>
