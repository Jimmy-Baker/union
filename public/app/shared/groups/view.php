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

$page_title = 'Group: ' . h($group->group_id);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Group Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $group->id ?></li>
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
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>">View Group</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Edit Group</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Delete Group</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class=" container-md p-4" id="main">
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Group</div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title"><?= h($group->id); ?><span class="card-subtitle text-muted"> (#<?= h($group->id); ?>)</span></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
          <img src="#" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $group->preferred_name ?>'s profile picture." height="200" width="200">
        </div>
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
  <div class="row justify-content-evenly" role="toolbar" aria-label="Group toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/groups/edit.php?id='. h(u($group->id))); ?>">Edit This Group</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/groups/delete.php?id='. h(u($group->id))); ?>">Delete This Group</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
