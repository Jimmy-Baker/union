<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

// Log out the user
$session->logout();
$session->message("You have successfully logged out.", "success");
redirect_to(url_for('/index.php'));

?>
