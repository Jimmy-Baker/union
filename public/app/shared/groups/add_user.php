<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}

$id = $_GET['id'];
$group = Group::find_by_id($id);
if($group == false) {
  $session->message('No group could be identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
} 

if(is_post_request()) {
  if (isset($_POST['inputValue1'])) {
    $user = User::find_by_param($_POST['inputParameter1'], $_POST['inputValue1']);
    if ($user) {
      $role = $_POST['inputRoleAbv'];
      $result = $group->add_user($user->id, $role);
      if($result) {
        $session->message("The user was added successfully.", "success");
        redirect_to(url_for('/app/shared/groups/view.php?id=' . u($group->id)));
      } else {
        $session->message("That user could not be added.", "warning");
      }
    } else {
      $session->message("That user could not be found.", "warning");
    }
  } else {
    $session->message("A valid entry is required.", "warning");
  }
}

$page_title = 'Add User: ' . h($group->name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?= h($group->id) ?></li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Group Details</div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($group->name); ?><span class="card-subtitle text-muted"> (#<?= h($group->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">Leader ID</dt>
              <dd class="col-sm-8"><?= d($group->leader_id); ?></dd>
              <dt class="col-sm-4 text-sm-end">Group Type</dt>
              <dd class="col-sm-8"><?= d($group->type_abv); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form action="<?= url_for('/app/shared/groups/add_user.php?id=' . u($id)); ?>" method="POST" class="mb-5">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">User Information</legend>
      <div class="card-body">

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputParameter1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter selection for following text input" name="inputParameter1" required>
                <option value="id">User ID</option>
                <option value="email">Email</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" required>
            </div>
          </div>
          <div id="helpInputParameter1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputRoleAbv" class="col-form-label">Add As</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0">
              <select class="form-select" aria-label="Select role type." name="inputRoleAbv" id="inputRoleAbv" required>
                <option value="" hidden>Select One</option>
                <option value="GA">Administrator</option>
                <option value="GC">Member</option>
              </select>
            </div>
          </div>
          <div id="helpRoleAbv" class="form-text offset-md-3">Select One</div>
        </div>
      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="User toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Add User to Group</button>
      </div>
    </div>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>