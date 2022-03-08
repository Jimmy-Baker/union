<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Find Users';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $sql = "SELECT * FROM users WHERE ";
  if (isset($_POST['inputValue1'])) {
    $sql .= $_POST['inputParameter1'] . " = '" . $_POST['inputValue1'] . "'";
  };
  if (isset($_POST['inputValue2'])) {
    $sql .= "AND " . $_POST['inputParameter2'] . " = '" . $_POST['inputValue2'] . "'";
  };
  if (isset($_POST['inputValue3'])) {
    $sql .= "AND " . $_POST['inputParameter3'] . " = '" . $_POST['inputValue3'] . "'";
  };
  if (isset($_POST['inputValue4'])) {
    $sql .= "AND " . $_POST['inputParameter4'] . " = '" . $_POST['inputValue4'] . "'";
  };
  if (isset($_POST['inputValue5'])) {
    $sql .= "AND " . $_POST['inputParameter5'] . " = '" . $_POST['inputValue5'] . "'";
  };
  
  $users = User::find_by_sql($sql);
} else {

}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <h1>Find Users</h1>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">Find Users</a></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          User Options
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuLink">
          <li><a class="dropdown-item text-end" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
          <li><a class="dropdown-item text-end" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/users/search.php#results'); ?>" method="POST" class="mb-5">
    <fieldset class="card col-md-10 mx-auto mb-4">
      <legend class="card-header">Search Criteria</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParamater1'] ?? '';?>" required>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="preferred_name">Preferred Name</option>
                <option value="group_id">Group ID</option>
                <option value="city">City</option>
                <option value="zip">Zip Code</option>
                <option value="email">Email</option>
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

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn btn-primary" type="submit">Search For Users</button>
      </div>
    </div>
  </form>

  <?php if (isset($users)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card mx-auto mt-5" id="results">
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
              <th>Birth&nbsp;Date</th>
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
              <td><?= format_date(h($user->birth_date), "-") ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-danger" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
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