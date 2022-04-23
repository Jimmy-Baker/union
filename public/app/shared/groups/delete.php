<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Delete Group: ' . h($group->name);
require_login();

if(!isset($_GET['id'])) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}
$id = $_GET['id'];
$group = Group::find_by_id($id);
if($group == false) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}

if(is_post_request()) {
  // Delete location
  $result = $group->delete();
  if($result === true) {
    $session->message('The group was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/groups/groups.php'));
  } else {
    $session->message('The group deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
}

include(SHARED_PATH . '/user-header.php');
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Delete Group</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>"><?= $group->id; ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Delete Group</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/groups/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Group Information</legend>
      <div class="card-body">
        <div class="card-text">
          <div class="row">
            <h1 class="card-title"><?= h($group->name); ?><span class="card-subtitle text-muted"> (#<?= h($group->id); ?>)</span></h1>
          </div>
          <dl class="row mt-4">
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
