<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Partner Gyms';
if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}

$locations = Location::find_all_locations_expanded();
$feature = Location::find_random_expanded();
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1 class="display-2"><?= $page_title ?></h1>
      <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">Explore Passes</button>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="row mt-4">
    <div class="col-12 col-md-8">
      <div class="row mt-4">
        <h2 class="text-primary">All Locations</h2>
      </div>
      <div class="row">
        <div class="accordion px-0 shadow" id="accordionGyms">
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingNortheast">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNortheast" aria-expanded="true" aria-controls="collapseNortheast">Northeast</button>
            </h3>
            <div id="collapseNortheast" class="accordion-collapse collapse show" aria-labelledby="headingNortheast" data-bs-parent="#accordionGyms">
              <div class="accordion-body">
                <ul class="list-group-flush ps-0">
                  <?php foreach($locations as $location) if ($location->region == 'Northeast') { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h4 class="h6"><?= h($location->gym_name) . ' - ' . h($location->location_name) ?></h4>
                      <?= h($location->city) . ', ' . h($location->state_abv) ?>
                    </div>
                    <a href="<?= url_for("/app/shared/locations/view.php?id=" . h(u($location->id))); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class=" accordion-item">
            <h3 class="accordion-header" id="headingSoutheast">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSoutheast" aria-expanded="false" aria-controls="collapseSoutheast">Southeast</button>
            </h3>
            <div id="collapseSoutheast" class="accordion-collapse collapse" aria-labelledby="headingSoutheast" data-bs-parent="#accordionGyms">
              <div class="accordion-body">
                <ul class="list-group-flush ps-0">
                  <?php foreach($locations as $location) if ($location->region == 'Southeast') { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h4 class="h6"><?= h($location->gym_name) . ' - ' . h($location->location_name) ?></h4>
                      <?= h($location->city) . ', ' . h($location->state_abv) ?>
                    </div>
                    <a href="<?= url_for("/app/shared/locations/view.php?id=" . h(u($location->id))); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingCentral">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCentral" aria-expanded="false" aria-controls="collapseCentral">Central</button>
            </h3>
            <div id="collapseCentral" class="accordion-collapse collapse" aria-labelledby="headingCentral" data-bs-parent="#accordionGyms">
              <div class="accordion-body">
                <ul class="list-group-flush ps-0">
                  <?php foreach($locations as $location) if ($location->region == 'Central') { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h4 class="h6"><?= h($location->gym_name) . ' - ' . h($location->location_name) ?></h4>
                      <?= h($location->city) . ', ' . h($location->state_abv) ?>
                    </div>
                    <a href="<?= url_for("/app/shared/locations/view.php?id=" . h(u($location->id))); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingMountain">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMountain" aria-expanded="false" aria-controls="collapseMountain">Mountain</button>
            </h3>
            <div id="collapseMountain" class="accordion-collapse collapse" aria-labelledby="headingMountain" data-bs-parent="#accordionGyms">
              <div class="accordion-body">
                <ul class="list-group-flush ps-0">
                  <?php foreach($locations as $location) if ($location->region == 'Mountain') { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h4 class="h6"><?= h($location->gym_name) . ' - ' . h($location->location_name) ?></h4>
                      <?= h($location->city) . ', ' . h($location->state_abv) ?>
                    </div>
                    <a href="<?= url_for("/app/shared/locations/view.php?id=" . h(u($location->id))); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingPacific">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePacific" aria-expanded="false" aria-controls="collapsePacific">Pacific</button>
            </h3>
            <div id="collapsePacific" class="accordion-collapse collapse" aria-labelledby="headingPacific" data-bs-parent="#accordionGyms">
              <div class="accordion-body">
                <ul class="list-group-flush ps-0">
                  <?php foreach($locations as $location) if ($location->region == 'Pacific') { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h4 class="h6"><?= h($location->gym_name) . ' - ' . h($location->location_name) ?></h4>
                      <?= h($location->city) . ', ' . h($location->state_abv) ?>
                    </div>
                    <a href="<?= url_for("/app/shared/locations/view.php?id=" . h(u($location->id))) ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="row mt-4">
        <h2 class="text-primary">Feature Location</h2>
      </div>
      <div class="row">
        <div class="card shadow col-12 col-md-6 px-0">
          <h3 class="card-header"><?= h($feature->gym_name) . ' ' . h($feature->location_name) ?></h3>
          <div class="card-body">
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row mt-4">
    <h2 class="text-primary">Upcoming Events</h2>
  </div>
  <div class="card-group" id="events">
  </div>
</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>
