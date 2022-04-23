<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Log in';

$error_array = [];
$email = '';
$password = '';

if(is_post_request()) {

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($email)) {
    $error_array[] = ["#email","Email cannot be blank."];
  }
  if(is_blank($password)) {
    $error_array[] = ["#password","Password cannot be blank."];
  }
  // if there were no errors, try to login
  if(empty($error_array)) {
    $user = User::find_by_email($email);
    // test if user found and password is correct
    if($user != false && $user->verify_password($password)) {
      // Mark user as logged in
      $session->login($user);
      $session->message('Your login was successful!', 'success');
      
      switch ($session->access_abv) {
        case "AA":
          redirect_to(url_for('/app/admin/index.php'));
          break;
        case "GS":
          redirect_to(url_for('/app/staff/index.php'));
          break; 
        case "GM":
          redirect_to(url_for('app/staff/index.php'));
          break;
        default:
          redirect_to(url_for('app/member/index.php'));
      }
    } else {
      // email not found or password does not match
      $session->message('That email and password combination was incorrect.', 'warning');
    }
  }
}

include(SHARED_PATH . '/public-header.php'); 
?>

<main class="container-md p-4 mt-5" id="main">
  <form action="login.php" method="post">
    <h1>Log In</h1>
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email Address</label>
      <input type="email" name="email" value="<?= h($email); ?>" class="form-control" id="inputEmail" required>
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" name="password" value="" class="form-control" id="inputPassword" aria-describedby="passwordHelp" required>
      <div id="passwordHelp" class="form-text">Can't remember your password? Contact us for assistance.</div>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="inputRemember">
      <label class="form-check-label" for="inputRemember">Remember Me</label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Log In</button>
  </form>

  <?= display_errors($error_array); ?>
</main>


<?php include(SHARED_PATH . '/user-footer.php'); ?>