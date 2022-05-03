<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!test_access('GS')) {
  $session->message('You do not have permission to view this location\'s attendance.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  switch ($_POST['method']) {
    case 'delete':
      {
        if(isset($_POST['id'])){
          $record = Attendance::find_by_id($_POST['id']);
          if($record){
            $result = $record->delete();
            if($result) {
              $session->message("The attendance record was deleted.", "danger");
            } else {
              $session->message("The attendance record could not be found.", "danger");
            }
          } else {
            $session->message("The attendance record could not be found.", "danger");
          }
        } else {
          $session->message("The attendance record could not be processed.", "danger");
        }
      };
      break;
    case 'checkout':
      {
        if(isset($_POST['id'])){
          $record = Attendance::find_by_id($_POST['id']);
          if($record->time_out == null) {
            $result = $record->check_out();
            if($result) {
              $session->message("The user was checked out.", "success");
            } else {
              $session->message("The check out could not be processed.", "danger");
            }
          } else {
            $session->message("A check out has already been recorded.", "danger");
          }
        } else {
          $session->message("The attendance record could not be processed.", "danger");
        }
      };
      break;
    default:
      //no method provided in post request
      break;
  }
}

$location = Location::find_expanded_by_id($session->location);
$participants = Attendance::today_list_expanded($location->id);

$page_title = 'Attendance List';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/view.php?id=' . u($location->id)); ?>"><?= h($location->gym_name) . ' ' . h($location->location_name); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Attendance</a></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="card shadow mx-auto mb-4">
    <div class="card-header">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">Checked In</button>
        </li>
      </ul>
    </div>
    <div class="card-body">

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all checked in users</caption>
              <thead class="table-primary">
                <tr>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php if($participants){foreach($participants as $participant) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($participant->user_id) ?></td>
                  <td><?= h($participant->first_name) . ' ' . h($participant->last_name) ?></td>
                  <td><?= h($participant->time_in) ?></td>
                  <td><?= h($participant->time_out) ?></td>
                  <td>
                    <form method="POST" action="<?= url_for('/app/shared/locations/attendance.php'); ?>">
                      <input type="hidden" name="id" value="<?= h($participant->id) ?>">
                      <div class="btn-group" role="group" aria-label="location actions">
                        <button class="btn btn-primary" type="submit" name="method" value="checkout">Check Out</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                          <li><button type="submit" class="dropdown-item" name="method" value="delete">Delete Check In</button></li>
                          <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-bs-id="<?=($participant->id) ?>">Remove User</button></li>
                        </ul>
                      </div>
                    </form>
                  </td>
                </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this check in? The user will not be refunded a punch.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="<?= url_for('/app/shared/locations/attendance.php'); ?>" method="POST">
            <input type="hidden" name="id" value="" id="confirmInput">
            <input type="hidden" name="method" value="delete">
            <button type="submit" class="btn btn-primary" id="confirmButton">Confirm Removal</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/checkin.php'); ?>">Check In User</a>
    </div>
  </div>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
