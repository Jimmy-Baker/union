<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
$id = $_GET['id'];

if(!test_access('GS') && $session->pass_id!=$id) {
  $session->message('You do not have permission to view this pass.', 'warning');
  redirect_to(url_for($session->dashboard()));
}

$pass = Pass::find_by_id($id);
$punches = PassItem::find_by_pass($id);
if($pass == false) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}

if(is_post_request()){
  if($punches && $_POST['id']){
    $gym_id = $_POST['id'];
    $punch = PassItem::find_by_pass_and_gym($id, $gym_id);
    if($_POST['method'] == 'redeem') {
      $result = $punch->redeem_punch();
      if($result){
        $session->message('The punch was redeemed sucessfully.', 'success');
        $punches = PassItem::find_by_pass($id);
      } else {
        $session->message('The punch could not be redeemed.', 'warning');
      }
    } elseif($_POST['method'] == 'remove') {
      $result = $punch->refund_punch();
      if($result){
        $session->message('The punch was refunded sucessfully.', 'success');
        $punches = PassItem::find_by_pass($id);
      } else {
        $session->message('The punch could not be removed.', 'warning');
      }
    } else {
      $session->message('Your request could not be completed. Please try again.', 'warning');
    }
  } else {
    $session->message('Your request could not be processed.', 'warning');
  }
}

$page_title = 'Pass: ' . h($pass->id);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/passes.php'); ?>">Passes</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page"><?= h($pass->id) ?></li>
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
              <dd class="col-sm-8"><?= d($pass->is_active()); ?></dd>
              <dt class="col-sm-4 text-sm-end">Pass Type</dt>
              <dd class="col-sm-8"><?= d($pass->pass_type()); ?></dd>
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
  <?php if($punches) { ?>
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
              <?php if(test_access('GS')){ ?>
              <th>&nbsp;</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($punches as $punch) { ?>
            <tr class="align-middle text-nowrap">
              <td><a href="<?= url_for('app/shared/gyms/view.php?id=' . u($punch->gym_id)) ?>"><?= h($punch->gym_id) ?></a></td>
              <td><?= h($punch->assigned) ?></td>
              <td><?= h($punch->used) ?></td>
              <?php if(test_access('GS')){ ?>
              <td>
                <form method="POST" action="<?= url_for('/app/shared/passes/view.php?id=' . $pass->id); ?>">
                  <input type="hidden" name="id" value="<?= h($punch->gym_id) ?>">
                  <div class="btn-group" role="group" aria-label="location actions">
                    <button class="btn btn-primary" type="submit" name="method" value="redeem">Redeem</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                    <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                      <li><button type="submit" class="dropdown-item no-js" name="method" value="remove">Remove Redemption</button></li>
                      <li><button class="dropdown-item yes-js" data-bs-toggle="modal" data-bs-target="#confirmModal" data-bs-id="<?=($participant->id) ?>">Remove Redemption</button></li>
                    </ul>
                  </div>
                </form>
              </td>
              <?php } ?>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php if(test_access('GS')){ ?>
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this redemption? The user will be refunded a punch.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="<?= url_for('/app/shared/passes/view.php?id=' . u($id)); ?>" method="POST">
            <input type="hidden" name="id" value="" id="confirmInput">
            <input type="hidden" name="method" value="remove">
            <button type="submit" class="btn btn-primary" id="confirmButton">Confirm Removal</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php if(test_access('GM')){ ?>
  <div class="row justify-content-evenly" role="toolbar" aria-label="Pass toolbar">
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-primary" href="<?= url_for('app/shared/passes/edit.php?id='. u($pass->id)); ?>">Edit This Pass</a>
    </div>
    <div class="col-sm-4 col-md-3 mb-3 d-grid">
      <a class="btn shadow btn-danger" href="<?= url_for('app/shared/passes/delete.php?id='. u($pass->id)); ?>">Delete This Pass</a>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>