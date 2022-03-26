<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Attendance List';
include(SHARED_PATH . '/user-header.php'); 
?>

<?php
$location = Location::find_by_id($session->location);
$participants = $location->attendance_data;
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>"><?= $location->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Locations</a></li>
        </ol>
      </nav>
      <?php 
        define('drop_menu', TRUE);
        include('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<?php var_dump($participants); ?>

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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($participants as $participant) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($participant->id) ?></td>
                  <td><?= h($participant->name) ?></td>
                  <td><?= h($participant->in) ?></td>
                  <td><?= h($participant->out) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="location actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/locations/view.php?id=' . h(u($participant->id))); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/edit.php?id=' . h(u($participant->id))); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/delete.php?id=' . h(u($participant->id))); ?>">Delete</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
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