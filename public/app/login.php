<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

$error_array = [];
$email = '';
$password = '';

/** 
 * Generate a new session upon request
 */
if(is_post_request()) {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  if(is_blank($email)) {
    $error_array[] = ["#email","Email cannot be blank."];
  }
  if(is_blank($password)) {
    $error_array[] = ["#password","Password cannot be blank."];
  }
  if(empty($error_array)) {
    $user = User::find_by_email($email);
    if($user != false && $user->verify_password($password)) {
      $session->login($user);
      $session->message('Your login was successful!', 'success');
      
      redirect_to(url_for('/app/dashboard/index.php'));
          
    } else {
      $session->message('That email and password combination was incorrect.', 'warning');
    }
  }
}

$page_title = 'Log in';
include(SHARED_PATH . '/public-header.php'); 
?>

<main class="container-md p-4 mt-5" id="main">
  <?= display_errors($error_array); ?>

  <form action="login.php" method="post">
    <h1><?= $page_title ?></h1>
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email Address</label>
      <input type="email" name="email" value="<?= h($email); ?>" class="form-control" id="inputEmail" required>
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" name="password" value="" class="form-control" id="inputPassword" aria-describedby="helpPassword" required>
      <div id="helpPassword" class="form-text">Can't remember your password? <a href="<?= url_for('app/reset.php') ?>">Reset it</a> using your email.</div>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="inputRemember">
      <label class="form-check-label" for="inputRemember">Remember Me</label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Log In</button>
  </form>

</main>


<?php include(SHARED_PATH . '/user-footer.php'); ?>
