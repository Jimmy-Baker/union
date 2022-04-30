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
  <div class="p-5 bg-primary text-light" index="gyms-hd">
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-12 col-sm-8">
          <h1 class="display-2"><?= $page_title ?></h1>
        </div>
        <div class="col-8">
          <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
          <a class="btn btn-secondary" href="#howto" tabindex="0">Purchase Now</a>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section>
    <div class="card-group md-shadow">
      <!-- create to .md-shadow -->
      <div class="card col-md-4 px-0 shadow md-shadow-none">
        <!-- create to .shadow .md-shadow-none -->
        <div class="card-header bg-primary"></div>
        <div class="card-body">
          <div class="card-title py-3">
            <h2 class="display-4 text-center">Base Pass</h2>
          </div>
          <p class="card-text">The Base Pass afford members the ability to visit nearby gyms and plan for contingencies when roadtripping. </p>
        </div>
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item">1 Visit per Gym</li>
          <li class="list-group-item">Renews with your Membership</li>
          <li class="list-group-item">No Discounts on Additional Purchases</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$25</h3>
          <p class="text-center">per month<br><small>(with membership)</small></p>
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
          <li class="list-group-item">3 Visits per Gym</li>
          <li class="list-group-item">Renews with your Membership</li>
          <li class="list-group-item">10% off Additional Passes</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$50</h3>
          <p class="text-center">per month<br><small>(with membership)</small></p>
        </div>
      </div>

      <div class="card col-md-4 px-0">
        <!-- create to .shadow .md-shadow-none -->
        <div class="card-header bg-primary"></div>
        <div class="card-body">
          <div class="card-title py-3">
            <h2 class="display-4 text-center">Season Pass</h2>
          </div>
          <p class="card-text">Dirtbags rejoice! The Season Pass unlocks the Union network of gyms across the country - no membership required. Break the chain, hit the road, and climb where you want.</p>
        </div>
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item">5 Total Visits per Gym</li>
          <li class="list-group-item">Valid for 3 Months</li>
          <li class="list-group-item">No Discounts on Additional Purchases</li>
        </ul>
        <div class="card-footer">
          <h3 class="text-center display-5">$225</h3>
          <p class="text-center">one time purchase<br><small>(no membership required)</small></p>
        </div>
      </div>
    </div>
  </section>
  <hr class="py-1 my-5">

  <section class="pt-4" id="howto">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end h2 s-heading">How to Purchase</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <p class="h1 display-1 text-success text-center">Hit The Gym</p>
          <p class="lead text-center">... really ... it's that simple.</p>
          <p>Union Passes can be purchased directly from any gym in our network. Gyms that offer the Base or Union Pass make it simple to enroll and pay along with your monthly membership dues. Season Passes can also be purchased in full at partner gyms. Unlike Base and Union passes, they do not require an active membership with a partner gym.</p>
          <p>Once purchased, each pass immediately unlocks the ability to climb at every gym in the network. If you run out of passes for a particular gym and currently hold a Union Pass, you have the option to purchase a day pass at a 10% discount. Passes cannot be upgraded in the middle of a dues cycle, and pass purchases are limited to 1 per climber. Passes cannot be shared, swapped, sold, or traded with/to another climber.</p>
          <p>For more information and details on purchasing a pass, visit a <a href="/public/gyms.php">partner gym</a> near you.</p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>