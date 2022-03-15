<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Events';
if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1 class="display-2">Events</h1>
      <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
      <a class="btn btn-primary" href="#" role="button">Explore Passes</a>
    </div>
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

<?php include(SHARED_PATH . '/public-footer.php'); ?>
