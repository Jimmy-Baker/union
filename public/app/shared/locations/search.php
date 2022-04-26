<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST;
  $search = new Search($args);
  $search->table = "locations";
  
  $sql = $search->getSQL();
  if($sql){
    $locations = User::find_by_sql($sql);
    if($locations) {
      if(count($locations) < 1){
       $session->message('No locations were found. Please try again.', 'warning');
      } elseif(count($locations) == 1) {
        $session->message(count($locations) . ' location was found.', 'success');
      } else {
        $session->message(count($locations) . ' locations were found.', 'success');
      }
    } else {
      $session->message('The search query failed. Please try again.', 'warning');
    }
  } else {
    $session->message('Please check your search terms and try again.', 'warning');
  }
} else {
  
}

$page_title = 'Find Locations';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/locations/locations.php'); ?>">Locations</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Find Locations</a></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/locations/search.php#results'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Search Criteria</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query1">
          <div class="col-md-3 text-md-end">
            <label for="inputValue1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter1" id="inputParameter1" required>
                <option hidden value="">Select One</option>
                <option value="location_name" <?= ($_POST['inputParameter1'] ?? '') == "location_name" ? "selected" : "" ?>>First Name</option>
                <option value="gym_id" <?= ($_POST['inputParameter1'] ?? '') == "gym_id" ? "selected" : "" ?>>Gym ID</option>
                <option value="city" <?= ($_POST['inputParameter1'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="state" <?= ($_POST['inputParameter1'] ?? '') == "state" ? "selected" : "" ?>>State</option>
                <option value="location_name" <?= ($_POST['inputParameter1'] ?? '') == "location_name" ? "selected" : "" ?>>Location Name</option>
                <option value="phone_primary" <?= ($_POST['inputParameter1'] ?? '') == "phone_primary" ? "selected" : "" ?>>Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" aria-describedby="helpValue1" id="inputValue1" required>
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close1" disabled></button>
            </div>
          </div>
          <div id="helpValue1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query2">
          <div class="col-md-3 text-md-end">
            <label for="inputValue2" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter2" id="inputParameter2">
                <option hidden value="">Select One</option>
                <option value="location_name" <?= ($_POST['inputParameter2'] ?? '') == "location_name" ? "selected" : "" ?>>First Name</option>
                <option value="gym_id" <?= ($_POST['inputParameter2'] ?? '') == "gym_id" ? "selected" : "" ?>>Gym ID</option>
                <option value="city" <?= ($_POST['inputParameter2'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="state" <?= ($_POST['inputParameter2'] ?? '') == "state" ? "selected" : "" ?>>State</option>
                <option value="location_name" <?= ($_POST['inputParameter2'] ?? '') == "location_name" ? "selected" : "" ?>>Location Name</option>
                <option value="phone_primary" <?= ($_POST['inputParameter2'] ?? '') == "phone_primary" ? "selected" : "" ?>>Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue2" value="<?= $_POST['inputValue2'] ?? '';?>" aria-describedby="helpValue2" id="inputValue2">
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close2"></button>
            </div>
          </div>
          <div id="helpValue2" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query3">
          <div class="col-md-3 text-md-end">
            <label for="inputValue3" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter3" id="inputParameter3">
                <option hidden value="">Select One</option>
                <option value="location_name" <?= ($_POST['inputParameter3'] ?? '') == "location_name" ? "selected" : "" ?>>First Name</option>
                <option value="gym_id" <?= ($_POST['inputParameter3'] ?? '') == "gym_id" ? "selected" : "" ?>>Gym ID</option>
                <option value="city" <?= ($_POST['inputParameter3'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="state" <?= ($_POST['inputParameter3'] ?? '') == "state" ? "selected" : "" ?>>State</option>
                <option value="location_name" <?= ($_POST['inputParameter3'] ?? '') == "location_name" ? "selected" : "" ?>>Location Name</option>
                <option value="phone_primary" <?= ($_POST['inputParameter3'] ?? '') == "phone_primary" ? "selected" : "" ?>>Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue3" value="<?= $_POST['inputValue3'] ?? '';?>" aria-describedby="helpValue3" id="inputValue3">
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close3"></button>
            </div>
          </div>
          <div id="helpValue3" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParameter1'] ?? '';?>" required>
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
          <div id="helpParameter1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div id="addParamRow" class="row mb-3 mb-md-4">
          <div class="row col-md-10 justify-content-end">
            <div class="col-auto">
              <button id="addParam" type="button" class="btn btn-outline-primary">Add A Parameter</button>
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
              <td><a href="<?= url_for('/app/shared/gyms/view.php?id=' . u($location->gym_id)); ?>"><?= h($location->gym_id) ?></a></td>
              <td><?= h($location->location_name) ?></td>
              <td><?= h($location->city) ?></td>
              <td><?= h($location->state_abv) ?></td>
              <td><a href="<?= 'tel:' . format_call(h($location->phone_p_country), h($location->phone_primary)) ?>"><?= format_phone(h($location->phone_p_country), h($location->phone_primary)) ?></a></td>
              <td>
                <div class="btn-group" role="group" aria-label="location actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/locations/view.php?id=' . u($location->id)); ?>">View</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/edit.php?id=' . u($location->id)); ?>">Edit</a></li>
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/delete.php?id=' . u($location->id)); ?>">Delete</a></li>
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
