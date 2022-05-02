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

if(!test_access('GS')){
  $session->message('You do not have permission to modify a pass.', 'warning');
  redirect_to(url_for('/app/shared/passes/view.php?id=' . u($id)));
} 

/** 
 * Modify a database record upon request
 */
if(is_post_request()) {
  $args = $_POST['pass'];
  $pass->merge_attributes($args);
  $result = $pass->save();

  if($result === true) {
    $session->message('The pass was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/passes/view.php?id=' . $id));
  } else {
    $session->message('The pass update failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  //display the form
}

$page_title = 'Edit Pass: ' . h($pass->id);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/view.php?id=' . u($pass->id)); ?>"><?= $pass->id; ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Edit Pass</li>
        </ol>
      </nav>
      <?php 
        define('exists', true);
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($pass->error_array); ?>
  <form action="<?= url_for('/app/shared/passes/edit.php?id=' . u($id)); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/passes/view.php?id=' . u($pass->id)); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php
if($pass->error_array != []){ 
  $error_render=$pass->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>