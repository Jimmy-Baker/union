<?php
// prevent this code from being loaded directly
if(!isset($group)) {
  redirect_to(url_for('/staff/groups/groups.php'));
}

$users = User::find_all();
$types = GroupType::find_all();
$today = date('Y-m-d');
?>

<datalist id="userIDs">
  <?php foreach($users as $user) { ?>
  <option value="<?= h($user->id) ?>" <?= ($user->id == $group->leader_id) ? 'selected' : '';?>><?= h($user->full_name()); ?></option>
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
      <div id="helpGroupName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLeaderID" class="col-form-label">Leader ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="group[leader_id]" value="<?= h($group->id) ?>" class="form-control" id="inputLeaderID" list="userIDs" aria-describedby="helpLeaderID" maxlength="8" required>
      </div>
      <div id="helpLeaderID" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupType" class="col-form-label">Group Type</label>
      </div>
      <div class="col-md-7">
        <select name="group[type_abv]" class="form-select" id="inputGroupType" aria-describedby="helpGroupType" required>
          <?php foreach($types as $type) { ?>
          <option value="<?= h($type->abv) ?>" <?= ($group->type_abv == $type->abv) ? 'selected' : ''; ?>><?= h($type->description) ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpGroupType" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>
  </div>
</fieldset>