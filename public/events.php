<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Events';

$events_now = Event::find_ex_this_month();
$events_next = Event::find_ex_next_month();

if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}
?>

<header>
  <div class="p-5 bg-primary text-light" id="events-hd">
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-12 col-sm-8">
          <h1 class="display-2"><?= $page_title ?></h1>
        </div>
        <div class="col-8">
          <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
          <a class="btn btn-secondary" href="<?= url_for('/passes.php') ?>" role="button">Explore Passes</a>
        </div>
      </div>
    </div>
</header>

<main class="container-md p-4" id="main">
  <section class="pt-4">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">This Month's Events</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <?php foreach($events_now as $event) { ?>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100">
              <div class="card-header">
                <h3><?= ($event->start_date == $event->end_date) ? format_date($event->start_date, '/') : format_date($event->$start_date, '/') . ' - ' . format_date($event_end_date, '/') ?></h3>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $event->event_name ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                <p class="card-text"><?= $event->description ?></p>
              </div>
              <div class="card-body text-end pt-0">
                <a href="<?= url_for("/app/shared/gyms/gyms.php"); ?>" class="btn btn-primary">Manage Gyms</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <hr class="my-5">

  <section class="pt-4">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">Next Month's Events</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <?php foreach($events_next as $event) { ?>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100">
              <div class="card-header">
                <h3><?= ($event->start_date == $event->end_date) ? format_date($event->start_date, '/') : format_date($event->$start_date, '/') . ' - ' . format_date($event_end_date, '/') ?></h3>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $event->event_name ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                <p class="card-text"><?= $event->description ?></p>
              </div>
              <div class="card-body text-end pt-0">
                <a href="<?= h($event->url) ?>" class="btn btn-primary">Manage Gyms</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>