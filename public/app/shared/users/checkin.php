<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'User Check In';
include(SHARED_PATH . '/user-header.php'); 

$location = Location::find_by_id($_SESSION['location']);
$gym = Gym::find_by_id($location->gym_id);

if(is_post_request()) {
  //validate location is set
  if($location) {
    // validate location has space
    if($location->available() > 0) {
      // determine user to check in
      $sql = "SELECT * FROM users WHERE ";
      if (isset($_POST['inputValue1'])) {
        $user = User::find_by_param($_POST['inputParameter1'], $_POST['inputValue1']);
        if ($user) {
          // determine pass to evaluate
          $pass = Pass::find_users_active_pass($user->id);
          if($pass){
            //user has an active pass
            $punch = PassItem::find_by_pass_and_gym($pass->id, $gym->id);
            if($punch){
              // check if user has punch remaining
              if($punch->available() > 0) {
                // check user in
                $debit = $punch->redeem_punch();
                if($debit) {
                  $credit = $location->check_in($user);
                  if($credit) {
                    $session->message("The user was successfully checked in", "success");
                  } else {
                    $session->message("The user could not be added to the attendance list.", "warning");
                  }
                } else {
                $session->message("A punch could not be debited.", "warning");
                }
              } else {
                $session->message("The user does not have remaining punches.", "warning");
              }
            } else {
              // punch could not be found within pass
              $session->message("User's pass does not include this gym.", "warning");
            }
          } else {
            // active pass not found
            $session->message("User does not have an active pass.", "warning");
          }
        } else {
          //user not found
          $session->message("The member was not found.", "warning");
        }
      } else {
        // if parameter was null
        $session->message("A valid entry is required.", "warning");
      }
    } else {
      // if location is full
      $session->message("The location is currently at maximum capacity.", "warning");
    }
  } else {
    $session->message("Your location is not set.", "warning");
  }
    
} else {

}
?>

<header>
  <div class="p-5 bg-light text-primary">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">Find Users</a></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          User Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="userMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/users/search.php'); ?>">Find Users</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/users/checkin.php#results'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">User Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParamater1'] ?? '';?>" required>
                <option value="id">User ID</option>
                <option value="email">Email</option>
                <option value="phone_primary">Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" required>
            </div>
          </div>
          <div id="phoneSecondaryHelp" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>
      </div>

      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Check In User</button>
      </div>
    </div>
  </form>

  <?php if (isset($users)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Search Results</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>User Search Results</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Access</th>
              <th>Name</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($user->id) ?></td>
              <td><?= h($user->access_abv) ?></td>
              <td><?= h($user->name()) . ' ' . h($user->last_name) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-danger" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>