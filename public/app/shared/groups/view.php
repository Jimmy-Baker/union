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
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}
$members = $group->group_members();

$page_title = 'Group: ' . h($group->name);
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

  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4">Group Members</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all groups</caption>
          <thead class="table-primary">
            <tr>
              <th>User ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Role</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($members as $member) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($member->user_id) ?></td>
              <td><?= h($member->first_name) ?></td>
              <td><?= h($member->last_name) ?></td>
              <td><?= h($member->role_abv) ?>
              <td>
                <div class="btn-group" role="group" aria-label="group actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/member/view.php?id=' . u($member->user_id)); ?>">View</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/groups/delete.php?id=' . u($group->id)); ?>">Remove</a></li>
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

  <div class="row justify-content-evenly" role="toolbar" aria-label="Group toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/groups/edit.php?id='. u($group->id)); ?>">Edit This Group</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/groups/delete.php?id='. u($group->id)); ?>">Delete This Group</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>