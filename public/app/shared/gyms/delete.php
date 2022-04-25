<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No gym was identified.', 'warning');
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}
$id = $_GET['id'];
$gym = Gym::find_by_id($id);
if($gym == false) {
  $session->message('No gym was identified.', 'warning');
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}

if(is_post_request()) {
  // Delete gym
  $result = $gym->delete();
  if($result === true) {
    $session->message('The gym was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/gyms/gyms.php'));
  } else {
    $session->message('The gym deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
}

$page_title = 'Delete Gym: ' . h($gym->gym_name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">Gyms</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/gyms/view.php?id=' . u($gym->id)); ?>"><?= h($gym->gym_name); ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Delete Gym</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/gyms/delete.php?id=' . u($id)); ?>" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Gym Information</legend>
      <div class="card-body">
        <div class="card-text">
          <dl class="row">
            <dt class="col-sm-3">Gym Name</dt>
            <dd class="col-sm-9"><?= h($gym->gym_name); ?></dd>
            <dt class="col-sm-3">Website</dt>
            <dd class="col-sm-9"><?= h($gym->website); ?></dd>
          </dl>
        </div>
      </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/gyms/view.php?id=' . u($gym->id)); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>