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

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['event'];
  
  for($num = 1; $num<2; $num++) {
    if($_POST['image'.$num]) {
      $url = imageUpload("image$num", $event, "event", $num);
      if($url) {
        $args['photo_data'] = $url;
      } else {
        $session->message('The image could not be uploaded', 'warning');
      }
    }
  }
    
  $event->merge_attributes($args);
  $result = $event->save();

  if($result === true) {
    $session->message('The event was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/events/view.php?id=' . u($id)));
  } else {
    $session->message('The event update failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  //display the form
}

$page_title = 'Edit Event: ' . h($event->event_name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/events/view.php?id=' . u($event->id)); ?>"><?= h($event->event_name); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Edit Event</li>
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
            <h4 class="dropdown-header fs-6 text-dark">Event ID: <?= h($event->id) ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/view.php?id=' . u($event->id)); ?>">View Event</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/events/edit.php?id=' . u($event->id)); ?>">Edit Event</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/edit.php?id=' . u($event->id)); ?>">Delete Event</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($event->error_array); ?>
  <form action="<?= url_for('/app/shared/events/edit.php?id=' . u($id)); ?>" method="post" enctype="multipart/form-data">

    <?php define('exists', TRUE); ?>
    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/events/view.php?id=' . u($event->id)); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>