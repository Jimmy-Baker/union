<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['pass'];
  $pass = new Pass($args);
  $result = $pass->save();

  if($result === true) {
    $new_id = $pass->id;
    $pro = $pass->provision();
    $session->message('The pass was created successfully.', 'success');
    // redirect_to(url_for('/app/shared/passes/view.php?id=' . $new_id));
  } else {
    $session->message('Pass creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $pass = new Pass;
}

$page_title = 'New Pass';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/passes/passes.php'); ?>">Passess</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">New Pass</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($pass->error_array); ?>
  <form action="<?= url_for('/app/shared/passes/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create Pass</button>
  </form>

</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
