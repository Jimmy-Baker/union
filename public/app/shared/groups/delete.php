<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/groups/groups.php'));
}
$id = $_GET['id'];
$group = Group::find_by_id($id);
if($group == false) {
  redirect_to(url_for('/app/shared/groups/groups.php'));
}

$page_title = 'Delete Group: ' . h($group->full_name());
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {

  // Delete group
  $result = $group->delete();
  $session->message('The group was deleted successfully.');
  redirect_to(url_for('/app/shared/groups/groups.php'));

} else {
  // Display form
}

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['group'];
  $group->merge_attributes($args);
  $result = $group->save();

  if($result === true) {
    $session->message('The group was updated successfully.');
    redirect_to(url_for('/app/shared/groups/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Delete Group</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>"><?= $group->id; ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Delete Group</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="groupMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Group Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="groupMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/groups.php'); ?>">All Groups</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/new.php'); ?>">New Group</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Group ID: <?= $group->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>">View Group</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Edit Group</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Delete Group</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/groups/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Profile Information</legend>
      <div class="card-body">
        <div class="card-text">
          <dl class="row">
            <dt class="col-sm-3">Leader ID</dt>
            <dd class="col-sm-9"><?= h($group->leader_id); ?></dd>
            <dt class="col-sm-3">Group Type</dt>
            <dd class="col-sm-9"><?= h($group->type_abv); ?></dd>
          </dl>
        </div>
      </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
