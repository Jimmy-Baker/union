<?php
// prevent this code from being loaded directly
// if(!defined('drop_menu')) {
//   header("Location: " . __DIR__ . '/public/app/shared/locations/locations.php');
// }
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/locations/locations.php'));

?>

<div class="col-12 col-md-auto d-flex d-md-block">
  <a class="btn btn-primary btn-raise dropdown-toggle drop-menu" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    <span>Location Menu</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
    <li><a class="dropdown-item<?= active_class('locations') ?>" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
    <li><a class="dropdown-item<?= active_class('new') ?>" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
    <li><a class="dropdown-item<?= active_class('search') ?>" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
    <?php if(isset($location)) { ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Location ID: <?= $location->id ?></h4>
    </li>
    <li><a class="dropdown-item<?= active_class('attendance') ?>" href="<?= url_for('app/shared/locations/attendance.php') ?>">Attendance</a></li>
    <li><a class="dropdown-item<?= active_class('checkin') ?>" href="<?= url_for('app/shared/locations/checkin.php') ?>">Check In</a></li>
    <li><a class="dropdown-item<?= active_class('view') ?>" href="<?= url_for('app/shared/locations/view.php?id=' . u($location->id)); ?>">View Location</a></li>
    <li><a class="dropdown-item<?= active_class('edit') ?>" href="<?= url_for('app/shared/locations/edit.php?id=' . u($location->id)); ?>">Edit Location</a></li>
    <li><a class="dropdown-item<?= active_class('delete') ?>" href="<?= url_for('app/shared/locations/delete.php?id=' . u($location->id)); ?>">Delete Location</a></li>
    <?php } ?>
  </ul>
</div>