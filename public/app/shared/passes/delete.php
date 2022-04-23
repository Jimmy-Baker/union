<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Delete Pass: ' . h($pass->id());
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

include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Delete pass
  $result = $pass->delete();
  if($result === true) {
    $session->message('The user was deleted successfully.', 'success');
    redirect_to(url_for('/app/shared/passes/passes.php'));
  } else {
    $session->message('The pass deletion failed. Please try again.', 'warning');
  }
} else {
  // Display form
}

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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>"><?= $pass->full_name(); ?></a></li>
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
            <dt class="col-sm-3">First Name</dt>
            <dd class="col-sm-9"><?= h($pass->first_name); ?></dd>
            <dt class="col-sm-3">Middle Name</dt>
            <dd class="col-sm-9"><?= h($pass->middle_name); ?></dd>
            <dt class="col-sm-3">Last Name</dt>
            <dd class="col-sm-9"><?= h($pass->last_name); ?></dd>
            <dt class="col-sm-3">Preferred Name</dt>
            <dd class="col-sm-9"><?= h($pass->preferred_name); ?></dd>
            <dt class="col-sm-3">Birth Date</dt>
            <dd class="col-sm-9"><?= h(format_date($user->birth_date, "-")); ?></dd>
            <dt class="col-sm-3">Group ID</dt>
            <dd class="col-sm-9"><?= h($user->group_id); ?></dd>
            <dt class="col-sm-3">Address</dt>
            <dd class="col-sm-9"><?= h(format_address($user->street_address, $user->city, $user->state_abv, $user->zip, $user->country_abv)); ?></dd>
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><?= h($user->email); ?></dd>
            <dt class="col-sm-3">Primary Phone</dt>
            <dd class="col-sm-9"><?= h(format_phone($user->phone_p_country, $user->phone_primary)); ?></dd>
          </dl>
        </div>
      </div>
    </fieldset>
    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/passes/view.php?id=' . $user->id); ?>">Cancel Deletion</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-danger">Confirm Deletion</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
