<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST;
  $search = new Search($args);
  $search->table = "users";
  
  $sql = $search->getSQL();
  if($sql){
    $users = User::find_by_sql($sql);
    if($users) {
      if(count($users) < 1){
       $session->message('No users were found. Please try again.', 'warning');
      } elseif(count($users) == 1) {
        $session->message(count($users) . ' user was found.', 'success');
      } else {
        $session->message(count($users) . ' users were found.', 'success');
      }
    } else {
      $session->message('The search query failed to return a result. Please try again.', 'warning');
    }
  } else {
    $session->message('Please check your search terms and try again.', 'warning');
  }
} else {
  
}

$page_title = 'Find Users';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Find Users</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/users/search.php#results'); ?>" method="POST" class="mb-5 needs-validation" novalidate>
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
                <option value="first_name" <?= ($_POST['inputParameter1'] ?? '') == "first_name" ? "selected" : "" ?>>First Name</option>
                <option value="last_name" <?= ($_POST['inputParameter1'] ?? '') == "last_name" ? "selected" : "" ?>>Last Name</option>
                <option value="preferred_name" <?= ($_POST['inputParameter1'] ?? '') == "preferred_name" ? "selected" : "" ?>>Preferred Name</option>
                <option value="group_id" <?= ($_POST['inputParameter1'] ?? '') == "group_id" ? "selected" : "" ?>>Group ID</option>
                <option value="city" <?= ($_POST['inputParameter1'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="zip" <?= ($_POST['inputParameter1'] ?? '') == "zip" ? "selected" : "" ?>>Zip Code</option>
                <option value="email" <?= ($_POST['inputParameter1'] ?? '') == "email" ? "selected" : "" ?>>Email</option>
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
                <option value="first_name" <?= ($_POST['inputParameter2'] ?? '') == "first_name" ? "selected" : "" ?>>First Name</option>
                <option value="last_name" <?= ($_POST['inputParameter2'] ?? '') == "last_name" ? "selected" : "" ?>>Last Name</option>
                <option value="preferred_name" <?= ($_POST['inputParameter2'] ?? '') == "preferred_name" ? "selected" : "" ?>>Preferred Name</option>
                <option value="group_id" <?= ($_POST['inputParameter2'] ?? '') == "group_id" ? "selected" : "" ?>>Group ID</option>
                <option value="city" <?= ($_POST['inputParameter2'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="zip" <?= ($_POST['inputParameter2'] ?? '') == "zip" ? "selected" : "" ?>>Zip Code</option>
                <option value="email" <?= ($_POST['inputParameter2'] ?? '') == "email" ? "selected" : "" ?>>Email</option>
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
                <option value="first_name" <?= ($_POST['inputParameter3'] ?? '') == "first_name" ? "selected" : "" ?>>First Name</option>
                <option value="last_name" <?= ($_POST['inputParameter3'] ?? '') == "last_name" ? "selected" : "" ?>>Last Name</option>
                <option value="preferred_name" <?= ($_POST['inputParameter3'] ?? '') == "preferred_name" ? "selected" : "" ?>>Preferred Name</option>
                <option value="group_id" <?= ($_POST['inputParameter3'] ?? '') == "group_id" ? "selected" : "" ?>>Group ID</option>
                <option value="city" <?= ($_POST['inputParameter3'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="zip" <?= ($_POST['inputParameter3'] ?? '') == "zip" ? "selected" : "" ?>>Zip Code</option>
                <option value="email" <?= ($_POST['inputParameter3'] ?? '') == "email" ? "selected" : "" ?>>Email</option>
                <option value="phone_primary" <?= ($_POST['inputParameter3'] ?? '') == "phone_primary" ? "selected" : "" ?>>Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue3" value="<?= $_POST['inputValue3'] ?? '';?>" aria-describedby="helpValue3" id="inputValue3">
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close3"></button>
            </div>
          </div>
          <div id="helpValue3" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query4">
          <div class="col-md-3 text-md-end">
            <label for="inputValue4" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter4" id="inputParameter4">
                <option hidden value="">Select One</option>
                <option value="first_name" <?= ($_POST['inputParameter4'] ?? '') == "first_name" ? "selected" : "" ?>>First Name</option>
                <option value="last_name" <?= ($_POST['inputParameter4'] ?? '') == "last_name" ? "selected" : "" ?>>Last Name</option>
                <option value="preferred_name" <?= ($_POST['inputParameter4'] ?? '') == "preferred_name" ? "selected" : "" ?>>Preferred Name</option>
                <option value="group_id" <?= ($_POST['inputParameter4'] ?? '') == "group_id" ? "selected" : "" ?>>Group ID</option>
                <option value="city" <?= ($_POST['inputParameter4'] ?? '') == "city" ? "selected" : "" ?>>City</option>
                <option value="zip" <?= ($_POST['inputParameter4'] ?? '') == "zip" ? "selected" : "" ?>>Zip Code</option>
                <option value="email" <?= ($_POST['inputParameter4'] ?? '') == "email" ? "selected" : "" ?>>Email</option>
                <option value="phone_primary" <?= ($_POST['inputParameter4'] ?? '') == "phone_primary" ? "selected" : "" ?>>Phone Number</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue4" value="<?= $_POST['inputValue4'] ?? '';?>" aria-describedby="helpValue4" id="inputValue4">
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close4"></button>
            </div>
          </div>
          <div id="helpValue4" class="form-text offset-md-3">Maximum of 32 Characters</div>
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

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Search For Users</button>
      </div>
    </div>
  </form>

  <?php if (isset($users)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Search Results</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>User Search Results</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Access</th>
              <th>First&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($user->id) ?></td>
              <td><?= h($user->email) ?></td>
              <td><?= h($user->access_abv) ?></td>
              <td><?= h($user->first_name) ?></td>
              <td><?= h($user->last_name) ?></td>
              <td><?= h($user->city) ?></td>
              <td><?= h($user->state_abv) ?></td>
              <td><?= format_phone(h($user->phone_p_country), h($user->phone_primary)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . u($user->id)); ?>">View</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/users/edit.php?id=' . u($user->id)); ?>">Edit</a></li>
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/users/delete.php?id=' . u($user->id)); ?>">Delete</a></li>
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

<?php 
if($search->error_array != []){ 
  $error_render=$search->error_array;
}
$scripts[] = "js/extra_param.js";
include(SHARED_PATH . '/user-footer.php'); 
?>