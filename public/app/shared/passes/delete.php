<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
$id = $_GET['id'];
$pass = Pass::find_by_id($id);
if($pass == false) {
  $session->message('No pass was identified.', 'warning');
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
 

if(is_post_request()) {
  // Delete pass line items
  PassItem::delete_all($pass->id);
  // Delete the pass
  $result = $pass->delete();
  if($result === true) {
    $session->message('The pass was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/passes/passes.php'));
  } else {
    $session->message('The pass deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
}

$page_title = 'Delete Pass: ' . h($pass->id);
include(SHARED_PATH . '/user-header.php');?>

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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>"><?= $pass->id; ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Delete Pass</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/passes/delete.php?id=' . h(u($id))); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Profile Information</legend>
      <div class="card-body">
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
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>