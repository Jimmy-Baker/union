<?php
// prevent this code from being loaded directly
if(!isset($pass)) {
  redirect_to(url_for('app/shared/passes/passes.php'));
}

$today = date('Y-m-d');
?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Pass Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputUserID" class="col-form-label">Associated User ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="pass[user_id]" value="<?= h($pass->user_id); ?>" class="form-control" id="inputUserID" maxlength="32" aria-describedby="userIDHelp" required>
      </div>
      <div id="userIDHelp" class="form-text offset-md-3">Maximum of 10 digits</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputIsActive" class="col-form-label">Active</label>
      </div>
      <div class="col-md-7">
        <select name="pass[is_active]" class="form-select" id="inputIsActive" required>
          <option value="0" <?= ($pass->is_active == 0) ? 'selected' : ''; ?>>No</option>
          <option value="1" <?= ($pass->is_active == 1) ? 'selected' : ''; ?>>Yes</option>
        </select>
      </div>
      <div id="isActiveHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPassType" class="col-form-label">Pass Type</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="pass[pass_type]" value="<?= h($pass->pass_type); ?>" class="form-control" id="inputPassType" aria-describedby="passTypeHelp" maxlength="32">
      </div>
      <div id="passTypeHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCreatedAt" class="col-form-label">Created</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="user[created_at]" value="<?= h(html_date($pass->created_at)); ?>" class="form-control" id="inputCreatedAt" aria-describedby="lastNameHelp" readonly>
      </div>
      <div id="createdAtHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputActiveOn" class="col-form-label">Active On</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="pass[active_on]" value="<?= h($pass->active_on); ?>" class="form-control" aria-describedby="activeOnHelp" id="inputActiveOn">
      </div>
      <div id="activeOnHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputExpiresOn" class="col-form-label">Expires On</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="pass[expires_on]" value="<?= h(html_date($pass->expires_on)); ?>" class="form-control" id="inputExpiresOn" aria-describedby="expiresOnHelp" readonly>
      </div>
      <div id="expiresOnHelp" class="form-text offset-md-3">Must be between 01/01/1902 and <?= h(format_date($today, "/")); ?></div>
    </div>
  </div>
</fieldset>