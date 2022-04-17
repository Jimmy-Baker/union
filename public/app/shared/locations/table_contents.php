<thead class="table-primary">
  <tr>
    <th>ID</th>
    <th>Gym ID</th>
    <th>Location Name</th>
    <th>City</th>
    <th>State</th>
    <th>Phone</th>
    <th>&nbsp;</th>
  </tr>
</thead>
<tbody>
  <?php foreach($locations as $location) { ?>
  <tr class="align-middle text-nowrap">
    <td><?= h($location->id) ?></td>
    <td><a href="<?= url_for('/app/shared/gyms/view.php?id=' . h(u($location->gym_id))); ?>"><?= h($location->gym_id) ?></a></td>
    <td><?= h($location->location_name) ?></td>
    <td><?= h($location->city) ?></td>
    <td><?= h($location->state_abv) ?></td>
    <td><a href="<?= 'tel:' . format_call(h($location->phone_p_country), h($location->phone_primary)) ?>"><?= format_phone(h($location->phone_p_country), h($location->phone_primary)) ?></a></td>
    <td>
      <div class="btn-group" role="group" aria-label="location actions">
        <a class="btn btn-primary" href="<?= url_for('/app/shared/locations/view.php?id=' . h(u($location->id))); ?>">View</a>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
          <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/edit.php?id=' . h(u($location->id))); ?>">Edit</a></li>
          <li><a class="dropdown-item" href="<?= url_for('/app/shared/locations/delete.php?id=' . h(u($location->id))); ?>">Delete</a></li>
        </ul>
      </div>
    </td>
  </tr>
  <?php } ?>
</tbody>