<?php
// prevent this code from being loaded directly
if(!isset($location)) {
  redirect_to(url_for('/staff/locations/locations.php'));
}

$states = State::all_states();
$countries = Country::all_countries();
$gyms = Gym::find_all();

?>

<datalist id="countryPrefixes">
  <?php foreach($countries as $country) { ?>
  <option value="<?= h($country->country_prefix) ?>" <?= ($user->phone_p_country == $country->country_prefix) ? 'selected' : '';?>><?= h($country->country_name); ?></option>
  <?php } ?>
</datalist>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Location Information</legend>
  <div class="card-body">

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLocationName" class="col-form-label">Location Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[location_name]" value="<?= h($location->location_name); ?>" class="form-control" id="inputLocationName" maxlength="32" aria-describedby="helpLocationName" required>
      </div>
      <div id="helpLocationName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputGymID" class="col-form-label">Gym ID</label>
      </div>
      <div class="col-md-7">
        <select name="location[gym_id]" value="<?= h($location->gym_id); ?>" class="form-select" id="inputGymId" aria-describedby="helpGymId" required>
          <?php foreach($gyms as $gym) { ?>
          <option value="<?= h($gym->id) ?>" <?= ($gym->id == $location->gym_id) ? 'selected' : '';?>><?= h($gym->gym_name); ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpGymId" class="form-text offset-md-3"></div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStreetAddress" class="col-form-label">Street Address</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[street_address]" value="<?= h($location->street_address); ?>" class="form-control" id="inputStreetAddress" maxlength="64" aria-describedby="helpStreetAddress" required>
      </div>
      <div id="helpStreetAddress" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCity" class="col-form-label">City</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[city]" value="<?= h($location->city); ?>" class="form-control" id="inputCity" maxlength="64" aria-describedby="helpCity" required>
      </div>
      <div id="helpCity" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStateAbv" class="col-form-label">State</label>
      </div>
      <div class="col-md-7">
        <select name="location[state_abv]" class="form-select" id="inputStateAbv" aria-describedby="helpStateAbv" required>
          <?php foreach($states as $state) { ?>
          <option value="<?= h($state->abv) ?>" <?= ($location->state_abv == $state->abv) ? 'selected' : '';?>><?= h($state->state_name); ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpStateAbv" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputZip" class="col-form-label">Zip Code</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="location[zip]" value="<?= h($location->zip); ?>" class="form-control" id="inputZip" minlength="5" maxlength="5" aria-describedby="helpZip">
      </div>
      <div id="helpZip" class="form-text offset-md-3">Must be 5 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCountryAbv" class="col-form-label">Country</label>
      </div>
      <div class="col-md-7">
        <select name="location[country_abv]" class="form-select" id="inputCountryAbv" aria-describedby="helpCountryAbv">
          <?php foreach($countries as $country) { ?>
          <option value="<?= h($country->abv) ?>" <?= ($location->country_abv == $country->abv) ? 'selected' : '';?>><?= h($country->country_name); ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpCountryAbv" class="form-text offset-md-3">Must be 5 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhonePrimary" class="col-form-label">Primary Phone</label>
      </div>
      <div class="col-md-7">
        <div class="row ms-0 input-group">
          <input type="tel" name="location[phone_p_country]" value="<?= h($location->phone_p_country); ?>" class="form-control col ppx" id="inputPhonePCountry" list="countryPrefixes" aria-labelledby="inputPhonePrimary" readonly>
          <input type="tel" name="location[phone_primary]" value="<?= h($location->phone_primary); ?>" class="form-control col w-75" id="inputPhonePrimary" aria-describedby="phonePrimary" required>
        </div>
      </div>
      <div id="helpPhonePrimary" class="form-text offset-md-3">Maximum of 12 Digits</div>
    </div>
  </div>
</fieldset>