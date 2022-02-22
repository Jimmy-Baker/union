<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($user)) {
  redirect_to(url_for('/staff/users/users.php'));
}
?>

<div class="row">
  <div class="six columns offset-by-three"><label>First name</label>
  <input type="text" id="first_name" name="user[first_name]" value="<?= h($user->first_name); ?>" /></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>Last name</label>
  <input type="text" id="last_name" name="user[last_name]" value="<?= h($user->last_name); ?>" /></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>Email</label>
  <input type="text" id="email" name="user[email]" value="<?= h($user->email); ?>" /></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>Username</label>
  <input type="text" id="username" name="user[username]" value="<?= h($user->username); ?>" /></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>User Level</label>
  <input type="radio" id="member" name="user[user_level]" value="m" checked /><label for="member">Member</label>
  <input type="radio" id="admin" name="user[user_level]" value="a" <?php if($user->user_level == 'a'){echo "checked";}; ?>/><label for="admin">Admin</label></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>Password</label>
  <input type="password" id="password" name="user[password]" value="" /></div>
</div>

<div class="row">
  <div class="six columns offset-by-three"><label>Confirm Password</label>
  <input type="password" id="confirm_password" name="user[confirm_password]" value="" /></div>
</div>
