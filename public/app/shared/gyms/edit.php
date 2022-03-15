<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}
$id = $_GET['id'];
$gym = Gym::find_by_id($id);
if($gym == false) {
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
}

$page_title = 'Edit Gym: ' . h($gym->gym_name);
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['gym'];
  $gym->merge_attributes($args);
  $result = $gym->save();

  if($result === true) {
    $session->message('The gym was updated successfully.');
    redirect_to(url_for('/app/shared/gyms/view.php?id=' . $id));
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
      <h1>Edit Gym Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/gyms/gyms.php'); ?>">Gyms</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>"><?= $gym->gym_name; ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Gym</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="gymMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Gym Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="gymMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">All Gyms</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/new.php'); ?>">New Gym</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">Gym ID: <?= $gym->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>">View Gym</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/gyms/edit.php?id=' . $gym->id); ?>">Edit Gym</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/edit.php?id=' . $gym->id); ?>">Delete Gym</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($gym->error_array); ?>
  <form action="<?= url_for('/app/shared/gyms/edit.php?id=' . h(u($id))); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>