<?php
// prevent this code from being loaded directly
if(!isset($gym)) {
  redirect_to(url_for('/staff/gyms/gyms.php'));
}

?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Gym Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputAvatarURL" class="col-form-label">Avatar</label>
      </div>
      <div class="col-md-7">
        <img src="<?= h($gym->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $gym->preferred_name ?>'s profile picture." height="200" width="200">
        <input type="text" value="<?= $gym->avatar_url; ?>" name="gym[avatar_url]" class="form-control" id="inputAvatarURL" maxlength="255" aria-describedby="helpAvatar" readonly>
      </div>
      <div id="helpAvatar" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGymName" class="col-form-label">Gym Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="gym[gym_name]" value="<?= h($gym->gym_name); ?>" class="form-control" id="inputGymName" maxlength="32" aria-describedby="helpGymName" required>
      </div>
      <div id="helpGymName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputWebsite" class="col-form-label">Website</label>
      </div>
      <div class="col-md-7">
        <input type="url" name="gym[website]" value="<?= h($gym->website); ?>" class="form-control" id="inputWebsite" aria-describedby="helpWebsite" maxlength="64">
      </div>
      <div id="helpWebsite" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>
  </div>
</fieldset>