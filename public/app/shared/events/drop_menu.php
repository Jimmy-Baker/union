<?php
// prevent this code from being loaded directly
// if(!defined('drop_menu')) {
//   redirect_to(url_for('/staff/events/events.php'));
// }
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/events/events.php'));

?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="eventMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Event Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="eventMenuLink">
    <li><a class="dropdown-item<?= active_class('events') ?>" href="<?= url_for('app/shared/events/events.php'); ?>">All Events</a></li>
    <li><a class="dropdown-item<?= active_class('new') ?>" href="<?= url_for('app/shared/events/new.php'); ?>">New Event</a></li>
    <li><a class="dropdown-item<?= active_class('search') ?>" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a></li>
    <?php if(isset($event->id)){ ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Event ID: <?= $event->id ?></h4>
    </li>
    <li><a class="dropdown-item<?= active_class('view') ?>" href="<?= url_for('app/shared/events/view.php?id=' . $event->id); ?>">View Event</a></li>
    <li><a class="dropdown-item<?= active_class('edit') ?>" href="<?= url_for('app/shared/events/edit.php?id=' . $event->id); ?>">Edit Event</a></li>
    <li><a class="dropdown-item<?= active_class('delete') ?>" href="<?= url_for('app/shared/events/delete.php?id=' . $event->id); ?>">Delete Event</a></li>
    <?php } ?>
  </ul>
</div>