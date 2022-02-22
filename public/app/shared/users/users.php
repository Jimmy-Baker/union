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
$staffs = User::find_by_access("GS");
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
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
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
              <td><?= h($user->last_name) ?></td>
              <td><?= h($user->city) ?></td>
              <td><?= h($user->state_abv) ?></td>
              <td><?= format_phone(h($user->phone_p_country), h($user->phone_primary)) ?></td>
              <td><?= format_date(h($user->birth_date)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all admins</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Group&nbsp;ID</th>
              <th>First&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($admins as $admin) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($admin->id) ?></td>
              <td><?= h($admin->email) ?></td>
              <td><a href="<?= url_for('/app/shared/groups/view.php?id=' . h(u($admin->group_id))); ?>"><?= h($admin->group_id) ?></a></td>
              <td><?= h($admin->first_name) ?></td>
              <td><?= h($admin->last_name) ?></td>
              <td><?= h($admin->city) ?></td>
              <td><?= h($admin->state_abv) ?></td>
              <td><?= format_phone(h($admin->phone_p_country), h($admin->phone_primary)) ?></td>
              <td><?= format_date(h($admin->birth_date)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-manager" role="tabpanel" aria-labelledby="pills-manager-tab">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all gym managers</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Group&nbsp;ID</th>
              <th>First&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($managers as $manager) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($manager->id) ?></td>
              <td><?= h($manager->email) ?></td>
              <td><a href="<?= url_for('/app/shared/groups/view.php?id=' . h(u($manager->group_id))); ?>"><?= h($manager->group_id) ?></a></td>
              <td><?= h($manager->first_name) ?></td>
              <td><?= h($manager->last_name) ?></td>
              <td><?= h($manager->city) ?></td>
              <td><?= h($manager->state_abv) ?></td>
              <td><?= format_phone(h($manager->phone_p_country), h($manager->phone_primary)) ?></td>
              <td><?= format_date(h($manager->birth_date)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all gym staff</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Group&nbsp;ID</th>
              <th>First&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($staffs as $staff) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($staff->id) ?></td>
              <td><?= h($staff->email) ?></td>
              <td><a href="<?= url_for('/app/shared/groups/view.php?id=' . h(u($staff->group_id))); ?>"><?= h($staff->group_id) ?></a></td>
              <td><?= h($staff->first_name) ?></td>
              <td><?= h($staff->last_name) ?></td>
              <td><?= h($staff->city) ?></td>
              <td><?= h($staff->state_abv) ?></td>
              <td><?= format_phone(h($staff->phone_p_country), h($staff->phone_primary)) ?></td>
              <td><?= format_date(h($staff->birth_date)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-member" role="tabpanel" aria-labelledby="pills-member-tab">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>List of all members</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Group&nbsp;ID</th>
              <th>First&nbsp;Name</th>
              <th>Last&nbsp;Name</th>
              <th>City</th>
              <th>State</th>
              <th>Phone</th>
              <th>Birth&nbsp;Date</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($members as $member) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($member->id) ?></td>
              <td><?= h($member->email) ?></td>
              <td><a href="<?= url_for('/app/shared/groups/view.php?id=' . h(u($member->group_id))); ?>"><?= h($member->group_id) ?></a></td>
              <td><?= h($member->first_name) ?></td>
              <td><?= h($member->last_name) ?></td>
              <td><?= h($member->city) ?></td>
              <td><?= h($member->state_abv) ?></td>
              <td><?= format_phone(h($member->phone_p_country), h($member->phone_primary)) ?></td>
              <td><?= format_date(h($member->birth_date)) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="user actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/view.php?id=' . h(u($user->id))); ?>">View</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>