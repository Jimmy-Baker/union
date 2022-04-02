<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Home';
if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}
?>

<header>
  <div class="p-5 bg-dark text-light" id="index-hd">
    <div class="container-fluid py-3">
      <h1 class="display-2">Freedom to Climb</h1>
      <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
      <a class="btn btn-primary" href="<?= url_for('passes.php');?>" role="button">Explore Passes</a>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section class="row">
    <div class="col-lg-3">
      <h2>How it Works</h2>
    </div>
    <div class="col-lg-9 row">
      <div class="col-4 bg-primary p-4">
        <div class="row align-items-end">
          <div class="col-5 px-2">
            <img class="img-fluid" src="/public/img/unity-logo.png" width="726" height="914" alt="Union member. ">
          </div>
          <div class="col-7 px-2">
            <img class="img-fluid" src="/public/img/gym-logo.png" width="1084" height="1026" alt="Home gym.">
          </div>
        </div>
      </div>
      <div class="col-3 bg-secondary p-4">
        <div class="row align-items-end">
          <div class="col px-2">
            <img class="img-fluid" src="/public/img/union-logo.png" width="986" height="646" alt="Home gym.">
          </div>
        </div>
      </div>
      <div class="col-5 bg-primary p-4">
        <div class="row align-items-end">
          <div class="col-4 px-2">
            <img class="img-fluid" src="/public/img/gym-baby.png" width="726" height="1026" alt="Partner gym. ">
          </div>
          <div class="col-4 px-2">
            <img class="img-fluid" src="/public/img/gym-red.png" width="726" height="1026" alt="Partner gym. ">
          </div>
          <div class="col-4 px-2">
            <img class="img-fluid" src="/public/img/gym-blue.png" width="726" height="1026" alt="Partner gym. ">
          </div>
        </div>
      </div>
    </div>
  </section>
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