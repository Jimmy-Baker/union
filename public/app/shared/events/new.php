<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  $args = $_POST['event'];
  $event = new Event($args);
  $result = $event->save();

  if($result === true) {
    $new_id = $event->id;
    $session->message('The event was created successfully.', 'success');
    redirect_to(url_for('/app/shared/events/view.php?id=' . u($new_id)));
  } else {
    $session->message('Event creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $event = new Event;
}

$page_title = 'New Event';
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
          <li class="breadcrumb-item active text-primary" aria-current="page">New Event</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">


  <form action="<?= url_for('/app/shared/events/new.php'); ?>" method="post" class="needs-validation" novalidate>

    <?php include('form_fields.php'); ?>
    <button type="submit" name="submit" class="btn shadow btn-primary">Create Event</button>
  </form>

</main>

<?php
if($event->error_array != []){ 
  $error_render=$event->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>
