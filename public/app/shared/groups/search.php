<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Find Groups';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $sql = "SELECT * FROM groups WHERE ";
  if (isset($_POST['inputValue1'])) {
    $sql .= $_POST['inputParameter1'] . " = '" . $_POST['inputValue1'] . "'";
  };
  if (isset($_POST['inputValue2'])) {
    $sql .= "AND " . $_POST['inputParameter2'] . " = '" . $_POST['inputValue2'] . "'";
  };
  
  $groups = Group::find_by_sql($sql);
} else {

}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Find Groups</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item active" aria-current="page">Find Groups</a></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="groupMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Group Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="groupMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/groups.php'); ?>">All Groups</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/new.php'); ?>">New Group</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/groups/search.php#results'); ?>" method="POST" class="mb-5">
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
                <option value="leader_id">Leader ID</option>
                <option value="type_abv">Group Type</option>
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

    <div class="row justify-content-evenly" role="toolbar" aria-label="Group toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Search For Groups</button>
      </div>
    </div>
  </form>

  <?php if (isset($groups)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Search Results</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>Group Search Results</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Leader ID</th>
              <th>Group Type</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($groups as $group) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($group->id) ?></td>
              <td><?= h($group->leader_id) ?></td>
              <td><?= h($group->type_abv) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="group actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/groups/view.php?id=' . h(u($group->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/groups/edit.php?id=' . h(u($group->id))); ?>">Edit</a>
                  <a class="btn btn-danger" href="<?= url_for('/app/shared/groups/delete.php?id=' . h(u($group->id))); ?>">Delete</a>
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
