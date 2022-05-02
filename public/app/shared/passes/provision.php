<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

$pass_types = PASS::PASS_TYPES;
$gyms = Gym::find_all();

/** 
 * Create a database record upon request
 */
if(is_post_request()) {
  switch ($_POST['inputParameter1']) {
    case "id":
      $user = User::find_by_id($_POST['inputValue1']);
      break;
    case "email":
      $user = User::find_by_email($_POST['inputValue1']);
      break;
  }
  if($user){
    $args = $_POST['pass'];
    $args['user_id'] = $user->id;
    $args['is_active'] = '0';
    $pass = new Pass($args);
    $result = $pass->save();
    if($result) {
      $pro = $pass->provision();
      if($pro) {
        $deactivate = $pass->deactive_others();
        $activate = $pass->activate();
        if($activate && $deactivate){
          $session->message("Pass provisioned successfully.", "primary");
          redirect_to(url_for('/app/shared/passes/view.php?id=' . u($pass->id)));
        } else {
          $session->message("The pass could not be activated.", "warning");
          $pass->delete();
        }
      } else {
        $session->message("The pass could not be provisioned.", "warning");
        $pass->delete();
      }  
    } else {
      $session->message("The pass could not be created.", "warning");
    }
  } else {
    // user sql query failed
    $session->message("That user could not be found", "warning");
  }
}

$page_title = 'Provision A Pass';
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-light text-primary">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/passes.php'); ?>">Passes</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Pass Provision</a></li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/passes/provision.php'); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">User Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" value="<?= $_POST['inputParameter1'] ?? '';?>" required>
                <option value="id">User ID</option>
                <option value="email">Email</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" required>
            </div>
          </div>
          <div id="helpValue1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>
      </div>

    </fieldset>

    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">User Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputPassType" class="col-form-label">Pass Type</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0">
              <select class="form-select" aria-label="Select pass type." name="pass[pass_type]" id="inputPassType" required>
                <?php foreach ($pass_types as $abv=>$name) { 
                  if($abv != 'A' && $abv != 'B' && $abv != 'C') {?>
                <option value="<?= $abv ?>"><?= $name ?></option>
                <?php }} ?>
              </select>
            </div>
          </div>
          <div id="helpPassType" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>
      </div>

    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Provision Pass</button>
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
              <th>Access</th>
              <th>Name</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($user->id) ?></td>
              <td><?= h($user->access_abv) ?></td>
              <td><?= h($user->name()) . ' ' . h($user->last_name) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . u($user->id)); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . u($user->id)); ?>">Edit</a>
                  <a class="btn btn-danger" href="<?= url_for('/app/shared/users/delete.php?id=' . u($user->id)); ?>">Delete</a>
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