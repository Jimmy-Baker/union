<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No user was identified.', 'warning');
  redirect_to(url_for('/app/shared/users/users.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
  $session->message('No user was identified.', 'warning');
  redirect_to(url_for('/app/shared/users/users.php'));
}

if(is_post_request()) {  
  // Save record using post parameters
  $args = $_POST['user'];
  // if image uploaded, process and update avatarURL
  if($_POST['image1']) {

    $file = new Bulletproof\Image($_FILES);
    
    if ($file["image1"]){
      $file->setName($user->id . '-profile');
      $file->setSize(8, 2097152);
      $file->setMime(array('jpeg', 'jpg', 'png'));
      $file->setLocation($_SERVER['DOCUMENT_ROOT'] . '/public/upload/profile');
      
      $upload = $file->upload();
      if($upload) {
        $args['avatar_url'] = $upload->getFullPath();
        if($upload->getWidth() >= $upload->getHeight()){
          $idealHeight = 200;
          $idealWidth = (200/$upload->getHeight()) * $upload->getWidth();
        } else {
          $idealWidth = 200;
          $idealHeight = (200/$upload->getWidth()) * $upload->getHeight();
        }
        $resize = bulletproof\utils\resize(
          $upload->getFullPath(), 
          $upload->getMime(),
          $upload->getWidth(),
          $upload->getHeight(),
          $idealWidth,
          $idealHeight,
          true
        );
        $crop = bulletproof\utils\crop(
          $upload->getFullPath(), 
          $upload->getMime(),
          $upload->getWidth(),
          $upload->getHeight(),
          200,
          200
        );
      } else {
        $session->message('Image could not be uploaded', 'warning');
      }
    }
    
  };
  
  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $session->message('The user was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/users/view.php?id=' . $id));
  } else {
    echo $result;
  }
} else {
  //display the form
}

$page_title = 'Edit User: ' . h($user->full_name());
include(SHARED_PATH . '/user-header.php'); 

?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1>Edit User Information</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/users.php'); ?>">Users</a></li>
          <li class="breadcrumb-item"><a href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>"><?= $user->full_name(); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          User Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="userMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/search.php'); ?>">Find Users</a></li>
          <li>
            <hr class="drowndown-divider my-2">
          </li>
          <li>
            <h4 class="dropdown-header fs-6 text-dark">User ID: <?= $user->id ?></h4>
          </li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>">View User</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Edit User</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/users/edit.php?id=' . $user->id); ?>">Delete User</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <?= display_errors($user->error_array); ?>
  <form action="<?= url_for('/app/shared/users/edit.php?id=' . h(u($id))); ?>" method="post" enctype="multipart/form-data">

    <?php define('exists', true); ?>
    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/users/view.php?id=' . $user->id); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
