<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/passes/passes.php'));
}
$id = $_GET['id'];
$pass = Pass::find_by_id($id);
if($pass == false) {
  redirect_to(url_for('/app/shared/passes/passes.php'));
}

$page_title = 'Edit Pass: ' . h($pass->id);
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['pass'];
  $pass->merge_attributes($args);
  $result = $pass->save();

  if($result === true) {
    $session->message('The pass was updated successfully.');
    redirect_to(url_for('/app/shared/passes/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Edit Pass Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/passes/passes.php'); ?>">Passes</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>"><?= $pass->id; ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Pass</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="passMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Pass Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="passMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/passes.php'); ?>">All Passes</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/new.php'); ?>">New Pass</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/search.php'); ?>">Find Passes</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Pass ID: <?= $pass->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>">View Pass</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/passes/edit.php?id=' . $pass->id); ?>">Edit Pass</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/passes/delete.php?id=' . $pass->id); ?>">Delete Pass</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($pass->error_array); ?>
  <form action="<?= url_for('/app/shared/passes/edit.php?id=' . h(u($id))); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/passes/view.php?id=' . $pass->id); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>