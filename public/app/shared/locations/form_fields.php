<?php
// prevent this code from being loaded directly
if(!isset($location)) {
  redirect_to(url_for('/staff/locations/locations.php'));
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
        <label for="inputLocationName" class="col-form-label">Location Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[location_name]" value="<?php echo h($location->location_name); ?>" class="form-control" id="inputLocationName" maxlength="32" aria-describedby="locationNameHelp" required>
      </div>
      <div id="locationNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGymID" class="col-form-label">Gym ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[gym_id]" value="<?php echo h($location->gym_id); ?>" class="form-control" id="inputGymID" aria-describedby="gymIDHelp" maxlength="32">
      </div>
      <div id="gymIDHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="card-body">
      <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputStreetAddress" class="col-form-label">Street Address</label>
        </div>
        <div class="col-md-7">
          <input type="text" name="location[street_address]" value="<?php echo h($location->street_address); ?>" class="form-control" id="inputStreetAddress" maxlength="64" aria-describedby="streetAddressHelp" required>
        </div>
        <div id="streetAddressHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
      </div>

      <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputCity" class="col-form-label">City</label>
        </div>
        <div class="col-md-7">
          <input type="text" name="location[city]" value="<?php echo h($location->city); ?>" class="form-control" id="inputCity" maxlength="64" aria-describedby="cityHelp" required>
        </div>
        <div id="cityHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
      </div>

      <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputStateAbv" class="col-form-label">State</label>
        </div>
        <div class="col-md-7">
          <select name="location[state_abv]" class="form-select" id="inputStateAbv" required>
            <?php foreach($states as $state) { ?>
            <option value="<?= $state->abv ?>" <?= ($location->state_abv == $state->abv) ? 'selected' : '';?>><?= $state->state_name; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputZip" class="col-form-label">Zip Code</label>
        </div>
        <div class="col-md-7">
          <input type="text" name="location[zip]" value="<?php echo h($location->zip); ?>" class="form-control" id="inputZip" minlength="5" maxlength="5">
        </div>
        <div id="preferredNameHelp" class="form-text offset-md-3">Must be 5 characters</div>
      </div>

      <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputCountryAbv" class="col-form-label">Country</label>
        </div>
        <div class="col-md-7">
          <select name="location[country_abv]" class="form-select" id="inputCountryAbv">
            <?php foreach($countries as $country) { ?>
            <option value="<?= $country->abv ?>" <?= ($location->country_abv == $country->abv) ? 'selected' : '';?>><?= $country->country_name; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
        <div class="col-md-3 text-md-end">
          <label for="inputPhonePrimary" class="col-form-label">Primary Phone</label>
        </div>
        <div class="col-md-7">
          <div class="row ms-0 input-location">
            <input type="tel" name="location[phone_p_country]" value="<?php echo h($location->phone_p_country); ?>" class="form-control col" id="inputPhonePCountry" list="countryPrefixes" aria-labelledby="inputPhonePrimary" required>
            <datalist id="countryPrefixes">
              <?php foreach($countries as $country) { ?>
              <option value="<?= $country->country_prefix ?>" <?= ($location->phone_p_country == $country->country_prefix) ? 'selected' : '';?>><?= $country->country_name; ?></option>
              <?php } ?>
            </datalist>
            <input type="tel" name="location[phone_primary]" value="<?php echo h($location->phone_primary); ?>" class="form-control col w-50" id="inputPhonePrimary" aria-describedby="phonePrimaryHelp" required>
          </div>
        </div>
        <div id="phonePrimaryHelp" class="form-text offset-md-3">Maximum of 12 Digits</div>
      </div>
    </div>
</fieldset>