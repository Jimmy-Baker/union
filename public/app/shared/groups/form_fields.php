<?php
// prevent this code from being loaded directly
if(!isset($group)) {
  redirect_to(url_for('/staff/groups/groups.php'));
}

$states = State::all_states();
$countries = Country::all_countries();
$today = date('Y-m-d');
$accesses = User::USER_TYPES; 
?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Group Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLeaderID" class="col-form-label">Leader ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="group[leader_id]" value="<?= h($group->leader_id); ?>" class="form-control" id="inputLeaderID" maxlength="32" aria-describedby="leaderIDHelp" required>
      </div>
      <div id="leaderIDHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupType" class="col-form-label">Group Type</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="group[group_type]" value="<?= h($group->group_type); ?>" class="form-control" id="inputGroupType" aria-describedby="groupTypeHelp" maxlength="32">
      </div>
      <div id="groupTypeHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>
  </div>
</fieldset>
