<?php
if(count(get_included_files()) == 1) redirect_to(url_for('/app/shared/groups/groups.php'));

$users = User::find_all();
$types = GroupType::find_all();
$today = date('Y-m-d');
?>

<datalist id="userIDs">
  <?php foreach($users as $user) { ?>
  <option value="<?= h($user->id) ?>" <?= ($user->id == $group->owner_id) ? 'selected' : '';?>><?= h($user->full_name()); ?></option>
  <?php } ?>
</datalist>


<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Group Information</legend>
  <div class="card-body">

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupName" class="col-form-label">Group Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="group[name]" value="<?= h($group->name); ?>" class="form-control" id="inputGroupName" maxlength="32" aria-describedby="helpGroupName" required>
      </div>
      <div id="helpGroupName" class="form-text offset-md-3">Required - Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputOwnerID" class="col-form-label">Leader ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="group[owner_id]" value="<?= h($group->id) ?>" class="form-control" id="inputOwnerID" list="userIDs" aria-describedby="helpOwnerID" maxlength="8" required>
      </div>
      <div id="helpOwnerID" class="form-text offset-md-3">Required - Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupType" class="col-form-label">Group Type</label>
      </div>
      <div class="col-md-7">
        <select name="group[type_abv]" class="form-select" id="inputGroupType" aria-describedby="helpGroupType" required>
          <option hidden value="">Select One</option>
          <?php foreach($types as $type) { ?>
          <option value="<?= h($type->abv) ?>" <?= ($group->type_abv == $type->abv) ? 'selected' : ''; ?>><?= h($type->description) ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpGroupType" class="form-text offset-md-3">Required - Maximum of 32 characters</div>
    </div>
  </div>
</fieldset>