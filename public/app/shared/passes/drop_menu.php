<?php
// prevent this code from being loaded directly
// if(!defined('drop_menu')) {
//   redirect_to(url_for('/staff/locations/locations.php'));
// }
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/passes/passes.php'));

?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="locationMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Pass Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="locationMenuLink">
    <li><a class="dropdown-item active" href="<?= url_for('app/shared/locations/locations.php'); ?>">All Locations</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/new.php'); ?>">New Location</a></li>
    <li><a class="dropdown-item" href="<?= url_for('app/shared/locations/search.php'); ?>">Find Locations</a></li>
  </ul>
</div>
