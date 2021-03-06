<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!test_access('GS')){
  $session->message('You do not have permission to view event details.', 'warning');
  redirect_to(url_for($session->dashboard()));
} 

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
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/events/events.php'); ?>">Events</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?= h($event->event_name) ?></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
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
              <dt class="col-sm-4 text-sm-end">Description</dt>
              <dd class="col-sm-8"><?= d($event->description); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if(Permission::test_location_user_permission($event->location_id, $session->user_id, 'XE') || $session->access_abv == 'AA'){ ?>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Event toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/events/edit.php?id='. u($event->id)); ?>">Edit This Event</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/events/delete.php?id='. u($event->id)); ?>">Delete This Event</a>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
