<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

/** 
 * Create a database record upon request
 */
if(is_post_request()) {
  $args = $_POST['group'];
  $group = new Group($args);
  $result = $group->save();

  if($result === true) {
    $new_id = $group->id;
    $session->message('The group was created successfully.', 'success');
    redirect_to(url_for('/app/shared/groups/view.php?id=' . u($new_id)));
  } else {
    $session->message('Group creation failed. Please evaluate your input and try again.', 'warning');
  }
} else {
  $group = new Group;
}

$page_title = 'New Group';
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
          <li class="breadcrumb-item active text-primary" aria-current="page">New Group</li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="groupMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Group Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="groupMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/groups.php'); ?>">All Groups</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/groups/new.php'); ?>">New Group</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">

  <form action="<?= url_for('/app/shared/groups/new.php'); ?>" method="post">

    <?php include('form_fields.php'); ?>

    <button type="submit" name="submit" class="btn shadow btn-primary">Create Group</button>
  </form>

</main>

<?php
if($group->error_array != []){ 
  $error_render=$group->error_array;
}
include(SHARED_PATH . '/user-footer.php'); 
?>
