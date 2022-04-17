<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Passes';
if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1 class="display-2">Passes</h1>
      <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
      <a class="btn btn-primary" href="#" role="button">Explore Passes</a>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section>
    <div class="card-group shadow">
      <!-- create to .md-shadow -->
      <div class="card col-md-4 px-0">
        <!-- create to .shadow .md-shadow-none -->
        <div class="card-header bg-primary"></div>
        <div class="card-body">
          <div class="card-title py-3">
            <h2 class="display-4 text-center">Base Pass</h2>
          </div>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item">2 Visits per Gym</li>
          <li class="list-group-item">Second Benfit</li>
          <li class="list-group-item">Third Benefit</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$120</h3>
          <div class="text-end pt-4">
            <a href="#" class="btn btn-primary disabled">More Info</a>
          </div>
        </div>
      </div>

      <div class="card col-md-4 px-0">
        <!-- create to .shadow .md-shadow-none -->
        <div class="card-header bg-primary"></div>
        <div class="card-body">
          <div class="card-title py-3">
            <h2 class="display-4 text-center">Union Pass</h2>
          </div>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item">5 Visits per Gym</li>
          <li class="list-group-item">Second Benfit</li>
          <li class="list-group-item">Third Benefit</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$200</h3>
          <div class="text-end pt-4">
            <a href="#" class="btn btn-primary disabled">More Info</a>
          </div>
        </div>
      </div>

      <div class="card col-md-4 px-0">
        <!-- create to .shadow .md-shadow-none -->
        <div class="card-header bg-primary"></div>
        <div class="card-body">
          <div class="card-title py-3">
            <h2 class="display-4 text-center">Premier Pass</h2>
          </div>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item">2-5 Visits per Gym/month</li>
          <li class="list-group-item">Second Benfit</li>
          <li class="list-group-item">Third Benefit</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$500</h3>
          <div class="text-end pt-4">
            <a href="#" class="btn btn-primary disabled">More Info</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>
