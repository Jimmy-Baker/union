<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();
$page_title = 'Users';
include(SHARED_PATH . '/user-header.php'); 
?>

<?php
$users = User::find_all();
$admins = User::find_by_access("AA");
$managers = User::find_by_access("GM");
$staff = User::find_by_access("GS");
$members = User::find_by_access("MM");

?>

<header class="p-5 bg-dark text-light">
  <h1>Manage Users</h1>
</header>

<main class="container-md p-4" id="main">

  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All Users</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-admin-tab" data-bs-toggle="pill" data-bs-target="#pills-admin" type="button" role="tab" aria-controls="pills-admin" aria-selected="false">Admins</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-manager-tab" data-bs-toggle="pill" data-bs-target="#pills-manager" type="button" role="tab" aria-controls="pills-manager" aria-selected="false">Gym Managers</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-staff-tab" data-bs-toggle="pill" data-bs-target="#pills-staff" type="button" role="tab" aria-controls="pills-staff" aria-selected="false">Gym Staff</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-member-tab" data-bs-toggle="pill" data-bs-target="#pills-member" type="button" role="tab" aria-controls="pills-member" aria-selected="false">Members</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all users</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Access</th>
              <th>First&nbsp;Name</th>
              <th>Middle&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($user->id) ?></td>
              <td><?= h($user->email) ?></td>
              <td><?= h($user->access_abv) ?></td>
              <td><?= h($user->first_name) ?></td>
              <td><?= h($user->middle_name) ?></td>
              <td><?= h($user->last_name) ?></td>
              <td><?= h($user->city) ?></td>
              <td><?= h($user->state_abv) ?></td>
              <td><?= format_phone(h($user->phone_p_country), h($user->phone_primary)) ?></td>
              <td><?= format_date(h($user->birth_date)) ?></td>
              <td><a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a></td>
              <td><a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a></td>
              <td><a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">All Admin</div>
    <div class="tab-pane fade" id="pills-manager" role="tabpanel" aria-labelledby="pills-manager-tab">All Gym Managers</div>
    <div class="tab-pane fade" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">All Gym Staff</div>
    <div class="tab-pane fade" id="pills-member" role="tabpanel" aria-labelledby="pills-member-tab">All Members</div>
  </div>

</main>