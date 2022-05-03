<?php
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/users/users.php'));
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    User Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="userMenuLink">
    <?php if(test_access('GS')) { ?>
    <li><a class="dropdown-item<?= active_class('users') ?>" href="<?= url_for('app/shared/users/users.php'); ?>">All Users</a></li>
    <li><a class="dropdown-item<?= active_class('new') ?>" href="<?= url_for('app/shared/users/new.php'); ?>">New User</a></li>
    <li><a class="dropdown-item<?= active_class('search') ?>" href="<?= url_for('app/shared/users/search.php'); ?>">Find Users</a></li>
    <?php } ?>
    <?php if(isset($user->id)){ ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-light">User ID: <?= h($user->id) ?></h4>
    </li>
    <?php if(test_access('GS') || $id==$session->user_id) { ?>
    <li><a class="dropdown-item<?= active_class('view') ?>" href="<?= url_for('app/shared/users/view.php?id=' . u($user->id)); ?>">View User</a></li>
    <li><a class="dropdown-item<?= active_class('edit') ?>" href="<?= url_for('app/shared/users/edit.php?id=' . u($user->id)); ?>">Edit User</a></li>
    <?php } ?>
    <?php if(test_access('GM')){ ?>
    <li><a class="dropdown-item<?= active_class('delete') ?>" href="<?= url_for('app/shared/users/delete.php?id=' . u($user->id)); ?>">Delete User</a></li>
    <?php }} ?>
  </ul>
</div>