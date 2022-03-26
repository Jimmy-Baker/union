<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Administrator Dashboard';
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1 class="display-2">Administrator Dashboard</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Dashboard Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="userMenuLink">
          <li>
            <p class="dropdown-header">I may get rid of this</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section class="row mx-0 mb-4 gy-3">
    <div class="card shadow col-12 col-md-6 px-0">
      <div class="row align-items-center">
        <div class="col-4">
          <img src="<?= $session->avatar_url; ?>" class="img-fluid img-thumbnail m-3" alt="<?= $session->name; ?> profile photo." height="200" width="200">
        </div>
        <div class="col-8">
          <div class="card-body">
            <h3 class="card-title"><?= $session->name; ?></h3>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Logged in as Administrator</small></p>
          </div>
        </div>
      </div>
      <!-- </div>
    <div class="col card shadow me-2 ms-md-3 px-0">
      <h5 class="card-header">Link group</h5>
      <div class="card-body row row-cols-1 g-2">
        <a class="col btn btn-primary ">My Passes</a>
        <a class="col btn btn-primary ">My Profile</a>
        <a class="col btn btn-primary ">Button</a>
      </div>
    </div>
    <div class="col card shadow ms-2 px-0">
      <h5 class="card-header">Link group</h5>
      <div class="card-body row row-cols-1 g-2">
        <a class="col btn btn-primary ">Button</a>
        <a class="col btn btn-primary ">Button</a>
        <a class="col btn btn-primary ">Button</a>
      </div>
    </div> -->
  </section>

  <section class="accordion shadow" id="accordionTools">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingAdmin">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
          Administrator Tools
        </button>
      </h2>
      <div id="collapseAdmin" class="accordion-collapse collapse show" aria-labelledby="headingAdmin" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">User Management</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/users/users.php"); ?>" class="btn btn-primary">Manage Users</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Group Management</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/groups/groups.php"); ?>" class="btn btn-primary">Manage Groups</a>
                </div>
              </div>
            </div>
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
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Location Management</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/locations/locations.php"); ?>" class="btn btn-primary">Manage Locations</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Event Management</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/events/events.php"); ?>" class="btn btn-primary">Manage Events</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Pass Management</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Admin Only</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/passes/passes.php"); ?>" class="btn btn-primary">Manage Passes</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingManager">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManager" aria-expanded="false" aria-controls="collapseManager">
          Gym Manager Tools
        </button>
      </h2>
      <div id="collapseManager" class="accordion-collapse collapse" aria-labelledby="headingManager" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingStaff">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStaff" aria-expanded="false" aria-controls="collapseStaff">
          Gym Staff Tools
        </button>
      </h2>
      <div id="collapseStaff" class="accordion-collapse collapse" aria-labelledby="headingStaff" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">User Check In</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Staff</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/users/checkin.php"); ?>" class="btn btn-primary">Check In Users</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Pass Provision</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Staff</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/groups/groups.php"); ?>" class="btn btn-primary">Provide A Pass</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingMember">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMember" aria-expanded="false" aria-controls="collapseMember">
          Member Tools
        </button>
      </h2>
      <div id="collapseMember" class="accordion-collapse collapse" aria-labelledby="headingMember" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <strong>This is the fourth item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.
        </div>
      </div>
    </div>
  </section>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>