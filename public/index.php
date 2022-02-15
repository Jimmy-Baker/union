<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public-header.php'); ?>

<header class="container-fluid cta cta-pass px-4 py-5">
  <div class="container-fluid pt-5">
    <h1 class="text-uppercase">Freedom to Climb</h1>
    <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
    <a class="btn btn-primary" href="#" role="button">Explore Passes</a>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="row mt-4">
    <h2 class="text-primary">Recent Activity</h2>
  </div>
  <div class="card-group" id="activity">

  </div>
  <hr>
  <div class="row mt-4">
    <h2 class="text-primary">Upcoming Events</h2>
  </div>
  <div class="card-group" id="events">
  </div>
</main>

<?php include(SHARED_PATH . '/public_footer.php'); ?>