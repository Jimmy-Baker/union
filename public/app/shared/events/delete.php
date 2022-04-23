<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Delete Event: ' . h($event->event_name());
require_login();

if(!isset($_GET['id'])) {
  $session->message("No event was identified.", "warning");
  redirect_to(url_for('/app/shared/events/events.php'));
}
$id = $_GET['id'];
$event = Event::find_by_id($id);
if($event == false) {
  $session->message("No event was identified.", "warning");
  redirect_to(url_for('/app/shared/events/events.php'));
}

if(is_post_request()) {
  // Delete location
  $result = $event->delete();
  if($result === true) {
    $session->message('The event was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/events/events.php'));
  } else {
    $session->message('The event deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/events/events.php'); ?>">Events</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>"><?= $event->full_name(); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Delete Event</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
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