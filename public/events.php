<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Events';

$events_now = Event::find_all_this_month();
$events_next = Event::find_all_next_month();

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
          <a class="btn btn-primary" href="#" role="button">Explore Passes</a>
        </div>
      </div>
    </div>
</header>

<main class="container-md p-4" id="main">
  <section class="pt-4">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">How it Works</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <?php foreach($events_now as $event) { ?>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Gym Management</h5>
                <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
        <h2 class="text-dark text-xl-end s-heading">How it Works</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <?php foreach($events_next as $event) { ?>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Gym Management</h5>
                <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>