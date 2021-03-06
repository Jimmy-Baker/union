<?php
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/events/events.php'));
?>

<div class="col-auto d-none d-sm-block">
  <a class="btn btn-primary btn-raise dropdown-toggle" href="#" role="button" id="eventMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Event Menu
  </a>
  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="eventMenuLink">
    <?php if(test_access('GS')){ ?>
    <li><a class="dropdown-item<?= active_class('events') ?>" href="<?= url_for('app/shared/events/events.php'); ?>">All Events</a></li>
    <?php } ?>
    <?php if(Permission::test_location_user_permission($session->location, $session->user_id, 'XE') || $session->access_abv == 'AA'){ ?>
    <li><a class="dropdown-item<?= active_class('new') ?>" href="<?= url_for('app/shared/events/new.php'); ?>">New Event</a></li>
    <?php } ?>
    <?php if(test_access('GS')){ ?>
    <li><a class="dropdown-item<?= active_class('search') ?>" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a></li>
    <?php } ?>
    <?php if(isset($event->id)){ ?>
    <li>
      <hr class="drowndown-divider my-2">
    </li>
    <li>
      <h4 class="dropdown-header fs-6 text-dark">Event ID: <?= h($event->id) ?></h4>
    </li>
    <?php if(test_access('GS')){ ?>
    <li><a class="dropdown-item<?= active_class('view') ?>" href="<?= url_for('app/shared/events/view.php?id=' . u($event->id)); ?>">View Event</a></li>
    <?php } ?>
    <?php if(Permission::test_location_user_permission($event->location_id, $session->user_id, 'XE') || $session->access_abv == 'AA'){ ?>
    <li><a class="dropdown-item<?= active_class('edit') ?>" href="<?= url_for('app/shared/events/edit.php?id=' . u($event->id)); ?>">Edit Event</a></li>
    <?php } ?>
    <?php if(Permission::test_location_user_permission($event->location_id, $session->user_id, 'XE') || $session->access_abv == 'AA'){ ?>
    <li><a class="dropdown-item<?= active_class('delete') ?>" href="<?= url_for('app/shared/events/delete.php?id=' . u($event->id)); ?>">Delete Event</a></li>
    <?php } ?>
    <?php } ?>
  </ul>
</div>
