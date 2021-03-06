<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!test_access('GS')) {
  $session->message('You do not have permission to view all locations.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

$locations = Location::find_all();

$page_title = 'Manage Locations';
include(SHARED_PATH . '/user-header.php'); 
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Locations</a></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="card shadow mx-auto mb-4">
    <div class="card-header">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All Locations</button>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all locations</caption>
              <?php include_once('table_contents.php'); ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a>
    </div>
    <?php if(test_access('AA')) { ?>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/locations/new.php'); ?>">Create A Location</a>
    </div>
    <?php } ?>
  </div>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>