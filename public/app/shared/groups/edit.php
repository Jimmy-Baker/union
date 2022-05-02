<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}
$id = $_GET['id'];
$group = Group::find_by_id($id);
if($group == false) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
}

if(($session->access_abv != 'AA') && !Group::test_group_user_role($id, $session->user_id, 'GA')){
  $session->message('You do not have permission to edit this group.', 'warning');
  redirect_to(url_for('/app/shared/groups/view.php?id='. u($id)));
}

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  $args = $_POST['group'];
  $group->merge_attributes($args);
  $result = $group->save();
  if($result === true) {
    $session->message('The group was updated successfully.', 'success');
    redirect_to(url_for('/app/shared/groups/view.php?id=' . u($id)));
  } else {
    $session->message('The group update failed. Please evaluate your input and try again.', 'warning');
  }
} 

$page_title = 'Edit Group: ' . h($group->name);
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
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/groups/groups.php'); ?>">Groups</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/groups/view.php?id=' . u($group->id)); ?>"><?= $group->id; ?></a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Edit Group</li>
        </ol>
      </nav>
      <?php
        include_once('drop_menu.php');
      ?>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/groups/edit.php?id=' . u($id)); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <a class="btn shadow btn-outline-primary" href="<?= url_for('app/shared/groups/view.php?id=' . u($group->id)); ?>">Cancel Edits</a>
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>
</main>

<?php
if($group->error_array != []){ 
  $error_render=$group->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>