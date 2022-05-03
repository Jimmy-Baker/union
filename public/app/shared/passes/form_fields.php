<?php
if(!isset($pass)) {
  redirect_to(url_for('app/shared/passes/passes.php'));
}

$today = date('Y-m-d');
$types = Pass::PASS_TYPES;
?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Pass Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputUserID" class="col-form-label">Associated User ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="pass[user_id]" value="<?= h($pass->user_id); ?>" class="form-control" id="inputUserID" maxlength="32" aria-describedby="helpUserID" required>
      </div>
      <div id="helpUserID" class="form-text offset-md-3">Required - Maximum of 10 digits</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputIsActive" class="col-form-label">Active</label>
      </div>
      <div class="col-md-7">
        <select name="pass[is_active]" class="form-select" id="inputIsActive" aria-describedby="helpIsActive" required>
          <option hidden value="">Select One</option>
          <option value='0' <?= ($pass->is_active == 0) ? 'selected' : ''; ?>>No</option>
          <option value='1' <?= ($pass->is_active == 1) ? 'selected' : ''; ?>>Yes</option>
        </select>
      </div>
      <div id="helpIsActive" class="form-text offset-md-3">Required - Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPassType" class="col-form-label">Pass Type</label>
      </div>
      <div class="col-md-7">
        <select name="pass[pass_type]" class="form-select" id="inputPassType" aria-describedby="helpPassType" required>
          <option hidden value="">Select One</option>
          <?php foreach($types as $abv=>$type) { ?>
          <option value="<?= h($abv) ?>" <?= ($pass->pass_type == $abv) ? 'selected' : '';?>><?= h($type); ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpPassType" class="form-text offset-md-3">Required - Maximum of 32 characters</div>
    </div>

    <?php if(defined('exists')) { ?>
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCreatedAt" class="col-form-label">Created</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="user[created_at]" value="<?= html_date($pass->created_at); ?>" class="form-control" id="inputCreatedAt" aria-describedby="helpCreatedAt">
      </div>
      <div id="helpCreatedAt" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>
    <?php } ?>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputActiveOn" class="col-form-label">Active On</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="pass[active_on]" value="<?= h($pass->active_on); ?>" class="form-control" aria-describedby="helpActiveOn" id="inputActiveOn">
      </div>
      <div id="helpActiveOn" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <?php if(defined('exists')) { ?>
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputExpiresOn" class="col-form-label">Expires On</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="pass[expires_on]" value="<?= html_date($pass->expires_on); ?>" class="form-control" id="inputExpiresOn" aria-describedby="helpExpiresOn">
      </div>
      <div id="helpExpiresOn" class="form-text offset-md-3">Must be between 01/01/1902 and <?= format_date($today, "/"); ?></div>
    </div>
    <?php } ?>
  </div>
</fieldset>
