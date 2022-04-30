<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  $session->message('No group was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/groups.php'));
} elseif(!isset($_POST['user'])) {
  $session->message('No user was identified.', 'warning');
  redirect_to(url_for('/app/shared/groups/view.php?id=' . u($_GET['id'])));
}

$id = $_GET['id'];
$group = Group::find_by_id($id);
$user_id = $_POST['user'];
$redirection = url_for('/app/shared/groups/view.php?id=' . u($id));
if(is_post_request()) {
  if($group){
    $result = $group->remove_user($user_id);
    if($result) {
      $session->message('The user was removed successfully.', 'success');
      redirect_to($redirection);
    } else {
      $session->message('The group could not be modified.', 'warning');
      redirect_to($redirection);
    }
  } else {
    $session->message('The group could not be modified.', 'warning');
    redirect_to($redirection);
  }
} else {
  redirect_to($redirection);
}
?>
