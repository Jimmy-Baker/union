<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Attendance List';


if(is_post_request()) {
  //validate a method is provided
  switch ($_POST['method']) {
    case 'delete':
      {
        if(isset($_POST['id'])){
          $record = Attendance::find_by_id($_POST['id']);
          if($record){
            $result = $record->delete();
            if($result) {
              $session->message("The attendance record was deleted.", "success");
            } else {
              $session->message("The attendance record could not be found.", "warning");
            }
          } else {
            $session->message("The attendance record could not be found.", "warning");
          }
        } else {
          $session->message("The attendance record could not be processed.", "warning");
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
              $session->message("The check out could not be processed.", "warning");
            }
          } else {
            $session->message("A check out has already been recorded.", "warning");
          }
        } else {
          $session->message("The attendance record could not be processed.", "warning");
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= h($location->gym_name) . ' ' . h($location->location_name); ?></a></li>
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
  <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/new.php'); ?>">Create A Location</a>
    </div>
  </div>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
