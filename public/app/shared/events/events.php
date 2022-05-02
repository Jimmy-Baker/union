<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

$events = Event::find_all();
$loc_events = Event::find_all_by_param("location_id", h($session->location));
$local = $_GET['local'] ?? false;

$page_title = 'Manage Events';
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
          <li class="breadcrumb-item active text-primary" aria-current="page">Events</a></li>
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
          <button class="nav-link<?= $local ? '' : ' active'; ?>" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="<?= $local ? 'false' : 'true'; ?>">All Events</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link<?= $local ? ' active' : ''; ?>" id="pills-location-tab" data-bs-toggle="pill" data-bs-target="#pills-location" type="button" role="tab" aria-controls="pills-location" aria-selected="<?= $local ? 'true' : 'false'; ?>">My Location</button>
        </li>
      </ul>
    </div>
    <div class="card-body">

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade<?= $local ? '' : ' show active'; ?>" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all events</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Location ID</th>
                  <th>Event Name</th>
                  <th>Participants</th>
                  <th>Cost</th>
                  <th>URL</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($events as $event) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($event->id) ?></td>
                  <td><?= h($event->start_date) ?></td>
                  <td><?= h($event->end_date) ?></td>
                  <td><?= h($event->location_id) ?></td>
                  <td><?= h($event->event_name) ?></td>
                  <td><?= h($event->participants) ?></td>
                  <td><?= h($event->cost) ?></td>
                  <td><?= h($event->url) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="event actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/events/view.php?id=' . u($event->id)); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/edit.php?id=' . u($event->id)); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/delete.php?id=' . u($event->id)); ?>">Delete</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade<?= $local ? ' show active' : ''; ?>" id="pills-location" role="tabpanel" aria-labelledby="pills-location-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all events</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Location ID</th>
                  <th>Event Name</th>
                  <th>Participants</th>
                  <th>Cost</th>
                  <th>URL</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($loc_events as $loc_event) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($loc_event->id) ?></td>
                  <td><?= h($loc_event->start_date) ?></td>
                  <td><?= h($loc_event->end_date) ?></td>
                  <td><?= h($loc_event->location_id) ?></td>
                  <td><?= h($loc_event->event_name) ?></td>
                  <td><?= h($loc_event->participants) ?></td>
                  <td><?= h($loc_event->cost) ?></td>
                  <td><?= h($loc_event->url) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="event actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/events/view.php?id=' . u($loc_event->id)); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/edit.php?id=' . u($loc_event->id)); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/delete.php?id=' . u($loc_event->id)); ?>">Delete</a></li>
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
  <div class="row justify-content-evenly" role="toolbar" aria-label="Event toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/events/new.php'); ?>">Create A Event</a>
    </div>
  </div>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
