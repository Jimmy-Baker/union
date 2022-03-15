<?php
// prevent this code from being loaded directly
if(!isset($user)) {
  redirect_to(url_for('/staff/users/users.php'));
}

$states = State::all_states();
$countries = Country::all_countries();
$today = date('Y-m-d');
$accesses = User::USER_TYPES; 
?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Profile Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputAvatarURL" class="col-form-label">Avatar</label>
      </div>
      <div class="col-md-7">
        <img src="<?= h($user->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $user->preferred_name ?>'s profile picture." height="200" width="200">
        <input type="text" value="<?= $user->avatar_url; ?>" name="user[avatar_url]" class="form-control" id="inputAvatarURL" readonly>
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputFirstName" class="col-form-label">First Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[first_name]" value="<?php echo h($user->first_name); ?>" class="form-control" id="inputFirstName" maxlength="32" aria-describedby="firstNameHelp" required>
      </div>
      <div id="firstNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputMiddleName" class="col-form-label">Middle Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[middle_name]" value="<?php echo h($user->middle_name); ?>" class="form-control" id="inputMiddleName" aria-describedby="middleNameHelp" maxlength="32">
      </div>
      <div id="middleNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLastName" class="col-form-label">Last Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[last_name]" value="<?php echo h($user->last_name); ?>" class="form-control" id="inputLastName" maxlength="32" aria-describedby="lastNameHelp" required>
      </div>
      <div id="lastNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPreferredName" class="col-form-label">Preferred Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[preferred_name]" value="<?php echo h($user->preferred_name); ?>" class="form-control" aria-describedby="preferredNameHelp" id="inputPreferredName">
      </div>
      <div id="preferredNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputBirthDate" class="col-form-label">Birth Date</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="user[birth_date]" value="<?php echo h(html_date($user->birth_date)); ?>" class="form-control" id="inputBirthDate" min="1902-01-01" max="<?= $today; ?>" aria-describedby="birthDateHelp" required>
      </div>
      <div id="birthDateHelp" class="form-text offset-md-3">Must be between 01/01/1902 and <?= format_date($today, "/"); ?></div>
    </div>
  </div>
</fieldset>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Location Information</legend>
  <div class="card-body">
    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStreetAddress" class="col-form-label">Street Address</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[street_address]" value="<?php echo h($user->street_address); ?>" class="form-control" id="inputStreetAddress" maxlength="64" aria-describedby="streetAddressHelp" required>
      </div>
      <div id="streetAddressHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCity" class="col-form-label">City</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[city]" value="<?php echo h($user->city); ?>" class="form-control" id="inputCity" maxlength="64" aria-describedby="cityHelp" required>
      </div>
      <div id="cityHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStateAbv" class="col-form-label">State</label>
      </div>
      <div class="col-md-7">
        <select name="user[state_abv]" class="form-select" id="inputStateAbv" required>
          <?php foreach($states as $state) { ?>
          <option value="<?= $state->abv ?>" <?= ($user->state_abv == $state->abv) ? 'selected' : '';?>><?= $state->state_name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputZip" class="col-form-label">Zip Code</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[zip]" value="<?php echo h($user->zip); ?>" class="form-control" id="inputZip" minlength="5" maxlength="5">
      </div>
      <div id="preferredNameHelp" class="form-text offset-md-3">Must be 5 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCountryAbv" class="col-form-label">Country</label>
      </div>
      <div class="col-md-7">
        <select name="user[country_abv]" class="form-select" id="inputCountryAbv">
          <?php foreach($countries as $country) { ?>
          <option value="<?= $country->abv ?>" <?= ($user->country_abv == $country->abv) ? 'selected' : '';?>><?= $country->country_name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
</fieldset>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Contact Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEmail" class="col-form-label">Email</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[email]" value="<?php echo h($user->email); ?>" class="form-control" id="inputEmail" maxlength="255" aria-describedby="emailHelp" required>
      </div>
      <div id="emailHelp" class="form-text offset-md-3">Maximum of 255 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhonePrimary" class="col-form-label">Primary Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_p_country]" value="<?php echo h($user->phone_p_country); ?>" class="form-control col" id="inputPhonePCountry" list="countryPrefixes" aria-labelledby="inputPhonePrimary" required>
          <datalist id="countryPrefixes">
            <?php foreach($countries as $country) { ?>
            <option value="<?= $country->country_prefix ?>" <?= ($user->phone_p_country == $country->country_prefix) ? 'selected' : '';?>><?= $country->country_name; ?></option>
            <?php } ?>
          </datalist>
          <input type="tel" name="user[phone_primary]" value="<?php echo h($user->phone_primary); ?>" class="form-control col w-50" id="inputPhonePrimary" aria-describedby="phonePrimaryHelp" required>
        </div>
      </div>
      <div id="phonePrimaryHelp" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhoneSecondary" class="col-form-label">Secondary Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_s_country]" value="<?php echo h($user->phone_s_country); ?>" class="form-control col" id="inputPhoneSCountry" list="countryPrefixes">
          <input type="tel" name="user[phone_secondary]" value="<?php echo h($user->phone_secondary); ?>" class="form-control col w-50" id="inputPhoneSecondary" aria-describedby="phoneSecondaryHelp">
        </div>
      </div>
      <div id="phoneSecondaryHelp" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>
  </div>
</fieldset>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Emergency Contact Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEmergencyFirst" class="col-form-label">Contact First Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[first_name_emergency]" value="<?php echo h($user->first_name_emergency); ?>" class="form-control" id="inputEmergencyFirst" aria-describedby="emergencyFirstHelp" required>
      </div>
      <div id="emergencyFirstHelp" class="form-text offset-md-3">Maximum of 32 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEmergencyLast" class="col-form-label">Contact Last Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[last_name_emergency]" value="<?php echo h($user->last_name_emergency); ?>" class="form-control" id="inputEmergencyLast" aria-describedby="emergencyLastHelp" required>
      </div>
      <div id="emergencyLastHelp" class="form-text offset-md-3">Maximum of 32 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhoneEmergency" class="col-form-label">Contact's Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_e_country]" value="<?php echo h($user->phone_e_country); ?>" class="form-control col" id="inputPhoneECountry" list="countryPrefixes">
          <input type="tel" name="user[phone_emergency]" value="<?php echo h($user->phone_emergency); ?>" class="form-control col" id="inputPhoneEmergency" aria-describedby="phoneEmergencyHelp" required>
        </div>
      </div>
      <div id="phoneEmergencyHelp" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>
  </div>
</fieldset>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Access Information</legend>
  <div class="card-body">
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupID" class="col-form-label">Group ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[group_id]" value="<?php echo h($user->group_id); ?>" class="form-control" id="inputGroupID" maxlength="6">
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputAccessAbv" class="col-form-label">User Type</label>
      </div>
      <div class="col-md-7">
        <select name="user[access_abv]" class="form-select" id="inputAccessAbv" required>
          <?php foreach($accesses as $abv=>$access) { ?>
          <option value="<?= $abv ?>" <?= ($user->access_abv == $abv) ? 'selected' : '';?>><?= $access; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPassword" class="col-form-label">Password</label>
      </div>
      <div class="col-md-7">
        <input type="password" name="user[password]" value="<?php echo h($user->password); ?>" class="form-control" id="inputPassword">
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
      </div>
      <div class="col-md-7">
        <input type="password" name="user[confirm_password]" value="<?php echo h($user->confirm_password); ?>" class="form-control" id="inputConfirmPassword">
      </div>
    </div>
  </div>
</fieldset>