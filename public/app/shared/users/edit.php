<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/app/shared/users/users.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
  redirect_to(url_for('/app/shared/users/users.php'));
}

$page_title = 'Edit User: ' . h($user->full_name());
include(SHARED_PATH . '/user-header.php'); 

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['user'];
  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $session->message('The user was updated successfully.');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $id));
  } else {
    // show errors
  }
}

?>

<header>
  <div class="p-5 bg-dark text-light">
    <h1>Edit User Information</h1>
  </div>
  <div class="container-md p-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/view.php'); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
      </ol>
    </nav>
  </div>
</header>

<main class="container-md p-4" id="main">

  <?= display_errors($user->error_array); ?>
  <form action="<?= url_for('/app/shared/users/edit.php?id=' . h(u($id))); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn btn-primary">Submit Changes</button>
  </form>

</main>



</div>

</div>

<?php include(SHARED_PATH . '/user-footer.php'); ?>