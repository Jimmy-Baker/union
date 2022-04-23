<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'New Gym';
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['gym'];
  $gym = new Gym($args);
  $result = $gym->save();

  if($result === true) {
    $new_id = $gym->id;
    $session->message('The gym was created successfully.', 'success');
    redirect_to(url_for('/app/shared/gyms/view.php?id=' . $new_id));
  } else {
    $session->message('Gym creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $gym = new Gym;
}
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>New Gym Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">Gyms</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">New Gym</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($gym->error_array); ?>
  <form action="<?= url_for('/app/shared/gyms/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create Gym</button>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
