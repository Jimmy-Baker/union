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
  <div class="p-5 bg-primary text-light" id="gyms-hd">
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-12 col-sm-8">
          <h1 class="display-2"><?= $page_title ?></h1>
        </div>
        <div class="col-8">
          <p>Unlock climbing access nation-wide with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
          <a class="btn btn-secondary" href="#region" tabindex="0">View by Region</a>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section class="pt-4">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">Featured Gyms</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <div class="col-12">
            <div class="row g-4">
              <div class="col-12 col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3><?= h($feature->gym_name) ?></h3>
                  </div>
                  <div class="card-body">
                    <img src="<?= h($feature->avatar_url); ?>" class="img-fluid img-thumbnail avatar m-3 d-block mx-auto" alt="<?= h($feature->gym_name); ?> profile photo." height="200" width="200">
                    <h3 class="card-title"><?= h($feature->location_name) ?></h3>
                    <div class="card-text">
                      <address><?= h($feature->street_address) ?><br><?= h($feature->city) ?>, <?= h($feature->state_abv) ?></address>
                    </div>
                    <a href="<?= url_for('app/shared/locations/view.php?id=' . u($feature->id)) ?>" class="btn btn-primary">Gym Details</a>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-6">
                <div class="card h-100">
                  <div class="card-header">
                    <h3>Nationwide</h3>
                  </div>
                  <div class="card-body">
                    <figure>
                      <div id="map">
                        <img class="img-fluid px-3 py-5" src="<?= url_for("/public/img/map.png"); ?>" alt="Map of Union gyms.">
                      </div>
                      <figcaption>There are <strong><?= count($locations) ?></strong> different locations in the nationwide Union network. <strong><?= $feature->gym_name ?> <?= $feature->location_name ?></strong> is just one of many partners offering access with a Union pass.
                      </figcaption>
                    </figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="my-5">

  <section class="pt-4" id="region">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">All Locations</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">
          <div class="col-12">
            <div class="accordion border-primary px-0 shadow" id="accordionGyms">
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
                        <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
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
                        <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
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
                        <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
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
                        <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)); ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
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
                        <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)) ?>" class="btn btn-secondary">View<span class="visually-hidden"> <?= h($location->gym_name) . ' ' . h($location->location_name) ?></span></a>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php 
include(SHARED_PATH . '/public-footer.php');
?>