<?php
// prevents this code from being loaded directly in the browser
if(!isset($user)) {
  redirect_to(url_for('/staff/users/users.php'));
}
?>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-md-end">
    <label for="inputFirstName" class="col-form-label">First Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[first_name]" value="<?php echo h($user->first_name); ?>" class="form-control" id="inputFirstName">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-md-end">
    <label for="inputMiddleName" class="col-form-label">Middle Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[middle_name]" value="<?php echo h($user->middle_name); ?>" class="form-control" id="inputMiddleName">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputLastName" class="col-form-label">Last Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[last_name]" value="<?php echo h($user->last_name); ?>" class="form-control" id="inputLastName">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputPreferredName" class="col-form-label">Preferred Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[preferred_name]" value="<?php echo h($user->preferred_name); ?>" class="form-control" id="inputPreferredName">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputBirthDate" class="col-form-label">Birth Date</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[birth_date]" value="<?php echo h($user->birth_date); ?>" class="form-control" id="inputBirthDate">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputGroupID" class="col-form-label">Group ID</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[group_id]" value="<?php echo h($user->group_id); ?>" class="form-control" id="inputGroupID">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputAvatarURL" class="col-form-label">Avatar</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[avatar_url]" value="<?php echo h($user->avatar_url); ?>" class="form-control" id="inputAvatarURL">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputStreetAddress" class="col-form-label">Street Address</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[street_address]" value="<?php echo h($user->street_address); ?>" class="form-control" id="inputStreetAddress">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputCity" class="col-form-label">City</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[city]" value="<?php echo h($user->city); ?>" class="form-control" id="inputCity">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputStateAbv" class="col-form-label">State</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[state_abv]" value="<?php echo h($user->state_abv); ?>" class="form-control" id="inputStateAbv">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputZip" class="col-form-label">Zip Code</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[zip]" value="<?php echo h($user->zip); ?>" class="form-control" id="inputZip">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputCountryAbv" class="col-form-label">Country</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[country_abv]" value="<?php echo h($user->country_abv); ?>" class="form-control" id="inputCountryAbv">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputEmail" class="col-form-label">Email</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[email]" value="<?php echo h($user->email); ?>" class="form-control" id="inputEmail">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputPhonePrimary" class="col-form-label">Primary Phone</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[phone_primary]" value="<?php echo h($user->phone_primary); ?>" class="form-control" id="inputPhonePrimary">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputPhoneSecondary" class="col-form-label">Secondary Phone</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[phone_secondary]" value="<?php echo h($user->phone_secondary); ?>" class="form-control" id="inputPhoneSecondary">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputEmergencyFirst" class="col-form-label">Emergency Contact First Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[first_name_emergency]" value="<?php echo h($user->first_name_emergency); ?>" class="form-control" id="inputEmergencyFirst">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputEmergencyLast" class="col-form-label">Emergency Contact Last Name</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[last_name_emergency]" value="<?php echo h($user->last_name_emergency); ?>" class="form-control" id="inputEmergencyLast">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputPhoneEmergency" class="col-form-label">Emergency Phone</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[phone_emergency]" value="<?php echo h($user->phone_emergency); ?>" class="form-control" id="inputPhoneEmergency">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputPassword" class="col-form-label">Password</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[password]" value="<?php echo h($user->password); ?>" class="form-control" id="inputPassword">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[confirm_password]" value="<?php echo h($user->confirm_password); ?>" class="form-control" id="inputConfirmPassword">
  </div>
</div>

<div class="row row-cols-md-auto align-items-center mb-4">
  <div class="col-md-3 text-end">
    <label for="inputAccessAbv" class="col-form-label">User Type</label>
  </div>
  <div class="col-md-5">
    <input type="text" name="user[access_abv]" value="<?php echo h($user->access_abv); ?>" class="form-control" id="inputAccessAbv">
  </div>
</div>