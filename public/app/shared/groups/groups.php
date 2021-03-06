<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!test_access('GM')){
  $session->message('You do not have permission to view all groups.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

$groups = Group::find_all();
$my_groups = Group::find_all_by_member($session->user_id);

$page_title = 'Manage Groups';
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
          <li class="breadcrumb-item active text-primary" aria-current="page">Groups</a></li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <div class="card shadow mx-auto mb-4">
    <div class="card-header">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All Groups</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-my-tab" data-bs-toggle="pill" data-bs-target="#pills-my" type="button" role="tab" aria-controls="pills-my" aria-selected="false">My Groups</button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all groups</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>Leader ID</th>
                  <th>Type Abv</th>
                  <th>Name</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($groups as $group) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($group->id) ?></td>
                  <td><?= h($group->owner_id) ?></td>
                  <td><?= h($group->type_abv) ?></td>
                  <td><?= h($group->name) ?>
                  <td>
                    <div class="btn-group" role="group" aria-label="group actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/groups/view.php?id=' . u($group->id)); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/groups/edit.php?id=' . u($group->id)); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/groups/delete.php?id=' . u($group->id)); ?>">Delete</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="pills-my" role="tabpanel" aria-labelledby="pills-my-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all groups</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>Leader ID</th>
                  <th>Type Abv</th>
                  <th>Name</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($my_groups as $my_group) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($my_group->id) ?></td>
                  <td><?= h($my_group->owner_id) ?></td>
                  <td><?= h($my_group->type_abv) ?></td>
                  <td><?= h($my_group->name) ?>
                  <td>
                    <div class="btn-group" role="group" aria-label="group actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/groups/view.php?id=' . u($my_group->id)); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/groups/edit.php?id=' . u($my_group->id)); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/groups/delete.php?id=' . u($my_group->id)); ?>">Delete</a></li>
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
    </div>
  </div>
  <?php if(test_access('GM')){ ?>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Group toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/groups/new.php'); ?>">Create A Group</a>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>