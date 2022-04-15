<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'New User';
include(SHARED_PATH . '/public-header.php'); 

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message('Congratulations! Your account was created.', 'success');
    redirect_to(url_for('/app/login.php?email=' . $user->email));
  } else {

  }
} else {
  $user = new User;
}

$states = State::all_states();
$countries = Country::all_countries();
$today = date('Y-m-d');
$accesses = User::USER_TYPES;
?>

<header>
  <div class="p-5 bg-dark text-light">
    <div class="container-fluid py-3">
      <h1>Register with Union</h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="login.php">Back to Login</a></li>
        </ol>
      </nav>
    </div>
  </div>
</header>

<main class="container-md p-4 mt-5" id="main">

  <?= display_errors($user->error_array); ?>
  <form action="signup.php" method="post">
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Profile Information</legend>
      <div class="card-body">

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
    <button type="submit" name="submit" class="btn shadow btn-primary">Sign Up</button>
  </form>

</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>

<script src="<?= url_for("js/country_ppx.js") ?>" defer></script>
<script src="<?= url_for('node_modules/inputmask/dist/jquery.inputmask.js') ?>" defer></script>