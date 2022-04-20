<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Passes';
include(SHARED_PATH . '/user-header.php'); 
?>

<?php
$passes = Pass::find_all();
$expireds = Pass::find_expired();
$actives = Pass::find_active();

?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Manage Passes</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Passes</a></li>
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
          <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All Passes</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="false">Active Passes</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-expired-tab" data-bs-toggle="pill" data-bs-target="#pills-expired" type="button" role="tab" aria-controls="pills-expired" aria-selected="false">Expired Passes</button>
        </li>
      </ul>
    </div>
    <div class="card-body">

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all passes</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>User&nbsp;ID</th>
                  <th>Active</th>
                  <th>Pass&nbsp;Type</th>
                  <th>Created</th>
                  <th>Active On</th>
                  <th>Expires On</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($passes as $pass) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($pass->id) ?></td>
                  <td><a href="<?= url_for('/app/shared/users/view.php?id=' . h(u($pass->user_id))); ?>"><?= h($pass->user_id) ?></a></td>
                  <td><?= h($pass->is_active) ?></td>
                  <td><?= h($pass->pass_type) ?></td>
                  <td><?= h($pass->created_at) ?></td>
                  <td><?= h($pass->active_on) ?></td>
                  <td><?= h($pass->expires_on) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="pass actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/passes/view.php?id=' . h(u($pass->id))); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/edit.php?id=' . h(u($pass->id))); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/delete.php?id=' . h(u($pass->id))); ?>">Delete</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all active passes</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>User&nbsp;ID</th>
                  <th>Active</th>
                  <th>Pass&nbsp;Type</th>
                  <th>Created</th>
                  <th>Active On</th>
                  <th>Expires On</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($actives as $active) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($active->id) ?></td>
                  <td><a href="<?= url_for('/app/shared/users/view.php?id=' . h(u($active->user_id))); ?>"><?= h($active->user_id) ?></a></td>
                  <td><?= h($active->is_active) ?></td>
                  <td><?= h($active->pass_type) ?></td>
                  <td><?= h($active->created_at) ?></td>
                  <td><?= h($active->active_on) ?></td>
                  <td><?= h($active->expires_on) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="pass actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/passes/view.php?id=' . h(u($active->id))); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/edit.php?id=' . h(u($active->id))); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/delete.php?id=' . h(u($active->id))); ?>">Delete</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-expired" role="tabpanel" aria-labelledby="pills-expired-tab">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <caption>List of all gym expired passes</caption>
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>User&nbsp;ID</th>
                  <th>Active</th>
                  <th>Pass&nbsp;Type</th>
                  <th>Created</th>
                  <th>Active On</th>
                  <th>Expires On</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($expireds as $expired) { ?>
                <tr class="align-middle text-nowrap">
                  <td><?= h($expired->id) ?></td>
                  <td><a href="<?= url_for('/app/shared/users/view.php?id=' . h(u($expired->user_id))); ?>"><?= h($expired->user_id) ?></a></td>
                  <td><?= h($expired->is_active) ?></td>
                  <td><?= h($expired->pass_type) ?></td>
                  <td><?= h($expired->created_at) ?></td>
                  <td><?= h($expired->active_on) ?></td>
                  <td><?= h($expired->expires_on) ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="pass actions">
                      <a class="btn btn-primary" href="<?= url_for('/app/shared/passes/view.php?id=' . h(u($expired->id))); ?>">View</a>
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                      <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/edit.php?id=' . h(u($expired->id))); ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="<?= url_for('/app/shared/passes/delete.php?id=' . h(u($expired->id))); ?>">Delete</a></li>
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
  <div class="row justify-content-evenly" role="toolbar" aria-label="Pass toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/passes/search.php'); ?>">Find Passes</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/passes/new.php'); ?>">Create A Pass</a>
    </div>
  </div>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>