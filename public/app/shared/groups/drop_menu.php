<?php
// prevent this code from being loaded directly
if(!defined('drop_menu')) {
  redirect_to(url_for('/staff/locations/locations.php'));
}
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="groupMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Group Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="groupMenuLink">
    <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/groups.php'); ?>">All Groups</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/new.php'); ?>">New Group</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/search.php'); ?>">Find Groups</a></li>
    <?php if(isset($group->id)) { ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Group ID: <?= $group->id ?></h4>
    </li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/view.php?id=' . $group->id); ?>">View Group</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Edit Group</a></li>
    <li><a class="dropdown-item active" href="<?= url_for('app/shared/groups/edit.php?id=' . $group->id); ?>">Delete Group</a></li>
    <?php } ?>
  </ul>
</div>