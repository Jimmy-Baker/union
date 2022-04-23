<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

$error_array = [];
$email = '';
$password = '';

if(is_post_request()) {

  $email = $_POST['email'] ?? '';

  // Validations
  if(is_blank($email)) {
    $error_array[] = ["#email","Email cannot be blank."];
  }

  // if there were no errors, try to login
  if(empty($error_array)) {
    $user = User::find_by_email($email);
    // test if user found and password is correct
    if($user != false) {
      // generate a security key
      $key = random_six();
      
      // generate a new request
      $args = [];
      $args['user_id'] = $user->id;
      $args['key'] = $key;
      
      $request = new Request($args);
      $result = $request->save();
      // send user a password reset email
      
      include('mail/password_reset.php');
    } else {
      // email not found or password does not match
      echo 'No User';
    }
  }
  $session->message('An email will be sent to your address if it exists in our system.', 'success');

}

$page_title = 'Password Reset';
include(SHARED_PATH . '/public-header.php'); 
?>

<main class="container-md p-4 mt-5" id="main">
  <form action="reset.php" method="post">
    <h1><?= $page_title ?></h1>
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email Address</label>
      <input type="email" name="email" value="<?= h($email); ?>" class="form-control" id="inputEmail" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Reset Password</button>
  </form>

  <?= display_errors($error_array); ?>
</main>


<?php include(SHARED_PATH . '/user-footer.php'); ?>