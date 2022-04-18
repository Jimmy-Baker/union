<?php
// prevent this code from being loaded directly
if(!defined('drop_menu')) {
  header("Location: " . __DIR__ . '/public/app/shared/locations/locations.php');
}
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Location Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
    <?php if(isset($location)) { ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Location ID: <?= $location->id ?></h4>
    </li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/view.php?id=' . $location->id); ?>">View Location</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Edit Location</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/edit.php?id=' . $location->id); ?>">Delete Location</a></li>
    <?php } ?>
  </ul>
</div>
