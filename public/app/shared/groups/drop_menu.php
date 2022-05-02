<?php
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/groups/groups.php'));
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="groupMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Group Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="groupMenuLink">
    <li><a class="dropdown-item<?= active_class('groups') ?>" href="<?= url_for('app/shared/groups/groups.php'); ?>">All Groups</a></li>
    <li><a class="dropdown-item<?= active_class('new') ?>" href="<?= url_for('app/shared/groups/new.php'); ?>">New Group</a></li>
    <li><a class="dropdown-item<?= active_class('search') ?>" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a></li>
    <?php if(isset($group->id)) { ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Group ID: <?= h($group->id) ?></h4>
    </li>
    <li><a class="dropdown-item<?= active_class('view') ?>" href="<?= url_for('app/shared/groups/view.php?id=' . u($group->id)); ?>">View Group</a></li>
    <li><a class="dropdown-item<?= active_class('edit') ?>" href="<?= url_for('app/shared/groups/edit.php?id=' . u($group->id)); ?>">Edit Group</a></li>
    <li><a class="dropdown-item<?= active_class('delete') ?>" href="<?= url_for('app/shared/groups/delete.php?id=' . u($group->id)); ?>">Delete Group</a></li>
    <?php } ?>
  </ul>
</div>
