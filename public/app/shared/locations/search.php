<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Find Locations';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $sql = "SELECT * FROM locations WHERE ";
  if (isset($_POST['inputValue1'])) {
    $sql .= $_POST['inputParameter1'] . " LIKE '%" . $_POST['inputValue1'] . "%'";
  };
  if (isset($_POST['inputValue2'])) {
    $sql .= "AND " . $_POST['inputParameter2'] . " LIKE '%" . $_POST['inputValue2'] . "%'";
  };
  if (isset($_POST['inputValue3'])) {
    $sql .= "AND " . $_POST['inputParameter3'] . " LIKE '%" . $_POST['inputValue3'] . "%'";
  };
  if (isset($_POST['inputValue4'])) {
    $sql .= "AND " . $_POST['inputParameter4'] . " LIKE '%" . $_POST['inputValue4'] . "%'";
  };
  if (isset($_POST['inputValue5'])) {
    $sql .= "AND " . $_POST['inputParameter5'] . " LIKE '%" . $_POST['inputValue5'] . "%'";
  };
  
  $locations = Location::find_by_sql($sql);
} else {

}
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Find Locations</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item active" aria-current="page">Find Locations</a></li>
        </ol>
      </nav>
      <?php 
        define('drop_menu', TRUE);
        include('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/locations/search.php#results'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Search Criteria</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParamater1'] ?? '';?>" required>
                <option value="location_name">Location Name</option>
                <option value="gym_id">Gym ID</option>
                <option value="city">City</option>
                <option value="zip">Zip Code</option>
                <option value="phone_primary">Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" required>
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" disabled></button>
            </div>
          </div>
          <div id="phoneSecondaryHelp" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row mb-3 mb-md-4">
          <div class="row col-md-10 justify-content-end">
            <div class="col-auto">
              <button type="button" class="btn btn-outline-primary">Add A Parameter</button>
            </div>
          </div>
        </div>
      </div>

      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="Location toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Search For Locations</button>
      </div>
    </div>
  </form>

  <?php if (isset($locations)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Search Results</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>Location Search Results</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Gym ID</th>
              <th>Location Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($locations as $location) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($location->id) ?></td>
              <td><a href="<?= url_for('/app/shared/gyms/view.php?id=' . h(u($location->gym_id))); ?>"><?= h($location->gym_id) ?></a></td>
              <td><?= h($location->location_name) ?></td>
              <td><?= h($location->city) ?></td>
              <td><?= h($location->state_abv) ?></td>
              <td><a href="<?= 'tel:' . format_call(h($location->phone_p_country), h($location->phone_primary)) ?>"><?= format_phone(h($location->phone_p_country), h($location->phone_primary)) ?></a></td>
              <td>
                <div class="btn-group" role="group" aria-label="location actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/locations/view.php?id=' . h(u($location->id))); ?>">View</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/edit.php?id=' . h(u($location->id))); ?>">Edit</a></li>
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/delete.php?id=' . h(u($location->id))); ?>">Delete</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>