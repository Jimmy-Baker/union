<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

$error_array = [];
$email = '';
$password = '';

if(is_post_request()) {
  $email = $_POST['email'] ?? '';
  if(is_blank($email)) {
    $error_array[] = ["#email","Email cannot be blank."];
  }
  if(empty($error_array)) {
    $user = User::find_by_email($email);
    if($user != false) {
      $key = random_six();
      $args = [];
      $args['user_id'] = $user->id;
      $args['key'] = $key;
      
      $reset = Request::delete_all($user->id);
      $request = new Request($args);
      $result = $request->save();
      
      if($reset && $result){
        include('mail/password_reset.php');
        $session->message('An email will be sent to your address if it exists in our system.', 'success');
      } else {
        $session->message("The request could not be completed. Please try again.", "danger");
      }
    } else {
      $session->message("The request could not be generated. Please try again.", "danger");
    }
  }
}

$page_title = 'Password Reset';
include(SHARED_PATH . '/public-header.php'); 
?>

<main class="container-md p-4 mt-5" id="main">
  <form action="reset.php" method="post">
    <h1><?= $page_title ?></h1>
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email Address</label>
      <input type="email" name="email" value="<?= h($email); ?>" class="form-control" id="inputEmail" aria-describedby="helpEmail" required>
      <div id="helpEmail" class="form-text">Required</div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary" id="spinButton">Reset Password</button>
  </form>

  <?= display_errors($error_array); ?>
</main>


<?php include(SHARED_PATH . '/public-footer.php'); ?>