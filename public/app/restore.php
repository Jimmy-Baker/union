<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

if(!isset($_GET['key']) && !isset($_POST['key'])) {
  $session->message("Unauthorized access was detected. Please generate a new request try again.", "warning");
  redirect_to(url_for('/app/login.php'));
}

$email = $_GET['email'] ?? $_POST['email'];
$key = $_GET['key'] ?? $_POST['key'];

/** 
 * Save a database record upon request
 */
if(is_post_request()) {
  if(empty($error_array)) {
    $user = User::find_by_email($email);
    if($user) {
      $request = Request::find_by_param('user_id', $user->id);
      if($request){
        $verify = $request->verify_password($key);
        if($verify){
          //upate password
          $args=$_POST['user'];
          $user->merge_attributes($args);
          $saved = $user->save();
          if($saved) {
            $request->delete();
            $session->message('Your password has been updated.', 'success');
            redirect_to(url_for('/app/login.php'));
          } else {
            $session->message('Your request could not be completed. Please check your input and try again.', 'warning');
          }
        } else {
          $session->message('The request could not be validated.', 'warning');
        }
      } else {
        $session->message('No password reset request could be found.', 'warning');
      }
    } else {
      $session->message('The email could not be found.', 'warning');
    }
  } else {
    $session->message('Please check your input and try again.', 'warning');
  }
}

$page_title = 'Password Reset';
include(SHARED_PATH . '/public-header.php'); 
?>

<main class="container-md p-4 mt-5" id="main">
  <? display_errors($error_array); ?>
  <form action="restore.php?email=<?= u($email) ?>&key=<?= u($key) ?>" method="post">
    <h1><?= $page_title ?></h1>
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Reset Your Password</legend>
      <div class="card-body">
        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputEmail" class="col-form-label">Confirm Email</label>
          </div>
          <div class="col-md-7">
            <input type="text" name="email" value="<?= h($email); ?>" class="form-control" id="inputEmail" maxlength="255" aria-describedby="helpEmail" required>
          </div>
          <div id="helpEmail" class="form-text offset-md-3">Maximum of 255 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputPassword" class="col-form-label">New Password</label>
          </div>
          <div class="col-md-7">
            <input type="password" name="user[password]" value="" class="form-control" aria-describedby="helpPassword" id="inputPassword">
          </div>
          <div id="helpPassword" class="form-text offset-md-3">Must be at least 8 characters and contain a combination of uppercase and lowercase letters and symbols.</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
          <div class="col-md-3 text-md-end">
            <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
          </div>
          <div class="col-md-7">
            <input type="password" name="user[confirm_password]" value="" class="form-control" id="inputConfirmPassword">
          </div>
          <div id="helpConfirmPassword" class="form-text offset-md-3">Must match the previous value.</div>
        </div>
      </div>
    </fieldset>
    <input type="hidden" id="inputKey" name="key" value="<?= $key ?>">

    <div class="row justify-content-evenly">
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
      </div>
      <div class="col-sm-4 col-md-3 mb-3 d-grid">
        <button type="submit" name="submit" class="btn shadow btn-primary">Submit Edits</button>
      </div>
    </div>
  </form>

</main>


<?php include(SHARED_PATH . '/public-footer.php'); ?>
