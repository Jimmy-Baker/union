<?php
// prevent this code from being loaded directly
if(!isset($user)) {
  redirect_to(url_for('/staff/users/users.php'));
}

$states = State::all_states();
$countries = Country::all_countries();
$today = date('Y-m-d');
$accesses = User::USER_TYPES; 

// Set some defaults

?>

<datalist id="countryPrefixes">
  <?php foreach($countries as $country) { ?>
  <option value="<?= $country->country_prefix ?>" <?= ($user->phone_p_country == $country->country_prefix) ? 'selected' : '';?>><?= $country->country_name; ?></option>
  <?php } ?>
</datalist>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Profile Information</legend>
  <div class="card-body">
    <?php if(defined('exists')) { ?>
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputSavedImage1" class="col-form-label">Avatar</label>
      </div>
      <div class="col-md-7">
        <?php if($user->avatar_url != ''){ ?>
        <img src="<?= h($user->avatar_url); ?>" class="rounded img-thumbnail mx-auto mb-2" alt="<?= $user->preferred_name ?>'s profile picture." height="200" width="200">
        <?php } ?>
        <div class="input-group">
          <input type="text" value="<?= $user->avatar_url; ?>" name="image1" class="form-control" id="inputSavedImage1" aria-describedby="helpSavedImage1" readonly>
          <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Image</button>
        </div>
      </div>
      <div id="helpSavedImage1" class="form-text" offset-md-3></div>
    </div>
    <?php } ?>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputFirstName" class="col-form-label">First Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[first_name]" value="<?= h($user->first_name); ?>" class="form-control" id="inputFirstName" maxlength="32" aria-describedby="helpFirstName" required>
      </div>
      <div id="helpFirstName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputMiddleName" class="col-form-label">Middle Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[middle_name]" value="<?= h($user->middle_name); ?>" class="form-control" id="inputMiddleName" aria-describedby="helpMiddleName" maxlength="32">
      </div>
      <div id="helpMiddleName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLastName" class="col-form-label">Last Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[last_name]" value="<?= h($user->last_name); ?>" class="form-control" id="inputLastName" maxlength="32" aria-describedby="helpLastName" required>
      </div>
      <div id="helpLastName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPreferredName" class="col-form-label">Preferred Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[preferred_name]" value="<?= h($user->preferred_name); ?>" class="form-control" aria-describedby="helpPreferredName" id="inputPreferredName">
      </div>
      <div id="helpPreferredName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputBirthDate" class="col-form-label">Birth Date</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="user[birth_date]" value="<?= h(html_date($user->birth_date)); ?>" class="form-control" id="inputBirthDate" min="1902-01-01" max="<?= $today; ?>" aria-describedby="helpBirthDate" required>
      </div>
      <div id="helpBirthDate" class="form-text offset-md-3">Must be between 01/01/1902 and <?= format_date($today, "/"); ?></div>
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
        <input type="text" name="user[street_address]" value="<?= h($user->street_address); ?>" class="form-control" id="inputStreetAddress" minlength="6" maxlength="64" aria-describedby="helpStreetAddress" required>
      </div>
      <div id="helpStreetAddress" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCity" class="col-form-label">City</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[city]" value="<?= h($user->city); ?>" class="form-control" id="inputCity" minlength="2" maxlength="64" aria-describedby="helpCity" required>
      </div>
      <div id="helpCity" class="form-text offset-md-3">Maximum of 64 characters</div>
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
        <input type="text" name="user[zip]" value="<?= h($user->zip); ?>" class="form-control" id="inputZip" minlength="5" maxlength="5" aria-describedby="helpZip" required>
      </div>
      <div id="helpZip" class="form-text offset-md-3">Must be 5 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCountryAbv" class="col-form-label">Country</label>
      </div>
      <div class="col-md-7">
        <select name="user[country_abv]" class="form-select country" id="inputCountryAbv" aria-describedby="helpCountryAbv" required>
          <?php foreach($countries as $country) { ?>
          <option value="<?= $country->abv ?>" <?= (($user->country_abv == $country->abv) || (($user->country_abv == '') && ($country->abv == 'US'))) ? 'selected' : '';?>><?= $country->country_name; ?></option>
          <?php } ?>
        </select>
        <div id="helpCountryAbv" class="form-text offset-md-3"></div>
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
        <input type="text" name="user[email]" value="<?= h($user->email); ?>" class="form-control" id="inputEmail" maxlength="255" aria-describedby="helpEmail" required>
      </div>
      <div id="helpEmail" class="form-text offset-md-3">Maximum of 255 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhonePrimary" class="col-form-label">Primary Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_p_country]" value="<?= h($user->phone_p_country); ?>" class="form-control col ppx" id="inputPhonePCountry" list="countryPrefixes" aria-labelledby="inputPhonePrimary" readonly>
          <input type="tel" name="user[phone_primary]" value="<?= h($user->phone_primary); ?>" class="form-control col w-75" id="inputPhonePrimary" aria-describedby="helpPhonePrimary" minlength="10" maxlength="12" required>
        </div>
      </div>
      <div id="helpPhonePrimary" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhoneSecondary" class="col-form-label">Secondary Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_s_country]" value="<?= h($user->phone_s_country); ?>" class="form-control col ppx" id="inputPhoneSCountry" list="countryPrefixes" aria-labelledby="inputPhoneSecondary" readonly>
          <input type="tel" name="user[phone_secondary]" value="<?= h($user->phone_secondary); ?>" class="form-control col w-75" maxlength="12" id="inputPhoneSecondary" aria-describedby="phoneSecondary">
        </div>
      </div>
      <div id="phoneSecondary" class="form-text offset-md-3">Maximum of 12 Digits</div>
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
        <input type="text" name="user[first_name_emergency]" value="<?= h($user->first_name_emergency); ?>" class="form-control" id="inputEmergencyFirst" aria-describedby="helpEmergencyFirst" required>
      </div>
      <div id="helpEmergencyFirst" class="form-text offset-md-3">Maximum of 32 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEmergencyLast" class="col-form-label">Contact Last Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[last_name_emergency]" value="<?= h($user->last_name_emergency); ?>" class="form-control" id="inputEmergencyLast" aria-describedby="helpEmergencyLast" required>
      </div>
      <div id="helpEmergencyLast" class="form-text offset-md-3">Maximum of 32 Characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhoneEmergency" class="col-form-label">Contact's Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="user[phone_e_country]" value="<?= h($user->phone_e_country); ?>" class="form-control col ppx" id="inputPhoneECountry" list="countryPrefixes" aria-labelledby="inputPhoneEmergency" readonly>
          <input type="tel" name="user[phone_emergency]" value="<?= h($user->phone_emergency); ?>" class="form-control col w-75" id="inputPhoneEmergency" aria-describedby="helpPhoneEmergency" maxlength="12" required>
        </div>
      </div>
      <div id="helpPhoneEmergency" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>
  </div>
</fieldset>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Access Information</legend>
  <div class="card-body">
    <?php if(defined('exists')) { ?>
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGroupID" class="col-form-label">Group ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="user[group_id]" value="<?= h($user->group_id); ?>" class="form-control" id="inputGroupID" maxlength="6">
      </div>
    </div>
    <?php } ?>

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
        <input type="password" name="user[password]" value="<?= h($user->password); ?>" class="form-control" id="inputPassword" <?php if(!defined('exists')) {'required';} ?>>
      </div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
      </div>
      <div class="col-md-7">
        <input type="password" name="user[confirm_password]" value="<?= h($user->confirm_password); ?>" class="form-control" id="inputConfirmPassword" <?php if(!defined('exists')) {'required';} ?>>
      </div>
    </div>
  </div>
</fieldset>

<?php include(PUBLIC_PATH . '/app/shared/upload.php'); ?>

<script src="<?= url_for("js/country_ppx.js") ?>" defer></script>
<script src="<?= url_for('node_modules/inputmask/dist/jquery.inputmask.js') ?>" defer></script>