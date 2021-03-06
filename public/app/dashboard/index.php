<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = User::USER_TYPES[$session->access_abv] . ' Dashboard';
include(SHARED_PATH . '/user-header.php'); 

if(test_access('GM')){
  $location = Location::find_by_id($session->location);
}
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active text-primary" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section class="row mx-0 mb-4 gy-3">
    <div class="card shadow col-12 col-md-6 px-0">
      <div class="row align-items-center">
        <div class="col-4">
          <img src="<?= h($session->avatar_url); ?>" class="img-thumbnail avatar m-3" alt="<?= h($session->name); ?> profile photo." height="200" width="200">
        </div>
        <div class="col-8">
          <div class="card-body">
            <h3 class="card-title"><?= h($session->name); ?></h3>
            <p class="card-text">Welcome to Union! Your dashboard is your home base to manage your account and pass. Any applications you have access to can be found here as wall.</p>
            <p class="card-text"><small class="text-muted">Logged in as <?= User::USER_TYPES[$session->access_abv] ?></small></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col col-lg-4 card shadow me-2 ms-md-3 px-0">
      <h5 class="card-header">Quick Links</h5>
      <div class="card-body row row-cols-1 g-2">
        <a class="col btn btn-primary" href="<?= url_for('app/shared/users/view.php?id=' . u($session->user_id)) ?>">My Profile</a>
        <a class="col btn btn-primary" href="<?= url_for('app/shared/passes/view.php?id=' . u($session->pass_id)) ?>">My Pass</a>
        <a class="col btn btn-primary" href="<?= url_for('app/shared/locations/view.php?id=' . u($session->location)) ?>">My Gym</a>
      </div>
    </div>
  </section>

  <section class="accordion shadow" id="accordionTools">
    <?php if(test_access('AA')) { ?>
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
                  <p class="card-text">Create, update, or delete users with the User Management tool.</p>
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
                  <p class="card-text">Create, update, or delete groups with the Group Management tool.</p>
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
                  <p class="card-text">Create, update, or delete gyms with the Gym Management tool.</p>
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
                  <p class="card-text">Create, update, or delete locations with the Location Management tool.</p>
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
                  <p class="card-text">Create, update, or delete events at any location with the Event Management tool.</p>
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
                  <p class="card-text">Create, update, or delete custom passes with the Pass Management tool.</p>
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
    <?php } ?>
    <?php if(test_access('GM')) { ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingManager">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManager" aria-expanded="false" aria-controls="collapseManager">
          Gym Manager Tools
        </button>
      </h2>
      <div id="collapseManager" class="accordion-collapse collapse" aria-labelledby="headingManager" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Manage Gym Location</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Managers</h6>
                  <p class="card-text">Edit your location's details for others to view.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/locations/view.php?id=" . u($location->id)); ?>" class="btn btn-primary">Gym Location</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Manage Gym Employees</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Managers</h6>
                  <p class="card-text">Add or remove users to your location's employee group.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/groups/view.php?id=" . u($location->employee_group)); ?>" class="btn btn-primary">Gym Employees</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Manage Gym Events</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Managers</h6>
                  <p class="card-text">Create, update, or delete events at your location.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/events/events.php?local=true"); ?>" class="btn btn-primary">Gym Events</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(test_access('GS')) { ?>
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
                  <p class="card-text">Check in users to your location and manage check-ins.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/locations/checkin.php"); ?>" class="btn btn-primary">Check In Users</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Pass Provision</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Staff</h6>
                  <p class="card-text">Fully provision new passes to users.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/passes/provision.php"); ?>" class="btn btn-primary">Provide A Pass</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">Gym Attendance</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Gym Staff</h6>
                  <p class="card-text">Manage users currently checked into your location.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/locations/attendance.php"); ?>" class="btn btn-primary">View Attendance</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(test_access('MM')) { ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingMember">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMember" aria-expanded="false" aria-controls="collapseMember">
          Member Tools
        </button>
      </h2>
      <div id="collapseMember" class="accordion-collapse collapse" aria-labelledby="headingMember" data-bs-parent="#accordionTools">
        <div class="accordion-body">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">View My Pass</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Union Member</h6>
                  <p class="card-text">View information about your pass and available punches.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for('app/shared/passes/view.php?id=' . u($session->pass_id)) ?>" class="btn btn-primary">View My Pass</a>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">My Profile</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Union Member</h6>
                  <p class="card-text">View and edit your profile information.</p>
                </div>
                <div class="card-body text-end pt-0">
                  <a href="<?= url_for("/app/shared/users/view.php?id=" . $session->user_id); ?>" class="btn btn-primary">View My Profile</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </section>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>