<?php
// prevent this code from being loaded directly
if(!isset($gym)) {
  $session->message('No gym was identified.', 'warning');
  redirect_to(url_for('/staff/gyms/gyms.php'));
}

?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Gym Information</legend>
  <div class="card-body">
    <?php if(defined('exists')) { ?>
    <?php for($num = 1; $num<2; $num++) { ?>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputSavedImage1" class="col-form-label">Avatar</label>
      </div>
      <div class="col-md-7">
        <?php if($gym->avatar_url != ''){ ?>
        <img src="<?= h($gym->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2 avatar" alt="<?= h($gym->gym_name) ?>'s profile picture." height="200" width="200">
        <?php } ?>
        <div class="input-group">
          <input type="text" value="<?= image_name($gym->avatar_url); ?>" name="image<?= $num ?>" class="form-control" id="inputSavedImage<?= $num ?>" aria-describedby="helpSavedImage<?= $num ?>" readonly>
          <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $num ?> data-bs-image=" <?= $num ?>"">Add Image</button>
        </div>
      </div>
      <div id="helpSavedImage<?= $num ?>" class="form-text" offset-md-3></div>
    </div>
    <?php }} ?>

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
      <div id="helpWebsite" class="form-text offset-md-3">Must begin with
        <code>http://</code> or
        <code>https://</code>
      </div>
    </div>
  </div>
</fieldset>

<?php include(PUBLIC_PATH . '/app/shared/upload.php'); ?>

<?php $scripts[] = "js/photo_modal.js" ?>