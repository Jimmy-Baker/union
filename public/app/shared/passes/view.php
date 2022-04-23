<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
$id = $_GET['id'];
$pass = Pass::find_by_id($id);
$punches = PassItem::find_by_pass($id);
if($pass == false) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}

$page_title = 'Pass: ' . h($pass->id);
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Pass Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/passes.php'); ?>">Passes</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?= $pass->id ?></li>
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
    <div class="card-header fs-4"><?= h($pass->pass_type()); ?></div>
    <div class="card-body">
      <div class="row">
        <h1 class="card-title">#<?= h($pass->id); ?></h1>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 order-lg-last d-grid d-lg-block">
        </div>
        <div class="col-lg-8 order-lg-first">
          <div class="card-text">
            <dl class="row">
              <dt class="col-sm-4 text-sm-end">User ID</dt>
              <dd class="col-sm-8"><?= d($pass->user_id); ?></dd>
              <dt class="col-sm-4 text-sm-end">Active</dt>
              <dd class="col-sm-8"><?= d($pass->is_active); ?></dd>
              <dt class="col-sm-4 text-sm-end">Pass Type</dt>
              <dd class="col-sm-8"><?= d($pass->pass_type); ?></dd>
              <dt class="col-sm-4 text-sm-end">Created</dt>
              <dd class="col-sm-8"><?= d($pass->created_at); ?></dd>
              <dt class="col-sm-4 text-sm-end">Active On</dt>
              <dd class="col-sm-8"><?= d($pass->active_on); ?></dd>
              <dt class="col-sm-4 text-sm-end">Expires On</dt>
              <dd class="col-sm-8"><?= d($pass->expires_on); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow col-md-10 mx-auto mb-4">
    <div class="card-header fs-4"><?= h($pass->pass_type()); ?></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of visits</caption>
          <thead class="table-primary">
            <tr>
              <th>Gym ID</th>
              <th>Assigned</th>
              <th>Used</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($punches as $punch) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($punch->gym_id) ?></td>
              <td><?= h($punch->assigned) ?></td>
              <td><?= h($punch->used) ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Pass toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/passes/edit.php?id='. h(u($pass->id))); ?>">Edit This Pass</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/passes/delete.php?id='. h(u($pass->id))); ?>">Delete This Pass</a>
    </div>
  </div>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
