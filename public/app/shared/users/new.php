<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message('The user was created successfully.', 'success');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $new_id));
  } else {
    $session->message('User creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $user = new User;
}

$page_title = 'New User';
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">New User</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <form action="<?= url_for('/app/shared/users/new.php'); ?>" method="post" class="needs-validation" novalidate>

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create User</button>
  </form>

</main>

<?php
if($user->error_array != []){ 
  $error_render=$user->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>