<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!test_access('GS')) {
  $session->message('You do not have permission to check users in.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

$location = Location::find_by_id($_SESSION['location']);
$gym = Gym::find_by_id($location->gym_id);

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  //validate location is set
  if($location) {
    // validate location has space
    if($location->available() > 0) {
      // determine user to check in
      if (isset($_POST['inputValue1'])) {
        $user = User::find_expanded_pass_by_param($_POST['inputParameter1'], $_POST['inputValue1']);
        if ($user) {
          // determine if user exists with a pass
          $punch = PassItem::find_by_pass_and_gym($user->pass_id, $gym->id);
          if($punch){
            // check if user has punch remaining
            if($punch->available() > 0) {
              //make sure user isn't already checked in
              $status = Attendance::check_status($user->id, $location->id);
              if (!$status) {
                // check user in
                $debit = $punch->redeem_punch();
                if($debit) {
                  $credit = Attendance::check_in($user->id, $location->id);
                  if($credit) {
                    $session->message("The user was successfully checked in", "success");
                  } else {
                    $session->message("The user could not be added to the attendance list.", "danger");
                  }
                } else {
                $session->message("A punch could not be debited.", "danger");
                }
              } else {
                $session->message("The user is already checked in.", "danger");
              }
            } else {
              $session->message("The user does not have remaining punches.", "danger");
            }
          } else {
            // punch could not be found within pass
            $session->message("User's pass does not include this gym.", "danger");
          } 
        } else {
          //user not found
          $session->message("The member with an active pass was not found.", "danger");
        }
      } else {
        // if parameter was null
        $session->message("A valid entry is required.", "danger");
      }
    } else {
      // if location is full
      $session->message("The location is currently at maximum capacity.", "danger");
    }
  } else {
    $session->message("Your location is not set.", "danger");
  }
}

$page_title = 'Check In';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/view.php?id=' . u($location->id)); ?>"><?= h($gym->gym_name) . ' ' . h($location->location_name); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Check In</a></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/locations/checkin.php#results'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">User Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParameter1'] ?? '';?>" required>
                <option hidden value="">Select One</option>
                <option value="id">User ID</option>
                <option value="email">Email</option>
                <option value="phone_primary">Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" required>
            </div>
          </div>
          <div id="helpParameter1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>
      </div>

      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Check In User</button>
      </div>
    </div>
  </form>

  <?php if(isset($credit) && $credit) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Recent Check In</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>Most Recent Check In</caption>
          <thead class="table-primary">
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle text-nowrap">
              <td><?= h($user->id) ?></td>
              <td><?= h($user->first_name) . ' ' . h($user->last_name) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . u($user->id)); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . u($user->id)); ?>">Edit</a>
                  <a class="btn btn-danger" href="<?= url_for('/app/shared/users/delete.php?id=' . u($user->id)); ?>">Delete</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>