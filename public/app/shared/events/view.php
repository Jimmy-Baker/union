<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No event was identified.', 'warning');
  redirect_to(url_for('/app/shared/events/events.php'));
}
$id = $_GET['id'];
$event = Event::find_by_id($id);
if($event == false) {
  $session->message('No event was identified.', 'warning');
  redirect_to(url_for('/app/shared/events/events.php'));
}

$page_title = 'Event: ' . h($event->event_name);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Event Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/events/events.php'); ?>">Events</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $event->event_name ?></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="eventMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Event Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="eventMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/events.php'); ?>">All Events</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/new.php'); ?>">New Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Event ID: <?= $event->id ?></h4>
          </li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>">View Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/edit.php?id=' . $event->id); ?>">Edit Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/edit.php?id=' . $event->id); ?>">Delete Event</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Gym Event</div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($event->event_name); ?><span class="card-subtitle text-muted"> (#<?= h($event->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="#" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $event->event_name ?>'s profile picture." height="200" width="200">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Start Date</dt>
              <dd class="col-sm-8"><?= d($event->start_date); ?></dd>
              <dt class="col-sm-4 text-sm-end">End Date</dt>
              <dd class="col-sm-8"><?= d($event->end_date); ?></dd>
              <dt class="col-sm-4 text-sm-end">Location ID</dt>
              <dd class="col-sm-8"><?= d($event->location_id); ?></dd>
              <dt class="col-sm-4 text-sm-end">Participants</dt>
              <dd class="col-sm-8"><?= d($event->participants); ?></dd>
              <dt class="col-sm-4 text-sm-end">Cost</dt>
              <dd class="col-sm-8"><?= d($event->cost); ?></dd>
              <dt class="col-sm-4 text-sm-end">URL</dt>
              <dd class="col-sm-8"><?= d($event->url); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Event toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/events/edit.php?id='. h(u($event->id))); ?>">Edit This Event</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/events/delete.php?id='. h(u($event->id))); ?>">Delete This Event</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
