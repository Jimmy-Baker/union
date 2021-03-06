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

if(!test_access('AA') && !(test_access('GM') && $session->gym_id==$id)){
  $session->message('You do not have permission to modify this gym.', 'warning');
  redirect_to(url_for('/app/shared/gyms/gyms.php'));
} 

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  $args = $_POST['gym'];
  if($_POST['image1']) {
    $url = imageUpload("image1", $gym, "gym");
    if($url) {
      $args['avatar_url'] = $url;
    } else {
      $session->message('The image could not be uploaded', 'warning');
    }
  }
  
  $gym->merge_attributes($args);
  $result = $gym->save();
  if($result === true) {
    $session->message('The gym was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/gyms/view.php?id=' . $id));
  } else {
    $session->message('The gym update failed. Please evaluate your input and try again.', 'warning');
  }
}

$page_title = 'Edit Gym: ' . h($gym->gym_name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>"><?= $gym->gym_name; ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Edit Gym</li>
        </ol>
      </nav>
      <?php 
        include_once('drop_menu.php'); 
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/gyms/edit.php?id=' . u($id)); ?>" method="post" enctype="multipart/form-data">

    <?php define('exists', true); ?>
    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/gyms/view.php?id=' . u($gym->id)); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php
if($gym->error_array != []){ 
  $error_render=$gym->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>
