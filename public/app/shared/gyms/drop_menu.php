<?php
// prevent this code from being loaded directly
if(!defined('drop_menu')) {
  redirect_to(url_for('/staff/locations/locations.php'));
}
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="gymMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Gym Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="gymMenuLink">
    <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/gyms.php'); ?>">All Gyms</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/new.php'); ?>">New Gym</a></li>
    <?php if(isset($gym->id)){ ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-light">Gym ID: <?= $gym->id ?></h4>
    </li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/view.php?id=' . $gym->id); ?>">View Gym</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/edit.php?id=' . $gym->id); ?>">Edit Gym</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/gyms/delete.php?id=' . $gym->id); ?>">Delete Gym</a></li>
    <?php } ?>
  </ul>
</div>