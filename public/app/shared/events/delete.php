<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/events/events.php'));
}
$id = $_GET['id'];
$event = Event::find_by_id($id);
if($event == false) {
  redirect_to(url_for('/app/shared/events/events.php'));
}

$page_title = 'Delete Event: ' . h($event->full_name());
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {

  // Delete event
  $result = $event->delete();
  $session->message('The event was deleted successfully.');
  redirect_to(url_for('/app/shared/events/events.php'));

} else {
  // Display form
}

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['event'];
  $event->merge_attributes($args);
  $result = $event->save();

  if($result === true) {
    $session->message('The event was updated successfully.');
    redirect_to(url_for('/app/shared/events/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Delete Event</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/events/events.php'); ?>">Events</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>"><?= $event->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Delete Event</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="eventMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Event Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="eventMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/events.php'); ?>">All Events</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/new.php'); ?>">New Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Event ID: <?= $event->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>">View Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/edit.php?id=' . $event->id); ?>">Edit Event</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/events/edit.php?id=' . $event->id); ?>">Delete Event</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/events/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Event Information</legend>
      <div class="card-body">
        <div class="card-text">
          <dl class="row">
            <dt class="col-sm-3">Start Date</dt>
            <dd class="col-sm-9"><?= h($event->start_date); ?></dd>
            <dt class="col-sm-3">End Date</dt>
            <dd class="col-sm-9"><?= h($event->end_date); ?></dd>
            <dt class="col-sm-3">Location ID</dt>
            <dd class="col-sm-9"><?= h($event->location_id); ?></dd>
            <dt class="col-sm-3">Event Name</dt>
            <dd class="col-sm-9"><?= h($event->event_name); ?></dd>
            <dt class="col-sm-3">Participants</dt>
            <dd class="col-sm-9"><?= h($event->participants); ?></dd>
            <dt class="col-sm-3">Cost</dt>
            <dd class="col-sm-9"><?= h($event->cost); ?></dd>
            <dt class="col-sm-3">URL</dt>
            <dd class="col-sm-9"><?= h($event->url); ?></dd>
          </dl>
        </div>
      </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>